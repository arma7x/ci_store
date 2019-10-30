<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Product_Model', 'PM');
	}

	public function category() {
		$this->AllowGetRequest();
		$this->load->model('Category_Model', 'Category');
		$this->_renderJSON(200, $this->Category->get_all_cache());
	}

	public function spotlight() {
		$this->AllowGetRequest();
		$data = $this->PM->get_spotlight_cache();
		$this->_renderJSON(200, $data);
	}

	/*
	 * QUERY STRING -> keyword, category, ordering, spotlight, page
	 * keyword -> string|''
	 * ordering -> created_at@desc|created_at@asc|price@desc|price@asc
	 * spotlight -> 1|0|''
	 * category -> id of /api/product/category
	*/
	public function search() {
		$this->AllowGetRequest();
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
		$data = $this->PM->get_product_list($this->PM->PUBLIC_SEARCH_FIELD_JOIN(), $this->PM->PUBLIC_SEARCH_FIELD_JOIN(), $category, $filters, $order_by, current_url(), 12, (int) $this->input->get('page'), TRUE);
		$this->_renderJSON(200, $data);
	}

	public function view() {
		$this->AllowGetRequest();
		$data = $this->PM->get_product_cache($this->uri->segment(4));
		if ($data === FALSE) {
			show_404();
		}
		$this->_renderJSON(200, $data);
	}

}
