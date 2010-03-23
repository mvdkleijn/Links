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

Plugin::setInfos(array(
	'id'			=>	'links',
	'title'			=>	'Links',
	'description'	=>	'A link builder for your site (similar to a Blogroll)',
	'license'		=>	'MIT',
	'author'		=>	'Andrew Waters',
	'website'		=>	'http://www.band-x.org/',
	'update_url'	=>	'http://www.band-x.org/update.xml',
	'version'		=>	'1.0.0',
	'type'			=>	'both'
));

Plugin::addController('links', 'Links', 'administrator,developer,editor', TRUE);

include('models/Links.php');
include('models/Categories.php');

if(Plugin::isEnabled('links')) {
	Dispatcher::addRoute(array(
		'/links'					=>	'/plugin/links/index',
		'/links/'					=>	'/plugin/links/index',
		'/links/add/:any'			=>	'/plugin/links/add/$1',
		'/links/delete/:any/:num'	=>	'/plugin/links/delete/$1/$2',
		'/links/changeCategory'		=>	'/plugin/links/changeCategory',
		'/links/changeLayout'		=>	'/plugin/links/changeLayout',
		'/links/changeTarget'		=>	'/plugin/links/changeTarget',
	));
}