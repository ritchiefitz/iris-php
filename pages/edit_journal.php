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
			<h1>Edit Journal</h1>
			<form action="index.php" method="post">
				<input type="text" name="title" class="form-control form-control-inline" placeholder="Journal Title" maxlength="14" value="<?php echo $editJournal['title']; ?>" required>
				<input type="hidden" name="jid" value="<?php echo $editJournal['jid']; ?>">
				<input type="hidden" name="action" value="edit_journal">
				<input type="submit" class="btn btn-default" value="Submit">
			</form>
		</div>
	</div>
</div>
<?php include ("modules/footer.php"); ?>
