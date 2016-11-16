<!DOCTYPE html>
<html>
<head>
	<title>Wall</title>
</head>
<body>

	<?php 
	echo date('l jS \of F Y h:i:s A');
	echo time();
	if ($this->session->flashdata("errors")){
		echo $this->session->flashdata("errors");
	}
	if ($this->session->flashdata("success_message")){
		echo $this->session->flashdata("success_message");
	}
	?>

	<fieldset style="width: 500px; font-size: 20px">
	<legend>Register</legend>
	<form action="/Log_in_Reg/reg" method="POST">
		Name: <input type="text" name="name"><br>
		UserName: <input type="text" name="username"><br>
		Email: <input type="text" name="email"><br>
		Password: <input type="password" name="password"><br>
		Password Confirm: <input type="password" name="pass_con"><br>
		<input type="submit" value="Register">
	</form>
	</fieldset>
	<fieldset style="width: 500px; font-size: 20px">
	<legend>Login</legend>
	<form action="/Log_in_Reg/login">
		Email: <input type="text" name="email">
		Password: <input type="password" name="password">
		<input type="submit" value="Login">	
	</form>
	</fieldset>
</body>
</html>
