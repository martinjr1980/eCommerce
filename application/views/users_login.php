<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login And Registration</title>
	<link rel="stylesheet" type="text/css" href="/assets/style_users.css">
</head>
<body>
	<div id="wrapper">
		<h2>Login</h2>
		<p class='red'><?= $this->session->flashdata('errors'); ?></p>
		<form action="/users/login" method="post">
			<div class='row'>
				<label for="email">Email Address: </label>
				<input type="text" name="email">
			</div>
			<div class='row'>
				<label for="password">Password: </label>
				<input type="password" name="password">
			</div>
			<div class='row'>
				<input type="hidden" name="action" value="login">
				<input type="submit" value="Login">
			</div>
		</form>
		<h2>Registration</h2>
		<p class='green'><?= $this->session->flashdata('form_success'); ?></p>
		<span class='red'><?= $this->session->flashdata('form_errors'); ?></span>
		<form action="/users/add" method="post">
			<div class='row'>
				<label for="first_name">First Name: </label>
				<input type="text" name="first_name">
			</div>
			<div class='row'>
				<label for="last_name">Last Name: </label>
				<input type="text" name="last_name">
			</div>
			<div class='row'>
				<label for="email">Email Address: </label>
				<input type="text" name="email">
			</div>
			<div class='row'>
				<label for="password">Password: </label>
				<input type="password" name="password">
			</div>
			<div class='row'>
				<label for="confirm_password">Confirm Password: </label>
				<input type="password" name="confirm_password">
			</div>
			<div class='row'>
				<input type="hidden" name="action" value="register">
				<input type="submit" value="Register">
			</div>
		</form>
	</div>
</body>
</html>