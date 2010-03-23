<?php

/**
 * Copyright (C) 2010, band-x Media Limited <info@band-x.org>
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * 
 * All copyright notices and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * 
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 */

/**
 * @package Links
 *
 * @author Andrew Waters <andrew@band-x.org>
 * @version 1.0
 * @license http://creativecommons.org/licenses/MIT MIT License
 * @copyright band-x Media Limited, 2010
 */


	global $__CMS_CONN__;

	/**
		Sanity Check - decide whether we're enabling for the first time or after a disable
	**/

	$sql = "SELECT * FROM `".TABLE_PREFIX."plugin_settings` WHERE plugin_id='links';";
	$pdo = $__CMS_CONN__->prepare($sql);
	$pdo->execute();
	$rowCount = $pdo->rowCount();

	if($rowCount == 0) {
		$sql =	"	INSERT INTO `".TABLE_PREFIX."plugin_settings` (`plugin_id`,`name`,`value`)
					VALUES
						('links','layout','2'),
						('links','target','_blank')
				;";
	}
	$pdo = $__CMS_CONN__->prepare($sql);
	$pdo->execute();


	/**
		Let's create the tables. If they exist, they won't be overwritten
	**/

	$sql =	"	CREATE TABLE `".TABLE_PREFIX."links` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`name` varchar(128) DEFAULT NULL,
					`url` varchar(128) DEFAULT NULL,
					`category` int(11) DEFAULT NULL,
					PRIMARY KEY (`id`)
				) AUTO_INCREMENT=0;
			";
	$pdo = $__CMS_CONN__->prepare($sql);
	$pdo->execute();

	$sql =	"	CREATE TABLE `".TABLE_PREFIX."link_categories` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`name` varchar(128) DEFAULT NULL,
					PRIMARY KEY (`id`)
				) AUTO_INCREMENT=0;
			";
	$pdo = $__CMS_CONN__->prepare($sql);
	$pdo->execute();


	/**
		Need to check and install 'uncategorised' category :)
	**/

	$sql = "SELECT * FROM `".TABLE_PREFIX."link_categories` WHERE id='1';";
	$pdo = $__CMS_CONN__->prepare($sql);
	$pdo->execute();
	$rowCount = $pdo->rowCount();

	if($rowCount == 0) {
		$sql =	"	INSERT INTO `".TABLE_PREFIX."link_categories` (`id`,`name`)
					VALUES
						('1','uncategorised')
				;";
	}
	$pdo = $__CMS_CONN__->prepare($sql);
	$pdo->execute();

	exit();