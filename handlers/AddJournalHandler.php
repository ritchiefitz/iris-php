<?php 

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class AddJournalHandler implements IrisHandler {

	public function handleAction() {
		$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);

		$user = $_SESSION['user'];
		$model = new IrisModel();

		if ($title == NULL || $title == FALSE) {
			$journals = $model->getJournals($user['uid']);
			$error = 'Must enter a valid string.';
			include('pages/add_journal.php');
		}
		else {
			$error = '';
			$model->addJournal($user['uid'], $title);
			$journals = $model->getJournals($user['uid']);
			include('pages/user-home.php');
		}
	}
}

?>