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
	<div class="col-sm-10 text-center">
		<div class="custom-page">
			<p class="error-message"><?php echo (isset($error)) ? $error : ''; ?></p>
			<form action="index.php" method="post">
				<div class="form-group">
					<input id="page-title" name="page-title" type="text" class="form-control" placeholder="Page Title" maxlength="20" required>
				</div>
				<div class="form-group">
					<input id="page-date" name="page-date" type="text" class="form-control" pattern="\d{4}-\d{2}-\d{2}" placeholder="Date YYYY-MM-DD" value="<?php echo date("Y-m-d"); ?>" required>
				</div>
				<div class="form-group">
					<textarea name="page-content" id="page-content" placeholder="Page Content" maxlength="1551" required></textarea>
				</div>
				<input type="hidden" name="jid" value="<?php echo $jid; ?>">
				<input type="hidden" name="action" value="add_page">
				<input type="submit" class="btn btn-default" value="Add Page">
			</form>
		</div>
	</div>
</div>
<?php include ("modules/footer.php"); ?>