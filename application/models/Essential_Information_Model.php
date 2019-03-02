<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Essential_Information_Model extends MY_Model {

	private CONST PUBLIC_VIEW_FIELD = 'slug, title, position, visibility, material_icon, brief_description, full_description, updated_at';
	private CONST PUBLIC_FIELD = 'title, slug, position, material_icon';
	public CONST CACHE_PREFIX = 'EI_';
	public CONST ALL_CACHE = 'CACHE_SLUG';
	public $table = 'essential_informations';

	public function set_all_cache() {
		$this->db->select(SELF::PUBLIC_FIELD);
		$this->db->where('visibility', 1);
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

	public function set_slug_cache($slug, $cache) {
		if ((int) $cache['visibility'] === 0) {
			$this->remove_slug_cache($slug);
			return NULL;
		}
		return $this->cache->save(SELF::CACHE_PREFIX.$slug, $cache, 18144000);
	}

	public function get_slug_cache($slug) {
		$cached = $this->cache->get(SELF::CACHE_PREFIX.$slug);
		if ($cached !== FALSE) {
			return $cached;
		} else {
			$exist = $this->find_information(SELF::PUBLIC_VIEW_FIELD, array('slug' => $slug, 'visibility' => 1));
			if ($exist !== NULL) {
				$this->set_slug_cache($exist['slug'], $exist);
				$this->set_all_cache();
				return $exist;
			} else {
				return NULL;
			}
		}
	}

	public function remove_slug_cache($slug) {
		return $this->cache->delete(SELF::CACHE_PREFIX.$slug);
	}

	public function get_total_row() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_paginate($base_url, $per_page, $page_num, $num_links) {
		$total_rows = $this->get_total_row();
		$skip = $this->paginate($base_url, $per_page, $page_num, $num_links, $total_rows);
		$select = '*';
		$this->db->select($select);
		$this->db->limit($per_page, $skip);
		$this->db->order_by('ordering', 'ASC');
		$result = $this->db->get($this->table)->result_array();
		return $result;
	}

	public function find_information($select, $index) {
		return $this->db->select($select)->get_where($this->table, $index, 1)->row_array();
	}

	public function save_information($data) {
		$result = $this->db->insert($this->table, $data);
		$exist = $this->find_information(SELF::PUBLIC_VIEW_FIELD, array('slug' => $data['slug']));
		if ($exist !== NULL) {
			$this->set_slug_cache($exist['slug'], $exist);
		}
		$this->set_all_cache();
		return $result;
	}

	public function update_information($data, $index) {
		$result = $this->db->update($this->table, $data, $index);
		$exist = $this->find_information(SELF::PUBLIC_VIEW_FIELD, $index);
		if ($exist !== NULL) {
			$this->set_slug_cache($exist['slug'], $exist);
		}
		$this->set_all_cache();
		return $result;
	}

	public function delete_information($index) {
		$exist = $this->find_information('slug', $index);
		if ($exist !== NULL) {
			$this->remove_slug_cache($exist['slug']);
			$result = $this->db->delete($this->table, $index);
			$this->set_all_cache();
			return $result;
		}
		return FALSE;
	}
}
