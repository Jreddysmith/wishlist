<!DOCTYPE html>
<html>
<head>
	<title>User</title>
</head>
<body>
<a href="/Log_in_Reg/logout">Logout</a> <a href="/wishlist">Home</a>

	<h3> <?= $item['item'] ?></h3>

	<?php foreach($users as $user) { ?>
			<h4><?= $user['username']?></h4>


	<?php
		}
	?>
</body>
</html>
