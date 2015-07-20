<?php

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class EditJournalHandler implements IrisHandler {

	public function handleAction() {
		$jid = filter_input(INPUT_POST, 'jid', FILTER_VALIDATE_INT);
		$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);

		$user = $_SESSION['user'];
		$model = new IrisModel();

		// Do not alert errors for $jid it is a hacking attempt.
		if ($jid == NULL || $jid == FALSE ||
		    $title == NULL || $title == FALSE) {
			
			$error = 'Must enter a valid title.';
			$journals = $model->getJournals($user['uid']);
			include('pages/user-home.php');
		}
		else {
			$error = '';
			$model->updateJournal($user['uid'], $jid, $title);
			$journals = $model->getJournals($user['uid']);
			include('pages/user-home.php');
		}
	}
}

?>