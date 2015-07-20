<?php 
if (!isset($_SESSION)) {
	session_start();
}

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class DisplayEditPageHandler implements IrisHandler {

	public function handleAction() {
		$jid = filter_input(INPUT_GET, 'jid', FILTER_VALIDATE_INT);
		$pid = filter_input(INPUT_GET, 'pid', FILTER_VALIDATE_INT);

		$user = $_SESSION['user'];
		$model = new IrisModel();
		$journals = $model->getJournals($user['uid']);

		// Do not alert errors for $jid or $pid it is a hacking attempt.
		if ($jid == NULL || $jid == FALSE ||
		    $pid == NULL || $pid == FALSE) {

			include('pages/user-home.php');
		}
		else {
			$page = $model->getPage($user['uid'], $jid, $pid);
			$content = str_replace('<br />', "\n", $page['content']);
			include('pages/edit_page.php');
		}
	}
}

?>