<?php 

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class DeletePageHandler implements IrisHandler {

	public function handleAction() {
		$jid = filter_input(INPUT_GET, 'jid', FILTER_VALIDATE_INT);
		$pid = filter_input(INPUT_GET, 'pid', FILTER_VALIDATE_INT);

		$user = $_SESSION['user'];
		$model = new IrisModel();
		

		// Do not alert errors for $jid or $pid it is a hacking attempt.
		if ($jid == NULL || $jid == FALSE ||
		    $pid == NULL || $pid == FALSE) {

			$journals = $model->getJournals($user['uid']);
			include('pages/user-home.php');
		}
		else {
			$result = $model->deletePage($user['uid'], $jid, $pid);
			header("Location: index.php?action=read_journal&jid=$jid");
		}
	}
}

?>