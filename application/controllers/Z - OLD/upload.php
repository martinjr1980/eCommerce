<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Item');
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->view('users_admin', array('error' => ' ' ));
	}

	function addProduct()
	{
		$config['upload_path'] = './assets/images/thumbnails/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		// $product_info = $this->input->post();

		if ( ! $this->upload->do_upload())
		{
			$get_data = array('error' => $this->upload->display_errors());
			$get_data['items'] = $this->Item->getItems();
			$this->load->view('users_admin', $get_data);
		}
		else
		{
			$get_data = array('upload_data' => $this->upload->data());
			$file_name = $get_data['upload_data']['file_name'];
			$product_info = $this->input->post();
			$product_info['file_name'] = $file_name;
			$this->Item->addProduct($product_info);
			$this->session->set_flashdata('message', 'PRODUCT SUCCESSFULLY ADDED TO DATABASE!');
			redirect('/users/admin');
		}
	}
}