<?php
	if (!isset($_SESSION)) {
    	session_start();
	}

	include('modules/header.php');
?>
<div class="row text-center">
	<div class="col-sm-9 text-left">
		<div id="flipbook">
			<div class="hard">
				<div class="title"><?php echo $readJournal['title']; ?></div>
			</div>
			<div class="hard"></div>

			<?php
				foreach ($pages as $page):
				$date = DateTime::createFromFormat('Y-m-d', $page['event_date']);
			?>

			<div class="journal-page-wrapper">
				<div class="journal-page">
					<div class="title"><?php echo $page['title']; ?></div>
					<div class="date"><?php echo $date->format('F j, Y'); ?></div>
					<div class="page-number"><?php echo $page['page_number']; ?></div>
					<div class="journal-content"><?php echo $page['content']; ?></div>
				</div> <!-- End of Journal Page -->
				<form class="edit-form" action="index.php" method="get">
					<input type="hidden" name="jid" value="<?php echo $page['jid']; ?>">
					<input type="hidden" name="pid" value="<?php echo $page['pid']; ?>">
					<input type="hidden" name="action" value="display_edit_page">
					<input type="submit" class="btn btn-default edit-submit" value="Edit Page">
				</form>
			</div> <!-- End of Journal Page Wrapper -->

			<?php endforeach; ?>

			<?php if ($evenPages) {echo '<div></div>';} ?>
			<div class="hard"></div>
			<div class="hard last"></div>
		</div> <!-- End of flipbook -->
	</div>
	<div class="col-sm-3">
		<div class="sidebar">
			<h2>Journal Controls</h2>
			<ul>
				<li>Right Arrow: Next Page</li>
				<li>Left Arrow: Previous Page</li>
			</ul>
			<h2>Search Journal</h2>
			<form id="search-form" action="index.php">
				<div class="form-group">
					<input id="q" type="text" class="form-control" name="q">
				</div>
				<input id="jid" type="hidden" name="jid" value="<?php echo $jid; ?>">
				<input type="hidden" name="action" value="search_journal">
				<input id="search" type="button" class="btn btn-default" value="Search">
			</form>
		</div>
	</div>
</div>
<?php include ("modules/footer.php"); ?>