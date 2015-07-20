<?php 
if (!isset($_SESSION)) {
	session_start();
}

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class DisplayAccountHandler implements IrisHandler {

	public function handleAction() {
		$user = $_SESSION['user'];
		$model = new IrisModel();
		$journals = $model->getJournals($user['uid']);
		include('pages/account_page.php');
	}
}

?>