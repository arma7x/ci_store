<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

	public $index = array('role' => 1, 'access_level' => 1);
	public $find = array('role' => 1, 'access_level' => 1);
	public $add = array('role' => 1, 'access_level' => 1);
	public $update = array('role' => 1, 'access_level' => 1);
	public $update_order = array('role' => 1, 'access_level' => 1);
	public $delete = array('role' => 1, 'access_level' => 1);

	public function __construct() {
		parent::__construct();
		$this->template = 'widgets/dashboard/template';
		$this->load->model('Category_Model', 'Category');
	}

	public function index() {
		$this->AllowGetRequest();
		$this->data['title'] = $this->container['app_name'].' | '.lang('H_CATEGORY');
		$this->data['page_name'] = str_replace('%s', $this->container['app_name'], lang('H_CATEGORY'));
		$this->data['list'] = $this->Category->get_all();
		$this->widgets['modal_add'] = 'dashboard/category/widgets/add_modal';
		$this->widgets['modal_update'] = 'dashboard/category/widgets/update_modal';
		$this->widgets['js'] = 'dashboard/category/widgets/js';
		$this->widgets['content'] = 'dashboard/category/index';
		$this->_renderLayout();
	}

	public function find() {
		$exist = $this->Category->find_category('*', array('id' => $this->input->post_get('id')));
		if ($exist === NULL) {
			show_404();
		}
		$this->_renderJSON(200, $exist);
	}

	public function add() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'name' => $this->input->post_get('name'),
			'icon' => $this->input->post_get('icon'),
			'ordering' => (int) $this->input->post_get('ordering'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('name', lang('L_CAT_NAME'), 'required');
		$this->form_validation->set_rules('icon', lang('L_CAT_ICON'), 'required');
		$this->form_validation->set_rules('ordering', lang('L_CAT_ORDERING'), 'required|is_natural_no_zero');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			$result = $this->Category->save_category($data);
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_ADD_CATEGORY'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_ADD_CATEGORY')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_ADD_CATEGORY'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_ADD_CATEGORY')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'name' => $this->input->post_get('name'),
			'icon' => $this->input->post_get('icon'),
			'ordering' => (int) $this->input->post_get('ordering'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('name', lang('L_CAT_NAME'), 'required');
		$this->form_validation->set_rules('icon', lang('L_CAT_ICON'), 'required');
		$this->form_validation->set_rules('ordering', lang('L_CAT_ORDERING'), 'required|is_natural_no_zero');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			unset($data['id']);
			$data['ordering'] = (int) $data['ordering'];
			$result = $this->Category->update_category($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_CATEGORY'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_CATEGORY')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_CATEGORY'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_CATEGORY')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update_order() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'ordering' => (int) $this->input->post_get('ordering'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('ordering', lang('L_CAT_ORDERING'), 'required|is_natural_no_zero');
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
			$result = $this->Category->update_category($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_CATEGORY'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_CATEGORY')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_CATEGORY'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_CATEGORY')));
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
			$result = $this->Category->delete_category(array('id' => $this->input->post_get('id')));
			if ($result) {
				$this->load->model('Product_Category_Model', 'PCM');
				$this->PCM->remove_by_product_or_category(array('category' => $this->input->post_get('id')));
				$data = array(
					'message' => lang('M_SUCCESS_DELETE_CATEGORY'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_DELETE_CATEGORY')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_DELETE_CATEGORY'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_DELETE_CATEGORY')));
				$this->_renderJSON(400, $data);
			}
		}
	}
}
