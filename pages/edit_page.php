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
			<form action="index.php" method="post">
				<div class="form-group">
					<input id="page-title" name="page-title" type="text" class="form-control"
					placeholder="Page Title" value="<?php echo $page['title']; ?>" maxlength="20" required>
				</div>
				<div class="form-group">
					<input id="page-date" name="page-date" type="text" class="form-control"
					pattern="\d{4}-\d{2}-\d{2}" placeholder="Date YYYY-MM-DD" value="<?php echo $page['event_date']; ?>" required>
				</div>
				<div class="form-group">
					<textarea name="page-content" id="page-content" 
						placeholder="Page Content" maxlength="1551" required><?php echo $content; ?></textarea>
				</div>
				<input type="hidden" name="jid" value="<?php echo $jid; ?>">
				<input type="hidden" name="pid" value="<?php echo $pid; ?>">
				<input type="hidden" name="page-num" value="<?php echo $page['page_number']; ?>">
				<input type="hidden" name="action" value="edit_page">
				<input type="submit" class="btn btn-default" value="Update">
				<a class="btn btn-default" href="index.php?action=delete_page&jid=<?php echo $jid; ?>&pid=<?php echo $pid; ?>">Delete</a>
			</form>
		</div>
	</div>
</div>
<?php include ("modules/footer.php"); ?>