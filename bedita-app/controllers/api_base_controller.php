<?php
/*-----8<--------------------------------------------------------------------
 *
 * BEdita - a semantic content management framework
 *
 * Copyright 2014 ChannelWeb Srl, Chialab Srl
 *
 * This file is part of BEdita: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * BEdita is distributed WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU Lesser General Public License for more details.
 * You should have received a copy of the GNU Lesser General Public License
 * version 3 along with BEdita (see LICENSE.LGPL).
 * If not, see <http://gnu.org/licenses/lgpl-3.0.html>.
 *
 *------------------------------------------------------------------->8-----
 */

/**
 * ApiBaseController class
 *
 * Abstract Base Api Controller
 * It must to be extened from ApiController in frontend apps
 */
abstract class ApiBaseController extends FrontendController {

    public $uses = array();

    protected $loginRedirect = null;

    /**
     * The default end points
     *
     * @var array
     */
    private $defaultEndPoints = array('objects', 'session');

    /**
     * Other end points specified in the frontend app
     * They will be merged with self::defaultEndPoints()
     *
     * @var array
     */
    protected $endPoints = array();

    /**
     * The response data for client
     *
     * @var array
     */
    protected $responseData = array();

    /**
     * The POST data in request
     *
     * @var array
     */
    private $postData = array();

    /**
     * An array of filter to apply to objects
     *
     * @var array
     */
    protected $filter = array();

    /**
     * The request method invoked
     *
     * @var string
     */
    protected $requestMethod = null;

    /**
     * The generic exception message in the response
     *
     * @var string
     */
    protected $defaultExceptionMessage = 'Generic error.';

    /**
     * An array of http status codes linked with exception messages
     *
     * @var array
     */
    protected $codeToMessages = array(
        400 => 'Bad Request.',
        401 => 'Unauthorized.',
        403 => 'Forbidden.',
        404 => 'Object not found.',
        405 => 'Method not allowed.',
        409 => 'Conflict between request and method.'
    );

    /**
     * Constructor
     * Merge self::defaultEndPoints, self::endPoints and object types whitelist end points
     */
    public function __construct() {
        $this->components[] = 'ApiFormatter';
        $this->endPoints = array_unique(array_merge($this->defaultEndPoints, $this->endPoints));
        $objectTypes = Configure::read('objectTypes');
        foreach ($objectTypes as $key => $value) {
            if (is_numeric($key)) {
                $this->endPoints[] = Inflector::pluralize($value['name']);
            }
        }
        parent::__construct();
    }

    /**
     * Enables calling methods for object types as /documents, /events, etc... delegating the action to self::objects()
     *
     * @param string $method name of the method to be invoked
     * @param array $arguments list of arguments passed to the function
     * @return mixed
     */
    public function __call($method, $arguments) {
        $objectType = Configure::read('objectTypes.' . Inflector::singularize($method));
        if (!empty($objectType)) {
            $this->filter['object_type_id'] = $objectType['id'];
            return call_user_func_array(array($this, 'objects'), $arguments);
        }

        $this->throwException(405);
    }

    /**
     * Normalize POST data
     *
     * This function searches for POST data in the global var $_POST and in 'php://input' alias file
     * Some Javascript XHR wrappers POSTs data are passed through 'php://input'
     *
     * @return array
     */
    private function handlePOST() {
        if (!empty($this->params['form'])) {
            $postdata = $this->params['form'];
        } else {
            try {
                $postdata = file_get_contents('php://input');
                $this->params['form'] = json_decode($postdata, true);
                if (!empty(json_last_error())) {
                    $this->params['form'] = array();
                }
            } catch(Excpetion $ex) {
                $this->params['form'] = array();
            }
        }
    }

