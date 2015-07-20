<?php 

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class EditPageHandler implements IrisHandler {

	public function handleAction() {
		$jid = filter_input(INPUT_POST, 'jid', FILTER_VALIDATE_INT);
		$pid = filter_input(INPUT_POST, 'pid', FILTER_VALIDATE_INT);
		$page_num = filter_input(INPUT_POST, 'page-num', FILTER_SANITIZE_STRING);
		$page_title = filter_input(INPUT_POST, 'page-title', FILTER_SANITIZE_STRING);
		$page_date = filter_input(INPUT_POST, 'page-date', FILTER_SANITIZE_STRING);
		$page_content = filter_input(INPUT_POST, 'page-content', FILTER_SANITIZE_STRING);

		$model = new IrisModel();
		$user = $_SESSION['user'];

		if ($jid == NULL || $jid == FALSE ||
		    $pid == NULL || $pid == FALSE ||
			$page_title == NULL || $page_title == FALSE ||
			$page_date == NULL || $page_date == FALSE ||
			$page_content == NULL || $page_content == FALSE) {

			// Don't let them know about the jid or pid.
			// If that is different it is a hacking attempt.
			$error = 'Must enter valid input.';
			$journals = $model->getJournals($user['uid']);
			include('pages/edit_page.php');
		}
		else {
			$error = '';
			$page_content = str_replace("\n", '<br />', $page_content);
			$model->updatePage($user['uid'], $jid, $pid, $page_title, $page_date, $page_content);
			header("Location: index.php?action=read_journal&jid=$jid&pn=$page_num");
		}
	}
}

?>