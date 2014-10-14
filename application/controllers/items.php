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
		redirect('/items/success');
	}

	public function success()
	{
		$this->load->view('items_success');
	}

	public function addProduct()
	{
		$product_info = $this->input->post();
		$this->Item->addProduct($product_info);
		$this->session->set_flashdata('message', 'PRODUCT SUCCESSFULLY ADDED TO DATABASE!');
		redirect('/users/admin');
	}

	public function destroy($id)
	{
		$get_data['items'] = $this->Item->getItems();
		$get_data['id'] = $id;
		$this->load->view('items_destroy', $get_data);
	}

	public function remove($id)
	{
		$this->Item->removeProduct($id);
		$this->session->set_flashdata('messages', 'Successfully deleted a product!');
		redirect('/users/admin');
	}
}

//end of main controlle