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
 * @subpackage LinksController
 *
 * @author Andrew Waters <andrew@band-x.org>
 * @version 1.0
 * @license http://creativecommons.org/licenses/MIT MIT License
 * @copyright band-x Media Limited, 2010
 */

class LinksController extends PluginController {

	public function __construct() {
		$settings = Plugin::getAllSettings('links');
		if(defined('CMS_BACKEND')) {
			$this->setLayout('backend');
		} else {
			$layout = Layout::findById($settings['layout']);
			$this->setLayout($layout->name);
		}
	}

	public function index() {
		if(defined('CMS_BACKEND')) {
			$complete = array();
			$categories = LinkCategory::getAllCategories();
			foreach($categories as $category) {
				$complete[$category->name] = Links::getAllFromCategory($category->id);
			}
			$settings = Plugin::getAllSettings('links');
			$layouts = Layout::findAll();
			$this->assignToLayout('sidebar', new View('../../plugins/links/views/backend/sidebar', array('categories' => $categories, 'settings' => $settings, 'layouts' => $layouts)));
			$this->display('../plugins/links/views/backend/index', array('links' => $complete, 'categories' => $categories));
		} else {
			$complete = array();
			$categories = LinkCategory::getAllCategories();
			foreach($categories as $category) {
				$complete[$category->name] = Links::getAllFromCategory($category->id);
			}
			$settings = Plugin::getAllSettings('links');
			$this->display('../../plugins/links/views/frontend/index', array('categories' => $complete, 'settings' => $settings));
		}
	}

	public function add($type) {
		if(defined('CMS_BACKEND')) {
			if($type == 'link') {
				Links::addLink($_POST);
				Flash::set('success', __('Your link has been added'));
				redirect(get_url('links'));
			} elseif($type == 'category') {
				if(isset($_POST['name']) && $_POST['name'] != '') {
					LinkCategory::addCategory($_POST);
					Flash::set('success', __('Your category has been added'));
					redirect(get_url('links'));
				} else {
					Flash::set('error', __('You must give your category a name'));
					redirect(get_url('links'));
				}
			}
		}
	}

	public function delete($type, $id) {
		if(defined('CMS_BACKEND')) {
			if($type == 'link') {
				Links::delete($id);
				Flash::set('success', __('This link has been deleted'));
				redirect(get_url('links'));
			} elseif($type == 'category') {
				LinkCategory::delete($id);
				Flash::set('success', __('This Category has been deleted'));
				redirect(get_url('links'));
			}
		}
	}

	public function changeCategory() {
		Links::changeCategory($_POST);
		Flash::set('success', __('This link has been updated'));
		redirect(get_url('links'));
	}

	public function changeLayout() {
		Plugin::setSetting('layout', $_POST['layout'], 'links');
		Flash::set('success', __('The frontend layout has been changed'));
		redirect(get_url('links'));
	}

	public function changeTarget() {
		Plugin::setSetting('target', $_POST['target'], 'links');
		Flash::set('success', __('The target window has been changed'));
		redirect(get_url('links'));
	}

	public function content($part=FALSE, $inherit=FALSE) {
		if(!$part) { return $this->content; }
	}
}