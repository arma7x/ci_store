<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox_Channel_Model extends MY_Model {

	private CONST PUBLIC_FOOTER_FIELD = 'id, icon, name, url';
	public CONST CACHE_PREFIX = 'IC_';
	public CONST ALL_CACHE = 'CACHE_IC';
	public $table = 'inbox_channels';

	public function set_all_cache() {
		$this->db->select(SELF::PUBLIC_FOOTER_FIELD);
		$this->db->order_by('ordering', 'ASC');
		$this->cache->save(SELF::CACHE_PREFIX.SELF::ALL_CACHE, $this->db->get($this->table)->result_array(), 18144000);
		return $this->get_all_cache();
	}

	public function get_all_cache() {
		$cached = $this->cache->get(SELF::CACHE_PREFIX.SELF::ALL_CACHE);
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

	public function find_inbox($select, $index) {
		return $this->db->select($select)->get_where($this->table, $index, 1)->row_array();
	}

	public function save_inbox($data) {
		$result = $this->db->insert($this->table, $data);
		$this->set_all_cache();
		return $result;
	}

	public function update_inbox($data, $index) {
		$result = $this->db->update($this->table, $data, $index);
		$this->set_all_cache();
		return $result;
	}

	public function delete_inbox($index) {
		$exist = $this->find_inbox('id', $index);
		if ($exist !== NULL) {
			$result = $this->db->delete($this->table, $index);
			$this->set_all_cache();
			return $result;
		}
		return FALSE;
	}
}
