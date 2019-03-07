<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Essential_information extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->AllowGetRequest();
	}

	public function slug() {
		$this->load->model('Essential_Information_Model', 'EI');
		$cached = $this->EI->get_slug_cache($this->uri->segment(1));
		if ($cached === FALSE) {
			show_404();
		}
		$this->output->set_header('Sw-Offline-Cache: true');
		$this->data['title'] = $this->container['app_name'].' | '.$cached['title'];
		$this->data['description'] = $cached['brief_description'];
		$this->data['page_name'] = $cached['title'];
		$this->data['ei_content'] = $cached;
		$this->widgets['content'] = 'essential_information';
		$this->_renderLayout();
	}

}
