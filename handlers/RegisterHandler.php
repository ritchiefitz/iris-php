<?php 

if (!isset($_SESSION)) {
	session_start();
}

include_once('handlers/HandlerInterface.php');
include_once('modules/IrisModel.php');
include_once('lib/password.php');

class RegisterHandler implements IrisHandler {

	public function handleAction() {
		$first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
		$last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

		if ($first_name == NULL || $first_name == FALSE ||
			$last_name == NULL || $last_name == FALSE ||
			$username == NULL || $username == FALSE ||
			$email == NULL || $email == FALSE ||
			$password == NULL || $password == FALSE) {

			$error = 'Must enter valid inputs.';
			include('pages/login.php');
		}
		else {
			$model = new IrisModel();
			$hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

			$is_registered = $model->addUser($first_name, $last_name, $username, $email, $hashedPassword);

			if ($is_registered) {
				$user = $model->getUser($username);
				$_SESSION['user'] = $user;
				$_SESSION['logged_in'] = true;

				$error = '';
				
				$journals = $model->getJournals($user['uid']);
				include('pages/user-home.php');
			}
			else {
				$error = 'An error has occured while registering user';
				include('pages/login.php');
			}
		}
	}
}

?>