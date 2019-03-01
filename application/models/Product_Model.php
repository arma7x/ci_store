<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Model extends MY_Model {

	private CONST PUBLIC_DISPLAY_FIELD = '*';
	public CONST CACHE_PREFIX = 'PM_';
	public $table = 'products';

	public function get_product_cache($slug) {
		return $this->cache->get(SELF::CACHE_PREFIX.SELF::$slug);
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

	public function get_product_list($filter, $base_url, $per_page, $page_num, $num_links) {
		$total_rows = $this->get_total_row($filter);
		$skip = $this->paginate($base_url, $per_page, $page_num, $num_links, $total_rows);
		$select = 'id, username, email, role, access_level, status, avatar,created_at, updated_at, last_logged_in';
		$this->db->select($select);
		foreach($filter as $index => $value) {
			if ($value !== NULL) {
				if ($index === 'keyword') {
					$this->db->group_start();
					$this->db->like('id', $value);
					$this->db->or_like('username', $value);
					$this->db->or_like('email', $value);
					$this->db->group_end();
				} else {
					$this->db->group_start();
					$this->db->where($index, $value);
					$this->db->group_end();
				}
			}
		}
		$this->db->limit($per_page, $skip);
		$this->db->order_by('role', 'ASC');
		$this->db->order_by('access_level', 'ASC');
		$this->db->order_by('status', 'ASC');
		$result = $this->db->get($this->table)->result_array();
		return $result;
	}

	public function get_total_row($filter) {
		foreach($filter as $index => $value) {
			if ($value !== NULL) {
				if ($index === 'keyword') {
					$this->db->group_start();
					$this->db->like('id', $value);
					$this->db->or_like('username', $value);
					$this->db->or_like('email', $value);
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
	}

	public function find_product($select, $index) {
		return $this->db->select($select)->get_where($this->table, $index, 1)->row_array();
	}

	public function add_product($data) {
		$result = $this->db->insert($this->table, $data);
		$exist = $this->find_product(SELF::PUBLIC_DISPLAY_FIELD, array('id' => $data['id']));
		if ($exist !== NULL) {
			$this->set_product_cache($exist['slug'], $exist);
		}
		return $result;
	}

	public function update_product($data, $index) {
		$result = $this->db->update($this->table, $data, $index);
		$exist = $this->find_product(SELF::PUBLIC_DISPLAY_FIELD, array('id' => $data['id']));
		if ($exist !== NULL) {
			$this->set_product_cache($exist['slug'], $exist);
		}
		return $result;
	}

	public function remove_product($data) {
		$exist = $this->find_product('slug', $index);
		if ($exist !== NULL) {
			$this->remove_product_cache($exist['slug']);
			$result = $this->db->delete($this->table, $index);
			return $result;
		}
		return FALSE;
	}
}
