<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function general_information() {
		$this->AllowGetRequest();
		$this->_renderJSON(200, $this->container['gi_link']);
	}

	public function essential_information() {
		$this->AllowGetRequest();
		$this->_renderJSON(200, $this->container['ei_link']);
	}

	public function essential_information_content() {
		$this->load->model('Essential_Information_Model', 'EI');
		$cached = $this->EI->get_slug_cache($this->uri->segment(4));
		if ($cached === FALSE) {
			show_404();
		}
		$this->_renderJSON(200, $cached);
	}

	public function social_channel() {
		$this->AllowGetRequest();
		$this->_renderJSON(200, $this->container['sc_link']);
	}

	public function inbox_channel() {
		$this->AllowGetRequest();
		$this->_renderJSON(200, $this->container['ic_link']);
	}

}
