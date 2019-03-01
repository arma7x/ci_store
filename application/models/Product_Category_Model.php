<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Category_Model extends MY_Model {

	public $table = 'product_category_tags';

	public function get_categories_of_product($product) {
		$this->load->model('Category_Model', 'Category');
		$this->db->select($this->Category->table.'.*');
		$this->db->where('product', $product);
		$this->db->from($this->table);
		$this->db->join($this->Category->table, $this->Category->table.'.id = '.$this->table.'.category');
		return $this->db->get()->result_array();
	}

	public function add_product_categories($product, $new_categories) {
		$old_categories_list = array();
		$old = $this->db->select('*')->get_where($this->table, array('product' => $product))->result_array();
		foreach($old as $index => $data) {
			array_push($old_categories_list, $data['category']);
		}
		$remove_list = array();
		foreach($old_categories_list as $index => $category) {
			if(in_array($category, $new_categories) === FALSE) {
				array_push($remove_list, $category);
			}
		}
		$add_list = array();
		foreach($new_categories as $index => $category) {
			if(in_array($category, $old_categories_list) === FALSE) {
				array_push($add_list, array('product' => $product, 'category' => $category));
			}
		}
		if (COUNT($add_list) > 0) {
			$this->db->insert_batch($this->table, $add_list);
		}
		foreach($remove_list as $index => $category) {
			$this->remove_by_product_or_category(array('product' => $product, 'category' => $category));
			var_dump(array('product' => $product, 'category' => $category));
		}
	}

	public function remove_by_product_or_category($index) {
		$exist = $this->db->select('*')->get_where($this->table, $index, 1)->row_array();
		if ($exist !== NULL) {
			$result = $this->db->delete($this->table, $index);
			return $result;
		}
		return FALSE;
	}
}
