<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('modules/AppController.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        if (isset($_SESSION['logged_in'])) {
            $action = 'display_home';
        }
    }
}

if ($action !== 'register' && $action !== 'login') {
    if (!isset($_SESSION['logged_in'])) {
        $action = 'display_login';
    }
}

$controller = new AppController();
$controller->handleRequest($action);
?>