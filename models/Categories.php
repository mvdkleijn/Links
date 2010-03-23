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
 * @subpackage LinkCategory Model
 *
 * @author Andrew Waters <andrew@band-x.org>
 * @version 1.0
 * @license http://creativecommons.org/licenses/MIT MIT License
 * @copyright band-x Media Limited, 2010
 */

class LinkCategory {

	const TABLE_NAME = "link_categories";

	function getCategory($id) {
		return Record::findByIdFrom('LinkCategory', $id);
	}

	function getAllCategories() {
		return Record::findAllFrom('LinkCategory', ' id != "" ORDER BY name');
	}

	function addCategory($_POST) {
		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		Record::insert('LinkCategory', array('name' => $name));
	}

	function delete($id) {
		Links::moveCategory($id, 1);
		Record::deleteWhere('LinkCategory', "id='$id'");
	}

}