<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Model extends MY_Model {

	public CONST PUBLIC_VIEW_FIELD = '*';
	public CONST PUBLIC_SEARCH_FIELD = 'id, name, slug, price, brief_description, spotlight, availability, main_photo';
	public CONST PUBLIC_SEARCH_FIELD_JOIN = 'products.id, products.name, products.slug, products.price, products.brief_description, products.spotlight, products.availability, products.main_photo';
	public CONST ADMIN_SEARCH_FIELD = 'id, name, slug, price, visibility, spotlight, availability, main_photo, created_at, updated_at';
	public CONST ADMIN_SEARCH_FIELD_JOIN = 'products.id, products.name, products.slug, products.price, products.visibility, products.spotlight, products.availability, products.main_photo, products.created_at, products.updated_at';
	public CONST CACHE_PREFIX = 'PM_';
	public CONST SPOTLIGHT_PREFIX = 'SPOTLIGHT';
	public $table = 'products';

	public function get_product_cache($slug) {
		$cached = $this->cache->get(SELF::CACHE_PREFIX.$slug);
		if ($cached !== FALSE) {
			return $cached;
		} else {
			$exist = $this->find_product(SELF::PUBLIC_VIEW_FIELD, array('slug' => $slug, 'visibility' => 1));
			if ($exist !== NULL) {
				$this->set_product_cache($exist['slug'], $exist);
				$this->set_spotlight_cache();
				return $exist;
			} else {
				return FALSE;
			}
		}
	}

	public function set_product_cache($slug, $cache) {
		if ((int) $cache['visibility'] === 0) {
			$this->remove_product_cache($slug);
			return NULL;
		}
		return $this->cache->save(SELF::CACHE_PREFIX.$slug, $cache, 18144000);
	}

	public function remove_product_cache($slug) {
		return $this->cache->delete(SELF::CACHE_PREFIX.$slug);
	}

	public function get_spotlight_cache() {
		$cached = $this->cache->get(SELF::CACHE_PREFIX.SELF::SPOTLIGHT_PREFIX);
		if ($cached === FALSE || COUNT($cached) <= 0) {
			return $this->set_spotlight_cache();
		}
		return $cached;
	}

	public function set_spotlight_cache() {
		$result = $this->db->select(SELF::PUBLIC_SEARCH_FIELD)->order_by('created_at', 'desc')->get_where($this->table, array('spotlight' => 1, 'visibility' => 1))->result_array();
		if (COUNT($result) <= 0) {
			$result = $this->db->select(SELF::PUBLIC_SEARCH_FIELD)->order_by('created_at', 'desc')->get_where($this->table, array('visibility' => 1), 12)->result_array();
			return $result;
		}
		$this->cache->save(SELF::CACHE_PREFIX.SELF::SPOTLIGHT_PREFIX, $result, 18144000);
		return $this->get_spotlight_cache();
	}

	public function get_product_list($select, $select_join, $category, $filter, $order, $base_url, $per_page, $page_num, $num_links) {
		if($category === NULL) {
			$total_rows = $this->get_total_row($category, $filter);
			$skip = $this->skip($per_page, $page_num);;
			$this->db->select($select);
			foreach($filter as $index => $value) {
				if ($value !== NULL) {
					if ($index === 'keyword') {
						$this->db->group_start();
						$this->db->like('id', $value);
						$this->db->or_like('name', $value);
						$this->db->or_like('slug', $value);
						$this->db->group_end();
					} else {
						$this->db->group_start();
						$this->db->where($index, $value);
						$this->db->group_end();
					}
				}
			}
			$this->db->limit($per_page, $skip);
			$this->db->order_by($order['order_by'], $order['sort']);
			$result = $this->db->get($this->table)->result_array();
			return $this->generate($result, $base_url, $per_page, $page_num, $total_rows, $skip, $num_links);
		} else {
			$this->load->model('Product_Category_Model', 'PCM');
			$this->load->model('Category_Model', 'Category');
			$total_rows = $this->get_total_row($category, $filter);
			$skip = $this->skip($per_page, $page_num);;
			$this->db->select($select_join);
			foreach($filter as $index => $value) {
				if ($value !== NULL) {
					if ($index === 'keyword') {
						$this->db->group_start();
						$this->db->like($this->table.'.id', $value);
						$this->db->or_like($this->table.'.name', $value);
						$this->db->or_like($this->table.'.slug', $value);
						$this->db->group_end();
					} else {
						$this->db->group_start();
						$this->db->where($this->table.'.'.$index, $value);
						$this->db->group_end();
					}
				}
			}
			$this->db->group_start();
			$this->db->where($this->PCM->table.'.category', $category);
			$this->db->group_end();
			$this->db->join($this->Category->table, $this->Category->table.'.id = '.$this->PCM->table.'.category');
			$this->db->join($this->table, $this->table.'.id = '.$this->PCM->table.'.product');
			$this->db->limit($per_page, $skip);
			$this->db->order_by($this->table.'.'.$order['order_by'], $order['sort']);
			$result = $this->db->get($this->PCM->table)->result_array();
			return $this->generate($result, $base_url, $per_page, $page_num, $total_rows, $skip, $num_links);
		}
	}

	public function get_total_row($category, $filter) {
		if($category === NULL) {
			foreach($filter as $index => $value) {
				if ($value !== NULL) {
					if ($index === 'keyword') {
						$this->db->group_start();
						$this->db->like('id', $value);
						$this->db->or_like('name', $value);
						$this->db->or_like('slug', $value);
						$this->db->group_end();
					} else {
						$this->db->group_start();
						$this->db->where($index, $value);
						$this->db->group_end();
					}
				}
			}
			$this->db->from($this->table);
			return $this->db->count_all_results();
		} else {
			$this->load->model('Product_Category_Model', 'PCM');
			$this->load->model('Category_Model', 'Category');
			foreach($filter as $index => $value) {
				if ($value !== NULL) {
					if ($index === 'keyword') {
						$this->db->group_start();
						$this->db->like($this->table.'.id', $value);
						$this->db->or_like($this->table.'.name', $value);
						$this->db->or_like($this->table.'.slug', $value);
						$this->db->group_end();
					} else {
						$this->db->group_start();
						$this->db->where($this->table.'.'.$index, $value);
						$this->db->group_end();
					}
				}
			}
			$this->db->group_start();
			$this->db->where($this->PCM->table.'.category', $category);
			$this->db->group_end();
			$this->db->join($this->Category->table, $this->Category->table.'.id = '.$this->PCM->table.'.category');
			$this->db->join($this->table, $this->table.'.id = '.$this->PCM->table.'.product');
			$this->db->from($this->PCM->table);
			return $this->db->count_all_results();
		}
	}

	public function find_product($select, $index) {
		return $this->db->select($select)->get_where($this->table, $index, 1)->row_array();
	}

	public function add_product($data) {
		$result = $this->db->insert($this->table, $data);
		$exist = $this->find_product(SELF::PUBLIC_VIEW_FIELD, array('id' => $data['id']));
		if ($exist !== NULL) {
			$this->set_product_cache($exist['slug'], $exist);
			$this->set_spotlight_cache();
		}
		return $result;
	}

	public function update_product($data, $index) {
		$result = $this->db->update($this->table, $data, $index);
		$exist = $this->find_product(SELF::PUBLIC_VIEW_FIELD, $index);
		if ($exist !== NULL) {
			$this->set_product_cache($exist['slug'], $exist);
			$this->set_spotlight_cache();
		}
		return $result;
	}

	public function remove_product($index) {
		$exist = $this->find_product('slug', $index);
		if ($exist !== NULL) {
			$this->remove_product_cache($exist['slug']);
			$this->db->delete($this->table, $index);
			$this->set_spotlight_cache();
			return TRUE;
		}
		return FALSE;
	}
}
