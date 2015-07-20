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
			<h1>Welcome <?php echo $user['first_name']; ?></h1>
			<p>At Iris we hope to give you an amazing experience.</p>
			<p>A lot of us like keeping a journal, but why write when you can type?</p>
			<p>Why spend all your time flipping through pages, when you can just search?</p>
			<p>Hoping to give you the advantage of both worlds by printing your online journal.</p>
		</div>
	</div>
</div>
<?php include('modules/footer.php'); ?>