<?php
/*-----8<--------------------------------------------------------------------
 * 
 * BEdita - a semantic content management framework
 * 
 * Copyright 2008 ChannelWeb Srl, Chialab Srl
 * 
 * This file is part of BEdita: you can redistribute it and/or modify
 * it under the terms of the Affero GNU General Public License as published 
 * by the Free Software Foundation, either version 3 of the License, or 
 * (at your option) any later version.
 * BEdita is distributed WITHOUT ANY WARRANTY; without even the implied 
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the Affero GNU General Public License for more details.
 * You should have received a copy of the Affero GNU General Public License 
 * version 3 along with BEdita (see LICENSE.AGPL).
 * If not, see <http://gnu.org/licenses/agpl-3.0.html>.
 * 
 *------------------------------------------------------------------->8-----
 */

/**
 * 
 * @link			http://www.bedita.com
 * @version			$Revision: 1627 $
 * @modifiedby 		$LastChangedBy: bato $
 * @lastmodified	$LastChangedDate: 2009-01-02 20:21:19 +0100 (ven, 02 gen 2009) $
 * 
 * $Id: video.php 1627 2009-01-02 19:21:19Z bato $
 */
class Application extends BeditaStreamModel
{
	var $actsAs = array();
	
	public $applicationType = array(
		"flash" => array(
			"mime_type" => array("application/x-shockwave-flash"),
			"application_type" => "application/x-shockwave-flash",
			"label" => "Adobe Flash"
		)
	);
}
?>