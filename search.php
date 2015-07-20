<?php
	session_start();
	include ("modules/controller.php");

	$iris = new IrisController($_SESSION['user']);

	$search = filter_input(INPUT_POST, 'q');
	$journal = filter_input(INPUT_POST, 'jid');

	echo $iris->searchContent($search, $journal);

?>

