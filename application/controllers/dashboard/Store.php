<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends MY_Controller {

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
		$this->load->model('Product_Model', 'PM');
	}

	public function index() {
		$this->AllowGetRequest();
		$this->load->model('Category_Model', 'Category');
		$this->load->helper('url');
		$this->data['title'] = $this->container['app_name'].' | '.lang('H_STORE');
		$this->data['page_name'] = str_replace('%s', $this->container['app_name'], lang('H_STORE'));
		$this->data['list'] = $this->EI->get_paginate(current_url(), 10, (int) $this->input->get('page'), TRUE);
		$this->data['cat_list'] = $this->Category->get_all();
		$this->widgets['add_modal'] = 'dashboard/store/widgets/add_modal';
		$this->widgets['update_modal'] = 'dashboard/store/widgets/update_modal';
		$this->widgets['ei_js'] = 'dashboard/store/widgets/js';
		$this->widgets['content'] = 'dashboard/store/index';
		$this->_renderLayout();
	}

	public function find() {
		$exist = $this->EI->find_information('*', array('id' => $this->input->post_get('id')));
		if ($exist === NULL) {
			show_404();
		}
		$this->_renderJSON(200, $exist);
	}

	public function upload() {
		$config['upload_path'] = realpath(dirname(BASEPATH).'/public/static/img/product');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 2048;
		$config['max_width'] = 533;
		$config['max_height'] = 533;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('photo')) {
			$error = array(
				'error' => $this->upload->display_errors('', ''),
				'data' => $this->upload->data()
			);
			$this->_renderJSON(400, $error);
		}
		else {
			$this->_renderJSON(200, $this->upload->data());
		}
	}

	public function add() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'name' => $this->input->post_get('name'),
			'slug' => $this->input->post_get('slug'),
			'price' => (float) $this->input->post_get('price'),
			'visibility' => $this->input->post_get('visibility'),
			'spotlight' => $this->input->post_get('spotlight'),
			'availability' => $this->input->post_get('availability'),
			'category' => $this->input->post_get('category'),
			'main_photo' => $this->input->post_get('main_photo'),
			'second_photo' => $this->input->post_get('second_photo'),
			'third_photo' => $this->input->post_get('third_photo'),
			'fourth_photo' => $this->input->post_get('fourth_photo'),
			'brief_description' => $this->input->post_get('brief_description'),
			'full_description' => $this->input->post_get('full_description')
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|alpha_dash|is_unique[products.id]');
		$this->form_validation->set_rules('name', lang('L_P_NAME'), 'required|max_length[255]');
		$this->form_validation->set_rules('slug', lang('L_P_SLUG'), 'required|alpha_dash|is_unique[products.slug]');
		$this->form_validation->set_rules('price', lang('L_P_PRICE'), 'required|numeric');
		$this->form_validation->set_rules('visibility', lang('L_P_VISIBILITY'), 'required|in_list[0,1]');
		$this->form_validation->set_rules('availability', lang('L_P_AVAILABILITY'), 'required|in_list[0,1]');
		$this->form_validation->set_rules('main_photo', lang('L_P_1_PHOTO'), 'required');
		$this->form_validation->set_rules('brief_description', lang('L_P_BRIEF_DESC'), 'required|max_length[160]');
		$this->form_validation->set_rules('full_description', lang('L_P_FULL_DESC'), 'required');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			$category = $data['category'];
			unset($data['category']);
			$data['price'] = (float) $data['price'];
			$data['visibility'] = (int) $data['visibility'];
			$data['spotlight'] = (int) $data['spotlight'];
			$data['availability'] = (int) $data['availability'];
			$data['created_at'] = time();
			$data['updated_at'] = time();
			$result = $this->PM->add_product($data);
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_ADD_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_ADD_PRODUCT')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_ADD_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_ADD_PRODUCT')));
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
		//$this->form_validation->set_rules('slug', lang('L_P_SLUG'), 'required|alpha_dash');
		$this->form_validation->set_rules('title', lang('L_E_TITLE'), 'required|max_length[255]');
		$this->form_validation->set_rules('brief_description', lang('L_E_BRIEF_DESC'), 'required|max_length[160]');
		$this->form_validation->set_rules('full_description', lang('L_E_FULL_DESC'), 'required');
		$this->form_validation->set_rules('ordering', lang('L_P_PRICE'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('position', lang('L_E_VISIBILITY'), 'required|in_list[-1,0,1]');
		$this->form_validation->set_rules('visibility', lang('L_E_VISIBILITY'), 'required|in_list[0,1]');
		$this->form_validation->set_rules('material_icon', lang('L_ID'), '');
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
		$this->form_validation->set_rules('ordering', lang('L_P_PRICE'), 'required|is_natural_no_zero');
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
		$this->form_validation->set_rules('position', lang('L_E_VISIBILITY'), 'required|in_list[-1,0,1]');
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
			} else if (isset($this->form_validation->error_array()['ordering'])) {
				$error = $this->form_validation->error_array()['ordering'];
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
		$this->form_validation->set_rules('material_icon', lang('L_ID'), '');
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
