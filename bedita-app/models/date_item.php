<?php
/**
 *
 * @filesource
 * @copyright		Copyright (c) 2007
 * @link			
 * @package			
 * @subpackage		
 * @since			
 * @version			
 * @modifiedby		
 * @lastmodified	
 * @license
 * @author 		giangi giangi@qwerg.com, ste ste@channelweb.it
 * 		
 * 				Generic date items (for calendars) 		
*/
class DateItem extends BEAppModel 
{
	var $recursive = 0 ;

	var $validate = array(
//		'start' 		=> array(array('rule' => VALID_NOT_EMPTY, 'required' => false)),
//		'end' 		=> array(array('rule' => VALID_NOT_EMPTY, 'required' => false))
	) ;
	
	function beforeValidate() {

        $this->checkDate('start');
        $this->checkDate('end');
        $data = &$this->data[$this->name] ;
        if(!empty($data['start']) && !empty($data['timeStart'])) {
            $data['start'] .= " " . $data['timeStart'];
        }
        if (!empty($data['end']) && !empty($data['timeEnd'])) {
            $data['end'] .= " " . $data['timeEnd'];
        }
        
        return true;
	}
}
?>
