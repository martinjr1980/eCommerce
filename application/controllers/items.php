<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Item');
		$this->load->library('form_validation');
		// $this->output->enable_profiler();
	}

	public function index()
	{
		$get_data['items'] = $this->Item->getItems();
		$this->load->view('items_home', $get_data);
	}

	public function addCart($id)
	{
		$quantity = $this->session->userdata($id);
		$quantity += $this->input->post('qty');
		$this->session->set_userdata($id, $quantity);
		redirect('/items');
	}

	public function yourCart()
	{
		$get_data['items'] = $this->Item->getItems();
		$this->load->view('items_cart', $get_data);
	}

	public function removeCart($id)
	{
		$quantity = $this->session->userdata($id);
		$quantity -= $this->input->post('qty');
		$this->session->set_userdata($id, $quantity);
		redirect('/items/yourcart');
	}

	public function process()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('credit_card', 'Credit Card Number', 'trim|required');
		if($this->form_validation->run())
		{
			redirect('/items/success');
		}
		else
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/items/yourcart');
		}
	}

	public function success()
	{
		$this->load->view('items_success');
		$this->session->sess_destroy();
	}
}

//end of main controlle