<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Essential_information extends MY_Controller {

	public $index = array('role' => 1, 'access_level' => 1);
	public $find = array('role' => 1, 'access_level' => 1);
	public $add = array('role' => 1, 'access_level' => 1);
	public $update = array('role' => 1, 'access_level' => 1);
	public $update_order = array('role' => 1, 'access_level' => 1);
	public $update_position = array('role' => 1, 'access_level' => 1);
	public $update_visibility = array('role' => 1, 'access_level' => 1);
	public $update_icon = array('role' => 1, 'access_level' => 1);
	public $delete = array('role' => 1, 'access_level' => 1);

	public function __construct() {
		parent::__construct();
		$this->template = 'widgets/dashboard/template';
		$this->widgets['nav'] = 'widgets/dashboard/nav';
		$this->widgets['menu'] = 'widgets/dashboard/menu';
		$this->load->model('Essential_Information_Model', 'EI');
	}

	public function index() {
		$this->AllowGetRequest();
		$this->load->helper('url');
		$this->data['title'] = $this->container['app_name'].' | '.lang('H_ESSENTIAL_INFORMATION');
		$this->data['page_name'] = str_replace('%s', $this->container['app_name'], lang('H_ESSENTIAL_INFORMATION'));
		$this->data['list'] = $this->EI->get_paginate(current_url(), 10, (int) $this->input->get('page'), TRUE);
		$this->widgets['add_modal'] = 'dashboard/essential_information/widgets/add_modal';
		$this->widgets['update_modal'] = 'dashboard/essential_information/widgets/update_modal';
		$this->widgets['ei_js'] = 'dashboard/essential_information/widgets/js';
		$this->widgets['content'] = 'dashboard/essential_information/index';
		$this->_renderLayout();
	}

	public function find() {
		$exist = $this->EI->find_information('*', array('id' => $this->input->post_get('id')));
		if ($exist === NULL) {
			show_404();
		}
		$this->_renderJSON(200, $exist);
	}

	public function add() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'slug' => $this->input->post_get('slug'),
			'title' => $this->input->post_get('title'),
			'brief_description' => $this->input->post_get('brief_description'),
			'full_description' => $this->input->post_get('full_description'),
			'ordering' => $this->input->post_get('ordering'),
			'position' => $this->input->post_get('position'),
			'visibility' => $this->input->post_get('visibility'),
			'material_icon' => $this->input->post_get('material_icon'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('slug', lang('L_E_SLUG'), 'required|alpha_dash|is_unique[essential_informations.slug]');
		$this->form_validation->set_rules('title', lang('L_E_TITLE'), 'required|max_length[255]');
		$this->form_validation->set_rules('brief_description', lang('L_E_BRIEF_DESC'), 'required|max_length[160]');
		$this->form_validation->set_rules('full_description', lang('L_E_FULL_DESC'), 'required');
		$this->form_validation->set_rules('ordering', lang('L_E_ORDERING'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('position', lang('L_E_POSITION'), 'required|in_list[-1,0,1]');
		$this->form_validation->set_rules('visibility', lang('L_E_VISIBILITY'), 'required|in_list[0,1]');
		$this->form_validation->set_rules('material_icon', lang('L_E_MATERIAL_ICON'), '');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			$data['ordering'] = (int) $data['ordering'];
			$data['position'] = (int) $data['position'];
			$data['visibility'] = (int) $data['visibility'];
			$data['created_at'] = time();
			$data['updated_at'] = time();
			$result = $this->EI->save_information($data);
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_ADD_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_ADD_E_INFORMATION')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_ADD_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_ADD_E_INFORMATION')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			//'slug' => $this->input->post_get('slug'),
			'title' => $this->input->post_get('title'),
			'brief_description' => $this->input->post_get('brief_description'),
			'full_description' => $this->input->post_get('full_description'),
			'ordering' => $this->input->post_get('ordering'),
			'position' => $this->input->post_get('position'),
			'visibility' => $this->input->post_get('visibility'),
			'material_icon' => $this->input->post_get('material_icon'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		//$this->form_validation->set_rules('slug', lang('L_E_SLUG'), 'required|alpha_dash');
		$this->form_validation->set_rules('title', lang('L_E_TITLE'), 'required|max_length[255]');
		$this->form_validation->set_rules('brief_description', lang('L_E_BRIEF_DESC'), 'required|max_length[160]');
		$this->form_validation->set_rules('full_description', lang('L_E_FULL_DESC'), 'required');
		$this->form_validation->set_rules('ordering', lang('L_E_ORDERING'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('position', lang('L_E_POSITION'), 'required|in_list[-1,0,1]');
		$this->form_validation->set_rules('visibility', lang('L_E_VISIBILITY'), 'required|in_list[0,1]');
		$this->form_validation->set_rules('material_icon', lang('L_E_MATERIAL_ICON'), '');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			unset($data['id']);
			$data['ordering'] = (int) $data['ordering'];
			$data['position'] = (int) $data['position'];
			$data['visibility'] = (int) $data['visibility'];
			$data['updated_at'] = time();
			$result = $this->EI->update_information($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_E_INFORMATION')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_E_INFORMATION')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update_order() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'ordering' => $this->input->post_get('ordering'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('ordering', lang('L_E_ORDERING'), 'required|is_natural_no_zero');
		if ($this->form_validation->run() === FALSE) {
			$error = '';
			if (isset($this->form_validation->error_array()['id'])) {
				$error = $this->form_validation->error_array()['id'];
			} else if (isset($this->form_validation->error_array()['ordering'])) {
				$error = $this->form_validation->error_array()['ordering'];
			}
			$data = array(
				'message' => $error
			);
			$this->_renderJSON(400, $data);
		} else {
			unset($data['id']);
			$data['ordering'] = (int) $data['ordering'];
			$result = $this->EI->update_information($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_E_INFORMATION')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_E_INFORMATION')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update_position() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'position' => $this->input->post_get('position'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('position', lang('L_E_POSITION'), 'required|in_list[-1,0,1]');
		if ($this->form_validation->run() === FALSE) {
			$error = '';
			if (isset($this->form_validation->error_array()['id'])) {
				$error = $this->form_validation->error_array()['id'];
			} else if (isset($this->form_validation->error_array()['position'])) {
				$error = $this->form_validation->error_array()['position'];
			}
			$data = array(
				'message' => $error
			);
			$this->_renderJSON(400, $data);
		} else {
			unset($data['id']);
			$data['position'] = (int) $data['position'];
			$result = $this->EI->update_information($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_E_INFORMATION')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_E_INFORMATION')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update_visibility() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'visibility' => $this->input->post_get('visibility'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('visibility', lang('L_E_VISIBILITY'), 'required|in_list[0,1]');
		if ($this->form_validation->run() === FALSE) {
			$error = '';
			if (isset($this->form_validation->error_array()['id'])) {
				$error = $this->form_validation->error_array()['id'];
			} else if (isset($this->form_validation->error_array()['visibility'])) {
				$error = $this->form_validation->error_array()['visibility'];
			}
			$data = array(
				'message' => $error
			);
			$this->_renderJSON(400, $data);
		} else {
			unset($data['id']);
			$data['visibility'] = (int) $data['visibility'];
			$result = $this->EI->update_information($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_E_INFORMATION')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_E_INFORMATION')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update_icon() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'material_icon' => $this->input->post_get('material_icon'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('material_icon', lang('L_E_MATERIAL_ICON'), '');
		if ($this->form_validation->run() === FALSE) {
			$error = '';
			if (isset($this->form_validation->error_array()['id'])) {
				$error = $this->form_validation->error_array()['id'];
			} else if (isset($this->form_validation->error_array()['material_icon'])) {
				$error = $this->form_validation->error_array()['material_icon'];
			}
			$data = array(
				'message' => $error
			);
			$this->_renderJSON(400, $data);
		} else {
			unset($data['id']);
			$data['material_icon'] = $data['material_icon'];
			$result = $this->EI->update_information($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_E_INFORMATION')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_E_INFORMATION')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function delete() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'message' => $error = $this->form_validation->error_array()['id']
			);
			$this->_renderJSON(400, $data);
		} else {
			$result = $this->EI->delete_information(array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_DELETE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_DELETE_E_INFORMATION')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_DELETE_E_INFORMATION'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_DELETE_E_INFORMATION')));
				$this->_renderJSON(400, $data);
			}
		}
	}
}
