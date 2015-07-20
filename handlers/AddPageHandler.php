<?php 

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class AddPageHandler implements IrisHandler {

	public function handleAction() {
		$jid = filter_input(INPUT_POST, 'jid', FILTER_VALIDATE_INT);
		$page_title = filter_input(INPUT_POST, 'page-title', FILTER_SANITIZE_STRING);
		$page_date = filter_input(INPUT_POST, 'page-date', FILTER_SANITIZE_STRING);
		$page_content = filter_input(INPUT_POST, 'page-content', FILTER_SANITIZE_STRING);

		$user = $_SESSION['user'];
		$model = new IrisModel();

		if ($jid == NULL || $jid == FALSE ||
			$page_title == NULL || $page_title == FALSE ||
			$page_date == NULL || $page_date == FALSE ||
			$page_content == NULL || $page_content == FALSE) {

			// Don't let them know about the jid.
			// If that is different it is a hacking attempt.
			$error = 'Must enter valid strings.';
			$journals = $model->getJournals($user['uid']);
			include('pages/add_page.php');
		}
		else {
			$error = '';
			$page_num = $model->addPage($user['uid'], $jid, $page_title, $page_date, $page_content);
			header("Location: index.php?action=read_journal&jid=$jid&pn=$page_num");
		}
	}
}

?>