<?php 
if (!isset($_SESSION)) {
	session_start();
}

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class ReadJournalHandler implements IrisHandler {

	public function handleAction() {
		$jid = filter_input(INPUT_GET, 'jid', FILTER_VALIDATE_INT);

		$user = $_SESSION['user'];
		$model = new IrisModel();

		// Do not alert errors for $jid it is a hacking attempt.
		if ($jid == NULL || $jid == FALSE) {
			$journals = $model->getJournals($user['uid']);
			include('pages/user-home.php');
		}
		else {
			$readJournal = $model->getJournal($user['uid'], $jid);
			$pages = $model->getPages($user['uid'], $jid);
			$evenPages = (count($pages) % 2 == 1);
		
			include('pages/view_journal.php');
		}
	}
}

?>