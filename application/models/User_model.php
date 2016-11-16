<?php 
class User_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function get_all()
	{
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function get_user($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		return $query-> row_array();
	}

	public function create_user($input)
	{
		$sql = "INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)";
		$values = (array($input['name'], $input['username'], $input['email'], $input['password']));
		return $this->db->query($sql, $values);
	}
}
