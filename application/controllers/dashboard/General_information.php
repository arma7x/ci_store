<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_information extends MY_Controller {

	public $index = array('role' => 1, 'access_level' => 1);
	public $update_general_information = array('role' => 1, 'access_level' => 1);
	public $find_social_channel = array('role' => 1, 'access_level' => 1);
	public $add_social_channel = array('role' => 1, 'access_level' => 1);
	public $update_social_channel = array('role' => 1, 'access_level' => 1);
	public $update_social_channel_order = array('role' => 1, 'access_level' => 1);
	public $delete_social_channel = array('role' => 1, 'access_level' => 1);
	public $find_inbox_channel = array('role' => 1, 'access_level' => 1);
	public $add_inbox_channel = array('role' => 1, 'access_level' => 1);
	public $update_inbox_channel = array('role' => 1, 'access_level' => 1);
	public $update_inbox_channel_order = array('role' => 1, 'access_level' => 1);
	public $delete_inbox_channel = array('role' => 1, 'access_level' => 1);

	public function __construct() {
		parent::__construct();
		$this->template = 'widgets/dashboard/template';
		$this->widgets['nav'] = 'widgets/dashboard/nav';
		$this->widgets['menu'] = 'widgets/dashboard/menu';
		$this->load->model('General_Information_Model', 'GI');
		$this->load->model('Social_Channel_Model', 'SC');
		$this->load->model('Inbox_Channel_Model', 'IC');
	}

	public function index() {
		$this->AllowGetRequest();
		$this->data['title'] = $this->container['app_name'].' | '.lang('H_GENERAL_INFORMATION');
		$this->data['page_name'] = str_replace('%s', $this->container['app_name'], lang('H_GENERAL_INFORMATION'));
		$this->data['gi_item'] = $this->GI->get_all();
		$this->data['sc_list'] = $this->SC->get_all();
		$this->data['ic_list'] = $this->IC->get_all();
		$this->widgets['general_info'] = 'dashboard/general_information/widgets/general_info';
		$this->widgets['social_channel'] = 'dashboard/general_information/widgets/social/index';
		$this->widgets['inbox_channel'] = 'dashboard/general_information/widgets/inbox/index';
		$this->widgets['sc_modal_add'] = 'dashboard/general_information/widgets/social/add_modal';
		$this->widgets['sc_modal_update'] = 'dashboard/general_information/widgets/social/update_modal';
		$this->widgets['ic_modal_add'] = 'dashboard/general_information/widgets/inbox/add_modal';
		$this->widgets['ic_modal_update'] = 'dashboard/general_information/widgets/inbox/update_modal';
		$this->widgets['gi_js'] = 'dashboard/general_information/widgets/js';
		$this->widgets['content'] = 'dashboard/general_information/index';
		$this->_renderLayout();
	}

	public function update_general_information() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'name' => $this->input->post_get('name'),
			'description' => $this->input->post_get('description'),
			'currency_unit' => $this->input->post_get('currency_unit'),
			'address' => $this->input->post_get('address'),
			'email' => $this->input->post_get('email'),
			'office_number' => $this->input->post_get('office_number'),
			'mobile_number' => $this->input->post_get('mobile_number'),
			//'working_hours' => $this->input->post_get('working_hours'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('name', lang('L_G_NAME'), 'required');
		$this->form_validation->set_rules('description', lang('L_G_DESCRIPTION'), 'required|max_length[160]');
		$this->form_validation->set_rules('currency_unit', lang('L_G_CURRENCY_UNIT'), 'required');
		$this->form_validation->set_rules('address', lang('L_G_ADDRESS').' & '.lang('L_G_ADDRESS'), '');
		$this->form_validation->set_rules('email', lang('L_EMAIL'), 'valid_email');
		$this->form_validation->set_rules('office_number', lang('L_G_OFFICE_NUMBER'), '');
		$this->form_validation->set_rules('mobile_number', lang('L_G_MOBILE_NUMBER'), '');
		//$this->form_validation->set_rules('working_hours', lang('L_G_WORKING_HOUR'), '');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			$result = $this->GI->update_information($data);
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_G_INFORMATION'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_G_INFORMATION')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_G_INFORMATION'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_G_INFORMATION')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function find_social_channel() {
		$exist = $this->SC->find_social('*', array('id' => $this->input->post_get('id')));
		if ($exist === NULL) {
			show_404();
		}
		$this->_renderJSON(200, $exist);
	}

	public function add_social_channel() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'name' => $this->input->post_get('name'),
			'icon' => $this->input->post_get('icon'),
			'url' => $this->input->post_get('url'),
			'ordering' => (int) $this->input->post_get('ordering'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('name', lang('L_S_C_NAME'), 'required');
		$this->form_validation->set_rules('icon', lang('L_S_C_ICON'), 'required');
		$this->form_validation->set_rules('url', lang('L_S_C_URL'), 'required');
		$this->form_validation->set_rules('ordering', lang('L_S_C_ORDERING'), 'required|is_natural_no_zero');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			$result = $this->SC->save_social($data);
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_ADD_SOCIAL_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_ADD_SOCIAL_CHANNEL')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_ADD_SOCIAL_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_ADD_SOCIAL_CHANNEL')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update_social_channel() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'name' => $this->input->post_get('name'),
			'icon' => $this->input->post_get('icon'),
			'url' => $this->input->post_get('url'),
			'ordering' => (int) $this->input->post_get('ordering'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('name', lang('L_S_C_NAME'), 'required');
		$this->form_validation->set_rules('icon', lang('L_S_C_ICON'), 'required');
		$this->form_validation->set_rules('url', lang('L_S_C_URL'), 'required');
		$this->form_validation->set_rules('ordering', lang('L_S_C_ORDERING'), 'required|is_natural_no_zero');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			unset($data['id']);
			$result = $this->SC->update_social($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_SOCIAL_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_SOCIAL_CHANNEL')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_SOCIAL_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_SOCIAL_CHANNEL')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update_social_channel_order() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'ordering' => (int) $this->input->post_get('ordering'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('ordering', lang('L_S_C_ORDERING'), 'required|is_natural_no_zero');
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
			$result = $this->SC->update_social($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_SOCIAL_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_SOCIAL_CHANNEL')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_SOCIAL_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_SOCIAL_CHANNEL')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function delete_social_channel() {
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
			$result = $this->SC->delete_social(array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_DELETE_SOCIAL_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_DELETE_SOCIAL_CHANNEL')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_DELETE_SOCIAL_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_DELETE_SOCIAL_CHANNEL')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function find_inbox_channel() {
		$exist = $this->IC->find_inbox('*', array('id' => $this->input->post_get('id')));
		if ($exist === NULL) {
			show_404();
		}
		$this->_renderJSON(200, $exist);
	}

	public function add_inbox_channel() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'name' => $this->input->post_get('name'),
			'icon' => $this->input->post_get('icon'),
			'url' => $this->input->post_get('url'),
			'ordering' => (int) $this->input->post_get('ordering'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('name', lang('L_S_C_NAME'), 'required');
		$this->form_validation->set_rules('icon', lang('L_S_C_ICON'), 'required');
		$this->form_validation->set_rules('url', lang('L_S_C_URL'), 'required');
		$this->form_validation->set_rules('ordering', lang('L_S_C_ORDERING'), 'required|is_natural_no_zero');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			$result = $this->IC->save_inbox($data);
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_ADD_INBOX_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_ADD_INBOX_CHANNEL')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_ADD_INBOX_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_ADD_INBOX_CHANNEL')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update_inbox_channel() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'name' => $this->input->post_get('name'),
			'icon' => $this->input->post_get('icon'),
			'url' => $this->input->post_get('url'),
			'ordering' => (int) $this->input->post_get('ordering'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('name', lang('L_S_C_NAME'), 'required');
		$this->form_validation->set_rules('icon', lang('L_S_C_ICON'), 'required');
		$this->form_validation->set_rules('url', lang('L_S_C_URL'), 'required');
		$this->form_validation->set_rules('ordering', lang('L_S_C_ORDERING'), 'required|is_natural_no_zero');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			unset($data['id']);
			$result = $this->IC->update_inbox($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_INBOX_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_INBOX_CHANNEL')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_INBOX_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_INBOX_CHANNEL')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update_inbox_channel_order() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'ordering' => (int) $this->input->post_get('ordering'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|is_natural_no_zero');
		$this->form_validation->set_rules('ordering', lang('L_S_C_ORDERING'), 'required|is_natural_no_zero');
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
			$result = $this->IC->update_inbox($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_INBOX_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_INBOX_CHANNEL')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_INBOX_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_INBOX_CHANNEL')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function delete_inbox_channel() {
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
			$result = $this->IC->delete_inbox(array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_DELETE_INBOX_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_DELETE_INBOX_CHANNEL')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_DELETE_INBOX_CHANNEL'),
				);
				//$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_DELETE_INBOX_CHANNEL')));
				$this->_renderJSON(400, $data);
			}
		}
	}
}
