<?php 
if (!isset($_SESSION)) {
	session_start();
}

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');

class NotFoundHandler implements IrisHandler {

	public function handleAction() {
		include('pages/error.php');
	}
}

?>