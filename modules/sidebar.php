<div class="sidebar">
	<h2>Account</h2>
	<ul>
		<li><a href="index.php?action=display_account">Account Details</a></li>
		<li><a href="index.php?action=logout">Logout</a></li>
	</ul>
	<h2>Journals</h2>
	<ul>
		<li><a href="index.php?action=display_add_journal">Add Journal</a></li>
	</ul>

	<?php foreach ($journals as $journal): ?>
		<h2><?php echo $journal['title']; ?></h2>
		<ul>
			<li><a href="index.php?action=display_add_page&amp;jid=<?php echo $journal['jid']; ?>">Add Page</a></li>
			<li><a href="index.php?action=read_journal&amp;jid=<?php echo $journal['jid']; ?>">Read Journal</a></li>
			<li><a href="index.php?action=display_edit_journal&amp;jid=<?php echo $journal['jid']; ?>">Edit Journal</a></li>
			<li><a href="index.php?action=delete_journal&amp;jid=<?php echo $journal['jid']; ?>">Delete Journal</a></li>
		</ul>
	<?php endforeach;?>
</div>