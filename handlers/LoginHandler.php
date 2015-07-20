<?php 
if (!isset($_SESSION)) {
	session_start();
}

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');
include_once('lib/password.php');

class LoginHandler implements IrisHandler {

	public function handleAction() {
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

		if ($username == NULL || $username == FALSE ||
		    $password == NULL || $password == FALSE) {

			$error = 'Must enter valid input.';
			include('pages/login.php');
		}
		else {
			$model = new IrisModel();

			$user = $model->getUser($username);

			if ($user != null && $user != false) {
				if (password_verify($password, $user['password'])) {
					$_SESSION['user'] = $user;
					$_SESSION['logged_in'] = true;
					
					$error = '';

					$journals = $model->getJournals($user['uid']);
					include('pages/user-home.php');
				} else {
					$error = 'Username and password do not match any accounts.';
					include('pages/login.php');
				}
			}
			else {
				$error = 'Username or email do not exist';
				include('pages/login.php');
			}
		}
	}
}

?>