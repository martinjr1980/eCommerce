<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Item');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
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

	public function process()  //created this method in case I need to do form validation
	{
		redirect('/items/success');
	}

	public function success()
	{
		$this->load->view('items_success');
	}

	public function addProduct()
	{
		$config['upload_path'] = './assets/images/thumbnails/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '180';
		$config['max_height']  = '150';
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload())
		{
			$get_data = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', $get_data['error']);
			redirect('/users/admin');
		}
		else
		{
			$get_data = array('upload_data' => $this->upload->data());
			$product_info = $this->input->post();
			$product_info['file_name'] = $get_data['upload_data']['file_name'];
			$this->Item->addProduct($product_info);
			$this->session->set_flashdata('message', 'Product Successfully Added!');
			redirect('/users/admin');
		}
	}

	public function confirm_remove($id)
	{
		$get_data['items'] = $this->Item->getItems();
		$get_data['id'] = $id;
		$this->load->view('items_confirm_remove', $get_data);
	}

	public function remove($id)
	{
		$this->Item->removeProduct($id);
		$this->session->set_flashdata('messages', 'Successfully deleted a product!');
		redirect('/users/admin');
	}
}

//end of main controlle