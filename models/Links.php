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
 * @subpackage Link Model
 *
 * @author Andrew Waters <andrew@band-x.org>
 * @version 1.0
 * @license http://creativecommons.org/licenses/MIT MIT License
 * @copyright band-x Media Limited, 2010
 */

class Links {

	const TABLE_NAME = "links";

	function getAllLinks() {
		$links = Record::findAllFrom('Links', ' id != "" ORDER BY category');
		foreach($links as $link) {
			$link->category = LinkCategory::getCategory($link->category);
		}
		return $links;
	}

	function addLink($_POST) {
		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		$url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
		$category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
		$http = substr($url, 0, 4);
		if($http != 'http') $url = 'http://' . $url;
		Record::insert('Links', array('name' => $name, 'url' => $url, 'category' => $category));
	}

	function changeCategory($_POST) {
		$update = array('category' => $_POST['category']);
		$id = $_POST['id'];
		Record::update('Links', $update, "id='$id'");
	}

	function getAllFromCategory($category) {
		return Record::findAllFrom('Links', "category='$category'");
	}

	function moveCategory($from, $to) {
		Record::update('Links', array('category' => $to), "category='$from'");
	}

	function delete($id) {
		Record::deleteWhere('Links', "id='$id'");
	}

}