<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function view() {
		$this->AllowGetRequest();
		$this->load->model('Category_Model', 'Category');
		$this->data['title'] = $this->container['app_name'].' | '.lang('H_HOMEPAGE');
		$this->data['page_name'] = str_replace('%s', $this->container['app_name'], lang('H_WELCOME'));
		$this->data['cat_link'] = $this->Category->get_all_cache();
		$this->widgets['products'] = 'product/widgets/list';
		$this->widgets['content'] = 'product/index';
		$this->_renderLayout();
	}

	public function search() {
		$this->AllowGetRequest();
		$this->load->model('Category_Model', 'Category');
		$this->data['title'] = $this->container['app_name'].' | '.lang('H_HOMEPAGE');
		$this->data['page_name'] = str_replace('%s', $this->container['app_name'], lang('H_WELCOME'));
		$this->data['cat_link'] = $this->Category->get_all_cache();
		$this->widgets['products'] = 'product/widgets/list';
		$this->widgets['content'] = 'product/search';
		$this->_renderLayout();
	}

}
