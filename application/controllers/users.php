<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		$this->load->model('Item');
		$this->load->library('form_validation');
		// $this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('users_login');
	}

	public function add()
	{
		$user = $this->input->post();

		$user_confirm = $this->User->confirmUser($user);  //First, confirm if user is in the database
		if($user_confirm)
		{
			$this->session->set_flashdata('form_errors', '<p>User already exists!</p>');
			redirect('/users');
		}

		//Next, set the form validation rules.
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');
		if($this->form_validation->run())  //If the form was filled out successfully,...
		{
			$this->session->set_flashdata('form_success', 'You have successfully registered!');
			$this->User->addUser($user);
		}
		else  //If the form was not filled out correctly, it will save all the errors...
		{
			$this->session->set_flashdata('form_errors', validation_errors());
		}
		redirect('/users');
	}

	public function login()
	{
		$user = $this->input->post();
		$user_confirm = $this->User->getUser($user);
		if($user_confirm)
		{
			$this->User->addVisit($user_confirm);  //keeps track of how many times user has logged in
			$this->session->set_userdata('first_name', $user_confirm['first_name']);
			$this->session->set_userdata('last_name', $user_confirm['last_name']);
			$this->session->set_userdata('email', $user_confirm['email']);
			$this->session->set_userdata('logged_in', 'true');
			if($user_confirm['admin'])
			{			
				redirect('/users/admin');
			}
			else		
			{
				redirect('/items');
			}
		}
		else
		{
			$this->session->set_flashdata('errors', 'User does not exist!');
			redirect('/users');
		}
	}

	public function admin()
	{
		$get_data['items'] = $this->Item->getItems();
		$this->load->view('users_admin', $get_data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/users');
	}
}

//end of main controller