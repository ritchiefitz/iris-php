<?php
	if (!isset($_SESSION)) {
    	session_start();
	}

	include('modules/header.php');
?>
<div class="login-wrapper">
	<h1 class="login-logo">Iris</h1>
	<h2 class="error-message"><?php echo (isset($error)) ? $error : ''; ?></h2>
	<div class="half-side">
		<h2>Login</h2>
		<form id="login" action="index.php" method="post">
			<div class="form-group">
				<input type="text" class="form-control" name="username" placeholder="Username" required>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="password" placeholder="Password" required>
			</div>
			<input type="hidden" name="action" value="login">
			<input type="submit" class="btn btn-default" value="Login">
		</form>
	</div>
	<div class="half-side">
		<h2>Register</h2>
		<form id="register" action="index.php" method="post">
			<div class="form-group">
				<input type="text" class="form-control" name="first_name" placeholder="First Name" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="username" placeholder="Username" required>
			</div>
			<div class="form-group">
				<input type="email" class="form-control" name="email" placeholder="Email" required>
			</div>
			<div class="form-group password">
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
			</div>
			<div class="form-group password">
				<input type="password" class="form-control" id="verify_pwd" name="verify_pwd" placeholder="Verify Password" required>
			</div>
			<input type="hidden" name="action" value="register">
			<input type="submit" class="btn btn-default" value="Register">
		</form>
	</div>
</div>
<?php include('modules/footer.php'); ?>