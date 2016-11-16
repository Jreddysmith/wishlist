<?php 
class Wishlist_Model extends CI_Model {

	public function addItem($input, $user_id) {
		$sql = "INSERT INTO products (item, created_at, updated_at, creator) VALUES (?, NOW(), NOW(), ?)";
		$values = (array($input['item'], $user_id));
		$this->db->query($sql, $values);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	// public function addWishlist($input) {
	// 	$sql = "INSERT INTO products_has_users (user_id, product_id, created_at, updated_at) VALUES (?, ?, NOW(), NOW())";
	// 	$values = (array($input['item']));
	// 	return $this->db->query($sql, $values);

	// }

	public function myItem($user_id) { 
		$sql = "SELECT DISTINCT products.id AS item_id, products.item, products.created_at AS created_at, products.creator AS creator, users.username AS username, users.id AS user_id FROM products JOIN products_has_users ON products.id = products_has_users.product_id JOIN users ON products.creator = users.id WHERE products_has_users.user_id = ? ORDER BY products_has_users.created_at DESC";

		return $this->db->query($sql, $user_id)->result_array(); 
	}
	//if we want hardmode
	// public function getCreator($product_id)
	// {
	// 	$sql = "SELECT users.id AS id, users.username AS username, products.id AS product FROM users JOIN products_has_users ON products_has_users.user_id = users.id JOIN products ON products_has_users.product_id = products.id WHERE products.id = ? ORDER BY products_has_users.created_at DESC LIMIT 1";
	// 	$values = (array($product_id));
	// 	return $this->db->query($sql, $values)->row_array();
	// }

	public function item($user_id) {
		$sql = "SELECT DISTINCT products.item, products.id AS id, users.username AS username, products.creator AS creator, products_has_users.created_at AS created_at FROM products JOIN products_has_users ON products.id = products_has_users.product_id JOIN users ON products.creator = users.id WHERE products.id NOT IN (SELECT DISTINCT products.id FROM products JOIN products_has_users ON products.id = products_has_users.product_id WHERE products_has_users.user_id = ?) ORDER BY products_has_users.created_at DESC";

		return $this->db->query($sql, $user_id, NULL, FALSE)->result_array();
	}

	public function insertItem($user_id, $id) {
		$sql = "INSERT INTO products_has_users (user_id, product_id, created_at, updated_at) VALUES (?, ?, NOW(), NOW())";
		$values = (array($user_id, $id));
		$this->db->query($sql, $values);
	}

	public function removeItem($user_id, $id) {
		$sql = "DELETE FROM products_has_users WHERE user_id = ? AND product_id = ?";
		$values = (array($user_id, $id));
		$this->db->query($sql, $values);
	}

	public function getItemUsers($id) {
		$sql = "SELECT users.username AS username FROM users JOIN products_has_users ON products_has_users.user_id = users.id JOIN products ON products.id = products_has_users.product_id WHERE products.id = ? ";
		return $this->db->query($sql, $id)->result_array();
	}

	public function getItem($id) {
		$sql = "SELECT item FROM products WHERE id = ?";
		return $this->db->query($sql, $id)->row_array();
	}

	public function deleteItem($id){
		$sql1 = "DELETE FROM products_has_users WHERE product_id = ?";
		$sql = "DELETE FROM products WHERE id = ?";
		$values = (array($id));
		$this->db->query($sql1, $values);
		return $this->db->query($sql, $values);
	}
}