    /**
     * Set View and response (json)
     *
     * If method is overridden in ApiController remember to call parent::beforeCheckLogin()
     *
     * @return void
     */
    protected function beforeCheckLogin() {
        $this->view = 'View';
        $this->RequestHandler->respondAs('json');
        $this->requestMethod = strtolower(env('REQUEST_METHOD'));

        $token = null;
        //@todo clean and move to component?
        if (function_exists('apache_request_headers')) {
            $h = apache_request_headers();
            if (!empty($h['Authorization'])) {
                $token = $h['Authorization'];
            }
        } elseif (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            $token = $_SERVER['HTTP_AUTHORIZATION'];
        } elseif (!empty($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            // fastcgi + rewrite rule
            $token = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            //$this->log("Http header token " . $token, LOG_DEBUG);
        } elseif (!empty($_SERVER['REDIRECT_REDIRECT_HTTP_AUTHORIZATION'])) {
            // fastcgi + rewrite rule
            $token = $_SERVER['REDIRECT_REDIRECT_HTTP_AUTHORIZATION'];
            //$this->log("Http header token " . $token, LOG_DEBUG);
        }

        // @todo remove token pass in named
        if (!empty($this->params["named"]["token"])) {
            $token = $this->params["named"]["token"];
            //$this->log("URL token " . $token, LOG_DEBUG);
        } elseif (!empty($this->params["url"]["accessToken"])) {
            $token = $this->params["url"]["accessToken"];
        }

        if ($token) {
            $this->BeAuth->startSession($token);
        }
    }

    /**
     * Set common meta data for response
     * Meta data are:
     *  - url
     *  - params
     *  - api
     */
    private function setBaseResponse() {
        $this->responseData['url'] = $this->params['url']['url'];
        $urlParams = array_slice($this->params['url'], 1);
        $passParams = array_slice($this->params['pass'], 1);
        $getParams = array_slice($_GET, 0);
        unset($getParams['url']);
        $this->responseData['params'] = array_merge($passParams, $urlParams, $this->params['named'], $getParams);
        $this->responseData['api'] = $this->action;
        $this->responseData['method'] = $this->requestMethod;
    }

    /**
     * Any Api request has to pass from this method (see frontend app routes.php)
     * Override FrontendController::route()
     *
     * The method checks for valid api end points and call method or fallback to self::__call()
     *
     * @return void
     */
    public function route() {
        $args = func_get_args();
        $name = array_shift($args);
        // generic methodName
        $methodName = str_replace(".", "_", $name);
        // avoid to call methods that aren't end points
        if (!in_array($methodName, $this->endPoints)) {
            $this->action = $methodName;
            $this->throwException(405);
        } else {
            if ($this->requestMethod == 'post') {
                $this->handlePOST();
            }
            $this->action = $methodName;
            $specificMethodName = Inflector::camelize($this->requestMethod . '_' . $methodName);
            if (method_exists($this, $specificMethodName)) {
                call_user_func_array(array($this, $specificMethodName), $args);
            } else {
                call_user_func_array(array($this, $methodName), $args);
            }
        }
        $this->response();
    }

    /**
     * handle Exceptions
     *
     * @param Exception $ex
     * @return void
     */
    protected function handleException(BeditaException $ex) {
        $currentController = AppController::currentController();
        $code = $ex->getHttpCode();
        if (empty($code)) {
            $code = 500;
        }
        http_response_code($code);
        $currentController->responseData['error'] = array(
            'code' => $code,
            'message' => $ex->getMessage()
        );
    }

    /**
     * create a BEditaExceptions and handle it
     *
     * @param int $code the http status code
     * @param string $message a custom message
     * @return void
     */
    public function throwException($code, $message = null) {
        if (empty($message)) {
            $message = $this->getDefaultCodeMessage($code);
        }
        $ex = new BeditaException($message, true, self::ERROR, $code);
        $this->handleException($ex);
    }

    /**
     * Return a specific or generic message for the http status code provided.
     *
     * The method checks if a specific message is set for the provided code, otherwise return the generic one
     *
     * @param int $code the http status code
     * @return string
     */
    protected function getDefaultCodeMessage($code) {
        if (isset($this->codeToMessages[$code])) {
            return $this->codeToMessages[$code];
        } else {
            return $this->defaultExceptionMessage;
        }
    }

    /**
     * objects end point method
     *
     * If $name is passed try to load an object with that id or nickname
     *
     * @param int|string $name an object id or nickname
     * @return void
     */
    protected function objects($name = null) {
        if (!empty($name)) {
            $id = is_numeric($name) ? $name : $this->BEObject->getIdFromNickname($name);
            $object = $this->loadObj($id);
            // check if id correspond to object type requested (if any)
            if (!empty($this->filter['object_type_id']) && $object['object_type_id'] != $this->filter['object_type_id']) {
                $this->throwException(500, 'Object type mismatch');
            }
            $this->responseData['data'] = $this->ApiFormatter->formatObject($object);
        // @todo list of objects
        } else {

        }
    }

    /**
     * Create user session
     *
     * @return void
     */
    protected function postSession() {
        if ($this->logged) {
            $this->responseData['data'] = array(
                'accessToken' => $this->Session->id(),
                'expiresIn' => $this->Session->cookieLifeTime - (time() - $this->Session->sessionTime)
            );
        } else {
            $this->throwException(401);
        }
    }

    /**
     * Check user session
     *
     * @return void
     */
    protected function getSession() {
         if ($this->Session->valid()) {
            $this->responseData['data'] = array(
                'accessToken' => $this->Session->id(),
                'expiresIn' => $this->Session->cookieLifeTime - (time() - $this->Session->sessionTime),
                'valid' => true
            );
        } else {
            $this->throwException(401, 'Invalid or expired session.');
        }
    }

    /**
     * Destroy session
     *
     * @return void
     */
    protected function deleteSession() {
        if ($this->Session->valid()) {
            $this->BeAuth->logout(false);
            $this->responseData['data'] = array('logout' => true);
        } else {
            $this->throwException(401, 'Invalid or expired session');
        }
    }

    /**
     * Build response data for client
     *
     * @return void
     */
    protected function response() {
        $this->setBaseResponse();
        $this->set('data', $this->responseData);
        $this->render('/pages/json');
    }

}