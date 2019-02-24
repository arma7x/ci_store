<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_Information_Model extends MY_Model {

	public CONST CACHE_PREFIX = 'GI_';
	public CONST ALL_CACHE = 'CACHE_GI';
	public $table = 'general_informations';

	public function set_all_cache() {
		$this->cache->save(SELF::CACHE_PREFIX.SELF::ALL_CACHE, $this->get_all(), 18144000);
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
		$key_value = array();
		$items = $this->db->get($this->table)->result_array();
		foreach($items as $index => $item) {
			$key_value[$item['id']] = $item['value'];
		}
		return $key_value;
	}

	public function update_information($data) {
		$ids = array();
		$batch = array();
		foreach($data as $index => $value) {
			$pushed = array('id' => $index, 'value' => $value);
			array_push($batch, $pushed);
			array_push($ids, "'".$index."'");
		}
		$this->db->query("DELETE FROM ".$this->table." WHERE id IN (".implode(',', $ids).")");
		$result = $this->db->insert_batch($this->table, $batch);
		$this->set_all_cache();
		return $result;
	}
}
