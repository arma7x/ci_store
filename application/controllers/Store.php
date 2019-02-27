<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function view() {
		$this->AllowGetRequest();
		$this->output->set_header('Sw-Offline-Cache: true');
		$this->load->model('Category_Model', 'Category');
		$this->data['title'] = $this->container['app_name'].' | '.lang('H_HOMEPAGE');
		$this->data['page_name'] = str_replace('%s', $this->container['app_name'], lang('H_WELCOME'));
		$this->data['cat_link'] = $this->Category->get_all_cache();
		$this->widgets['products'] = 'store/widgets/list';
		$this->widgets['content'] = 'store/view';
		$this->_renderLayout();
	}

	public function search() {
		$this->AllowGetRequest();
		$this->load->model('Category_Model', 'Category');
		$this->data['title'] = $this->container['app_name'].' | '.lang('H_HOMEPAGE');
		$this->data['page_name'] = str_replace('%s', $this->container['app_name'], lang('H_WELCOME'));
		$this->data['cat_link'] = $this->Category->get_all_cache();
		$this->widgets['products'] = 'store/widgets/list';
		$this->widgets['content'] = 'store/search';
		$this->_renderLayout();
	}

}