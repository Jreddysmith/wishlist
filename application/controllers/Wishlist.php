<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Wishlist_Model');
	}

	public function index()
	{
		if(!isset($this->session->userdata['user'])){
			redirect('Log_in_Reg');
		}
		$user_id = $this->session->userdata['user']['id'];
		$myItem = $this->Wishlist_Model->myItem($user_id);
		$item = $this->Wishlist_Model->item($user_id);
		$this->load->view('wishlist', array('myItem' => $myItem, 'item' => $item));
	}

	public function create() 
	{
		if(!isset($this->session->userdata['user'])){
			redirect('Log_in_Reg');
		}
		$this->load->view('create');
	}

	public function add() {
		if(!isset($this->session->userdata['user'])){
			redirect('Log_in_Reg');
		}
		$this->load->library("form_validation");
		$this->form_validation->set_rules("item", "Item", "trim|min_length[3]|required");

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata("item", validation_errors());
			redirect('wishlist');
		} else {
			$input = $this->input->post();
			$user_id = $this->session->userdata['user']['id'];
			$add_item = $this->Wishlist_Model->addItem($input, $user_id);
			if($add_item) {
				$this->Wishlist_Model->insertItem($user_id, $add_item);
				$this->session->set_flashdata("item", "You successfully added an Item");
				redirect('wishlist');
			} else {
				$this->session->set_flashdata("item", "Unable to submit your item, please try again.");
				redirect('wishlist');
			}

		}
	}

	public function addItem($id) {
		if(!isset($this->session->userdata['user'])){
			redirect('Log_in_Reg');
		}
		$user_id = $this->session->userdata['user']['id'];
		$this->Wishlist_Model->insertItem($user_id, $id);
		redirect('wishlist');
	}

	public function removeItem($id) {
		if(!isset($this->session->userdata['user'])){
			redirect('Log_in_Reg');
		}
		$user_id = $this->session->userdata['user']['id'];
		$this->Wishlist_Model->removeItem($user_id, $id);
		redirect('wishlist');
	}

	public function deleteItem($id){
		if(!isset($this->session->userdata['user'])){
			redirect('Log_in_Reg');
		}
		$this->Wishlist_Model->deleteItem($id);
		redirect('wishlist');
	}


	public function item($id) {
		if(!isset($this->session->userdata['user'])){
			redirect('Log_in_Reg');
		}
		$user_id = $this->session->userdata['user']['id'];
		$itemByUser = $this->Wishlist_Model->getItemUsers($id);
		$user = $this->Wishlist_Model->getItem($id);
		$this->load->view('user', array('users' => $itemByUser, 'item' => $user));
	}







}
