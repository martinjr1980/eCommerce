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

	function do_upload()
	{
		$config['upload_path'] = './assets/images/thumbnails/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$get_data = array('error' => $this->upload->display_errors());
			$get_data['items'] = $this->Item->getItems();
			$this->load->view('users_admin', $get_data);
		}
		else
		{
			$get_data = array('upload_data' => $this->upload->data());
			$get_data['items'] = $this->Item->getItems();
			$this->session->set_userdata('file_name', $get_data['upload_data']['file_name']);
			$this->load->view('users_admin', $get_data);
		}
	}
}