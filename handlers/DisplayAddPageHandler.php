<?php 
if (!isset($_SESSION)) {
	session_start();
}

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class DisplayAddPageHandler implements IrisHandler {

	public function handleAction() {
		$jid = filter_input(INPUT_GET, 'jid', FILTER_VALIDATE_INT);

		$user = $_SESSION['user'];
		$model = new IrisModel();
		$journals = $model->getJournals($user['uid']);

		// Do not alert errors for $jid it is a hacking attempt.
		if ($jid == NULL || $jid == FALSE) {
			include('pages/user-home.php');
		}
		else {
			include('pages/add_page.php');
		}
	}
}

?>