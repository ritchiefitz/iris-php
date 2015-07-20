<?php
	if (!isset($_SESSION)) {
    	session_start();
	}

	include('modules/header.php');
?>
<div class="row">
	<div class="col-sm-2">
		<?php include("modules/sidebar.php"); ?>
	</div>
	<div class="col-sm-10">
		<div class="content">
			<h1>Account Details</h1>
			<div class="account-info">
				<label>First Name:</label>
				<span class="first-name"><?php echo $user['first_name']; ?></span>
				<br>
				<label>Last Name:</label>
				<span class="last-name"><?php echo $user['last_name']; ?></span>
				<br>
				<label>Username:</label>
				<span class="username"><?php echo $user['username']; ?></span>
				<br>
				<label>E-mail:</label>
				<span class="email"><?php echo $user['email']; ?></span>
				<br>
			</div>
		</div>
	</div>
</div>
<?php include ("modules/footer.php"); ?>