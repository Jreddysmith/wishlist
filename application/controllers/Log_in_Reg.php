<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_in_Reg extends CI_Controller {

	public function index()
	{
		$this->load->view('log_reg');
	}

	public function reg()
	{
		$this->load->library("form_validation");

		$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]');
		$this->form_validation->set_rules('username', 'UserName', 'required|min_length[2]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|md5');
		$this->form_validation->set_rules('pass_con', 'Confirm Password', 'required|matches[password]|min_length[8]|md5');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata("errors", validation_errors());
			redirect('/');
		} else {
			$this->load->model('User_model');
			$input = $this->input->post();
			$add_user = $this->User_model->create_user($input);
		}
		if ($add_user)
		{
			$add_user = $this->User_model->get_user($_POST['email']);
			$this->session->set_flashdata("success_message", "Welcome ".$add_user['name']."! You have successfully registered!");
			$this->session->set_userdata("user", $add_user);
			redirect('Wishlist/index');
		}
	}

	public function login()
	{
		$this->load->library("form_validation");
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|md5');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata("errors", validation_errors());
			redirect('/');
		} else {
			$this->load->model("User_model");
			$input = $this->input->post('email');
			$get_user = $this->User_model->get_user($input);
		}
		if ($get_user)
		{
			$this->session->set_flashdata("success_message", "Welcome".$get_user['first_name']."! You have successfully logged in!");
			$this->session->set_userdata("user", $get_user);
			redirect('Wishlist/index');
		} else {
			$this->session->set_flashdata("errors", "Your email is not in our database! Please register first. ");
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
