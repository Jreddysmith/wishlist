<!DOCTYPE html>
<html>
<head>
	<title>Wishlist</title>
	<style type="text/css">
						table {
		color: #333; /* Lighten up font color */
		font-family: Helvetica, Arial, sans-serif; /* Nicer font */
		width: 640px;
		border-collapse:
		collapse; border-spacing: 0;
		}

		td, th { border: 1px solid #CCC; height: 30px; } /* Make cells a bit taller */

		th {
		background: #F3F3F3; /* Light grey background */
		font-weight: bold; /* Make sure they're bold */
		}

		td {
		background: #FAFAFA; /* Lighter grey background */
		text-align: center; /* Center our text */
		}
	</style>
</head>
<body>
	<?php 
	if ($this->session->flashdata("errors")){
		echo $this->session->flashdata("errors");
	}
	if ($this->session->flashdata("success_message")){
		echo $this->session->flashdata("success_message");
	}
	?>

	<a href="/Log_in_Reg/logout">Logout</a>	
	<h1>Welcome, <?= $this->session->userdata['user']['username'] ?></h1>
	<div>
	<p>Your Wish List:</p>
	<table>
	<tr>
		<th>Item</th>
		<th>Added by</th>
		<th>Date Added</th>
		<th>Action</th>
	</tr>
<?php
		foreach($myItem as $myItems) {
?>


	<tr>
		<td><a href="/Wishlist/item/<?= $myItems['item_id'] ?>"><?= $myItems['item'] ?></a></td>
		<td><?= $myItems['username'] ?></td>
		<td><?= $myItems['created_at'] ?></td>
		<?php if($myItems['creator'] === $this->session->userdata['user']['id']){ ?>
		<td><a href="/Wishlist/deleteItem/<?=$myItems['item_id']?>">Delete Item</a></td>
		<?php }else{ ?>
		<td><a href="/Wishlist/removeItem/<?= $myItems['item_id'] ?>">Remove From Wishlist</a>
		<?php } ?>
	</tr>

<?php 
	}

?>
	</table>
	</div>
	<div>

		<p>Other User's Wish List:</p>
	<table>
	<tr>
		<th>Item</th>
		<th>Added by</th>
		<th>Dated Added</th>
		<th>Action</th>
	</tr>
<?php
		foreach($item as $items) {
?>
	<tr>
		<td><a href="/Wishlist/item/<?= $items['id'] ?>"><?= $items['item'] ?></a></td>
		<td><?= $items['username'] ?></td>
		<td><?= $items['created_at'] ?></td>
		<td><a href="/Wishlist/addItem/<?= $items['id'] ?>">Add to my Wishlist</a>
	</tr>
<?php 
	}

?>
	</table>
	</div>

	<?php		
			if($this->session->flashdata("messages")) {
				echo $this->session->flashdata("messages");
			}
	?>

	<a href="/Wishlist/create">Add Product</a>
</body>
</html>
