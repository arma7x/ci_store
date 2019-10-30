<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_Model extends MY_Model {

	public static $PUBLIC_FIELD = 'id, icon, name';
	public static $CACHE_PREFIX = 'CAT_';
	public static $ALL_CACHE = 'CACHE_CAT';
	public $table = 'categories';

	public function set_all_cache() {
		$this->db->select(SELF::$PUBLIC_FIELD);
		$this->db->order_by('ordering', 'ASC');
		$this->cache->save(SELF::$CACHE_PREFIX.SELF::$ALL_CACHE, $this->db->get($this->table)->result_array(), 18144000);
		return $this->get_all_cache();
	}

	public function get_all_cache() {
		$cached = $this->cache->get(SELF::$CACHE_PREFIX.SELF::$ALL_CACHE);
		if ($cached === FALSE) {
			return $this->set_all_cache();
		}
		return $cached;
	}

	public function get_all() {
		$this->db->select('*');
		$this->db->order_by('ordering', 'ASC');
		$result = $this->db->get($this->table)->result_array();
		return $result;
	}

	public function find_category($select, $index) {
		return $this->db->select($select)->get_where($this->table, $index, 1)->row_array();
	}

	public function save_category($data) {
		$result = $this->db->insert($this->table, $data);
		$this->set_all_cache();
		return $result;
	}

	public function update_category($data, $index) {
		$result = $this->db->update($this->table, $data, $index);
		$this->set_all_cache();
		return $result;
	}

	public function delete_category($index) {
		$exist = $this->find_category('id', $index);
		if ($exist !== NULL) {
			$result = $this->db->delete($this->table, $index);
			$this->set_all_cache();
			return $result;
		}
		return FALSE;
	}
}
