<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends MY_Controller {

	public $index = array('role' => 1, 'access_level' => 1);
	public $find = array('role' => 1, 'access_level' => 1);
	public $process_upload = array('role' => 1, 'access_level' => 1);
	public $add = array('role' => 1, 'access_level' => 1);
	public $update = array('role' => 1, 'access_level' => 1);
	public $update_visibility = array('role' => 1, 'access_level' => 1);
	public $update_spotlight = array('role' => 1, 'access_level' => 1);
	public $update_availability = array('role' => 1, 'access_level' => 1);
	public $delete = array('role' => 1, 'access_level' => 1);

	public function __construct() {
		parent::__construct();
		$this->template = 'widgets/dashboard/template';
		$this->widgets['nav'] = 'widgets/dashboard/nav';
		$this->widgets['menu'] = 'widgets/dashboard/menu';
		$this->load->model('Product_Model', 'PM');
	}

	public function index() {
		$this->AllowGetRequest();
		$this->load->model('Category_Model', 'Category');
		$this->load->helper('url');
		$category = $this->input->get('category');
		$ordering = explode('@', $this->input->get('ordering'));
		if (COUNT($ordering) === 1) {
			$order_by = array('order_by' => 'created_at', 'sort' => 'desc');
		} else {
			$order_by = array('order_by' => $ordering[0], 'sort' => $ordering[1]);
		}
		$filters = $this->input->get();
		foreach($filters as $index => $value) {
			if(in_array($index, array('keyword', 'visibility', 'spotlight')) === FALSE) {
				unset($filters[$index]);
			}
		}

		$this->data['title'] = $this->container['app_name'].' | '.lang('H_STORE');
		$this->data['page_name'] = str_replace('%s', $this->container['app_name'], lang('H_STORE'));
		$this->data['list'] = $this->PM->get_product_list($this->PM::ADMIN_SEARCH_FIELD, $this->PM::ADMIN_SEARCH_FIELD_JOIN, $category, $filters, $order_by, current_url(), 10, (int) $this->input->get('page'), TRUE);
		$this->data['cat_list'] = $this->Category->get_all();
		$this->widgets['add_modal'] = 'dashboard/store/widgets/add_modal';
		$this->widgets['update_modal'] = 'dashboard/store/widgets/update_modal';
		$this->widgets['ei_js'] = 'dashboard/store/widgets/js';
		$this->widgets['content'] = 'dashboard/store/index';
		$this->_renderLayout();
	}

	public function find() {
		$exist = $this->PM->find_product('*', array('id' => $this->input->post_get('id')));
		if ($exist === NULL) {
			show_404();
		}
		$this->load->model('Product_Category_Model', 'PCM');
		$category = $this->PCM->get_categories_of_product($this->input->post_get('id'));
		$this->_renderJSON(200, array('product' => $exist, 'category' => $category));
	}

	public function process_upload() {
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
		$second_photo_rule = '';
		if ($this->input->post_get('third_photo') !== '' || $this->input->post_get('fourth_photo') !== '') {
			$second_photo_rule = 'required';
		}
		$third_photo_rule = '';
		if ($this->input->post_get('fourth_photo') !== '') {
			$third_photo_rule = 'required';
		}
		$third_photo_rule = '';
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required|alpha_dash|is_unique[products.id]');
		$this->form_validation->set_rules('name', lang('L_P_NAME'), 'required|max_length[255]');
		$this->form_validation->set_rules('slug', lang('L_P_SLUG'), 'required|alpha_dash|is_unique[products.slug]');
		$this->form_validation->set_rules('price', lang('L_P_PRICE'), 'required|decimal');
		$this->form_validation->set_rules('visibility', lang('L_P_VISIBILITY'), 'required|in_list[0,1]');
		$this->form_validation->set_rules('spotlight', lang('L_P_SPOTLIGHT'), 'required|in_list[0,1]');
		$this->form_validation->set_rules('availability', lang('L_P_AVAILABILITY'), 'required|in_list[0,1]');
		$this->form_validation->set_rules('main_photo', lang('L_P_1_PHOTO'), 'required');
		$this->form_validation->set_rules('second_photo', lang('L_P_2_PHOTO'), $second_photo_rule);
		$this->form_validation->set_rules('third_photo', lang('L_P_3_PHOTO'), $third_photo_rule);
		$this->form_validation->set_rules('brief_description', lang('L_P_BRIEF_DESC'), 'max_length[160]');
		$this->form_validation->set_rules('full_description', lang('L_P_FULL_DESC'), 'required');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			$categories = array();
			$category = $data['category'];
			$raw = explode('&', $category);
			foreach($raw as $index => $item) {
				$raw_item = explode('=', $item);
				array_push($categories, $raw_item[1]);
			}
			unset($data['category']);
			$data['price'] = round((float) $data['price'], 2);
			$data['visibility'] = (int) $data['visibility'];
			$data['spotlight'] = (int) $data['spotlight'];
			$data['availability'] = (int) $data['availability'];
			$data['created_at'] = time();
			$data['updated_at'] = time();
			$result = $this->PM->add_product($data);
			if ($result) {
				if (COUNT($categories) > 0) {
					$this->load->model('Product_Category_Model', 'PCM');
					$this->PCM->add_product_categories($data['id'], $categories);
				}
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
			'name' => $this->input->post_get('name'),
			//'slug' => $this->input->post_get('slug'),
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
		$second_photo_rule = '';
		if ($this->input->post_get('third_photo') !== '' || $this->input->post_get('fourth_photo') !== '') {
			$second_photo_rule = 'required';
		}
		$third_photo_rule = '';
		if ($this->input->post_get('fourth_photo') !== '') {
			$third_photo_rule = 'required';
		}
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required');
		$this->form_validation->set_rules('name', lang('L_P_NAME'), 'required|max_length[255]');
		//$this->form_validation->set_rules('slug', lang('L_P_SLUG'), 'required|alpha_dash|is_unique[products.slug]');
		$this->form_validation->set_rules('price', lang('L_P_PRICE'), 'required|decimal');
		$this->form_validation->set_rules('visibility', lang('L_P_VISIBILITY'), 'required|in_list[0,1]');
		$this->form_validation->set_rules('spotlight', lang('L_P_SPOTLIGHT'), 'required|in_list[0,1]');
		$this->form_validation->set_rules('availability', lang('L_P_AVAILABILITY'), 'required|in_list[0,1]');
		$this->form_validation->set_rules('main_photo', lang('L_P_1_PHOTO'), 'required');
		$this->form_validation->set_rules('second_photo', lang('L_P_2_PHOTO'), $second_photo_rule);
		$this->form_validation->set_rules('third_photo', lang('L_P_3_PHOTO'), $third_photo_rule);
		$this->form_validation->set_rules('brief_description', lang('L_P_BRIEF_DESC'), 'max_length[160]');
		$this->form_validation->set_rules('full_description', lang('L_P_FULL_DESC'), 'required');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'errors' => $this->form_validation->error_array()
			);
			$this->_renderJSON(400, $data);
		} else {
			$categories = array();
			$category = $data['category'];
			$raw = explode('&', $category);
			foreach($raw as $index => $item) {
				$raw_item = explode('=', $item);
				array_push($categories, $raw_item[1]);
			}
			unset($data['id']);
			unset($data['category']);
			$data['price'] = round((float) $data['price'], 2);
			$data['visibility'] = (int) $data['visibility'];
			$data['spotlight'] = (int) $data['spotlight'];
			$data['availability'] = (int) $data['availability'];
			$data['updated_at'] = time();
			$result = $this->PM->update_product($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				if (COUNT($categories) > 0) {
					$this->load->model('Product_Category_Model', 'PCM');
					$this->PCM->add_product_categories($this->input->post_get('id'), $categories);
				}
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_PRODUCT')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_PRODUCT')));
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
		$this->form_validation->set_rules('id', lang('L_ID'), 'required');
		$this->form_validation->set_rules('visibility', lang('L_P_VISIBILITY'), 'required|in_list[0,1]');
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
			$result = $this->PM->update_product($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_PRODUCT')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_PRODUCT')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update_spotlight() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'spotlight' => $this->input->post_get('spotlight'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required');
		$this->form_validation->set_rules('spotlight', lang('L_P_SPOTLIGHT'), 'required|in_list[0,1]');
		if ($this->form_validation->run() === FALSE) {
			$error = '';
			if (isset($this->form_validation->error_array()['id'])) {
				$error = $this->form_validation->error_array()['id'];
			} else if (isset($this->form_validation->error_array()['spotlight'])) {
				$error = $this->form_validation->error_array()['spotlight'];
			}
			$data = array(
				'message' => $error
			);
			$this->_renderJSON(400, $data);
		} else {
			unset($data['id']);
			$data['spotlight'] = (int) $data['spotlight'];
			$result = $this->PM->update_product($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_PRODUCT')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_PRODUCT')));
				$this->_renderJSON(400, $data);
			}
		}
	}

	public function update_availability() {
		$this->BlockGetRequest();
		$this->load->library('form_validation');
		$data = array(
			'id' => $this->input->post_get('id'),
			'availability' => $this->input->post_get('availability'),
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('id', lang('L_ID'), 'required');
		$this->form_validation->set_rules('availability', lang('L_P_AVAILABILITY'), 'required|in_list[0,1]');
		if ($this->form_validation->run() === FALSE) {
			$error = '';
			if (isset($this->form_validation->error_array()['id'])) {
				$error = $this->form_validation->error_array()['id'];
			} else if (isset($this->form_validation->error_array()['availability'])) {
				$error = $this->form_validation->error_array()['availability'];
			}
			$data = array(
				'message' => $error
			);
			$this->_renderJSON(400, $data);
		} else {
			unset($data['id']);
			$data['availability'] = (int) $data['availability'];
			$result = $this->PM->update_product($data, array('id' => $this->input->post_get('id')));
			if ($result) {
				$data = array(
					'message' => lang('M_SUCCESS_UPDATE_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_UPDATE_PRODUCT')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_UPDATE_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_UPDATE_PRODUCT')));
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
		$this->form_validation->set_rules('id', lang('L_ID'), 'required');
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'message' => $error = $this->form_validation->error_array()['id']
			);
			$this->_renderJSON(400, $data);
		} else {
			$result = $this->PM->remove_product(array('id' => $this->input->post_get('id')));
			if ($result) {
				$this->load->model('Product_Category_Model', 'PCM');
				$this->PCM->remove_by_product_or_category(array('product' => $this->input->post_get('id')));
				$data = array(
					'message' => lang('M_SUCCESS_DELETE_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_SUCCESS_DELETE_PRODUCT')));
				$this->_renderJSON(200, $data);
			} else {
				$data = array(
					'message' => lang('M_FAIL_DELETE_PRODUCT'),
				);
				$this->session->set_flashdata('__notification', array('type' => 'success', 'message'=>lang('M_FAIL_DELETE_PRODUCT')));
				$this->_renderJSON(400, $data);
			}
		}
	}
}
