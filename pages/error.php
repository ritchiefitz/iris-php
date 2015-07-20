<?php
	if (!isset($_SESSION)) {
    	session_start();
	}

	include('modules/header.php');
?>
<div class="row">
	<div class="col-sm-12">
		<div class="content">
			<h1>Not Found</h1>
			<p>The page that you were trying to reference could not be found.</p>
		</div>
	</div>
</div>
<?php include('modules/footer.php'); ?>