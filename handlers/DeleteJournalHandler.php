<?php 

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class DeleteJournalHandler implements IrisHandler {

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
			$result = $model->deleteJournal($user['uid'], $jid);
			$journals = $model->getJournals($user['uid']);
			include('pages/user-home.php');
		}
	}
}

?>