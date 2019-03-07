<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Product_Model', 'PM');
	}

	public function view() {
		$this->AllowGetRequest();
		$this->output->set_header('Sw-Offline-Cache: true');
		$this->load->model('Category_Model', 'Category');
		$this->data['title'] = $this->container['app_name'].' | '.lang('H_HOMEPAGE');
		$this->data['page_name'] = str_replace('%s', $this->container['app_name'], lang('H_WELCOME'));
		$this->data['cat_link'] = $this->Category->get_all_cache();
		$this->widgets['category_nav'] = 'widgets/category_nav';
		$this->data['product'] = $this->PM->get_product_cache($this->uri->segment(2));
		if ($this->data['product'] === FALSE) {
			show_404();
		}
		$this->data['description'] = $this->data['product']['brief_description'];
		$this->widgets['content'] = 'store/view';
		$this->_renderLayout();
	}

	public function search() {
		$this->AllowGetRequest();
		$this->load->model('Category_Model', 'Category');
		$this->load->helper('url');
		$category = $this->input->get('category');
		$ordering = explode('@', $this->input->get('ordering'));
		if (COUNT($ordering) === 1) {
			$order_by = array('order_by' => 'created_at', 'sort' => 'desc');
		} else {
			$order_by = array('order_by' => $ordering[0], 'sort' => $ordering[1]);
		}
		$filters = $this->input->get();
		foreach($filters as $index => $value) {
			if(in_array($index, array('keyword', 'spotlight')) === FALSE) {
				unset($filters[$index]);
			}
		}
		$filters['visibility'] = '1';
		$this->data['title'] = $this->container['app_name'].' | '.lang('H_HOMEPAGE');
		$this->data['page_name'] = str_replace('%s', $this->container['app_name'], lang('H_WELCOME'));
		$this->data['list'] = $this->PM->get_product_list($this->PM::PUBLIC_SEARCH_FIELD, $this->PM::PUBLIC_SEARCH_FIELD_JOIN, $category, $filters, $order_by, current_url(), 9, (int) $this->input->get('page'), TRUE);
		$this->data['cat_link'] = $this->Category->get_all_cache();
		$this->widgets['category_nav'] = 'widgets/category_nav';
		$this->widgets['products'] = 'store/widgets/list';
		$this->widgets['content'] = 'store/search';
		$this->_renderLayout();
	}

}
