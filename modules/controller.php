<?php

include_once("modules/AppController.php");
include_once("modules/view.php");

class IrisController {
	private $model;
	private $view;
	private $user;

	public function __construct($user) {
		$this->model = new IrisModel();
		$this->view = new IrisView();
		$this->user = $user;
	}

	public function setUser($user) {
		$this->user = $user;
	}

	public function getUsers() {
		return $this->model->getUsers();
	}

	public function getJournals() {
		return $this->model->getJournals($this->user['uid']);
	}

	public function getPages($jid) {
		return $this->model->getPages($this->user['uid'], $jid);
	}

	public function getUser() {
		return $this->user;
	}

	public function registerUser($first_name, $last_name, $username, $email, $password) {
		$valid_user = $this->model->registerUser($first_name, $last_name, $username, $email, $password);
		$this->user = $valid_user;
		return $valid_user;
	}

	public function getJournal($jid) {
		return $this->model->getJournal($this->user['uid'], $jid);
	}

	public function getPage($pid) {
		return $this->model->getPage($this->user['uid'], $pid);
	}

	public function validateUser($username, $password) {
		$valid_user = $this->model->validateUser($username, $password);
		$this->user = $valid_user;
		return $valid_user;
	}

	public function addPage($jid, $page_title, $page_date, $page_content) {
		return $this->model->addPage($jid, $this->user['uid'], $page_title, $page_date, $page_content);
	}

	public function updatePage($pid, $page_title, $page_date, $page_content) {
		$this->model->updatePage($this->user['uid'], $pid, $page_title, $page_date, $page_content);
	}

	public function addJournal($title) {
		$this->model->addJournal($this->user['uid'], $title);
	}

	public function updateJournal($jid, $title) {
		$this->model->updateJournal($this->user['uid'], $jid, $title);
	}

	public function displayJournalSidebar() {
		$this->view->displayJournalSidebar($this->getJournals());
	}

	public function displayJournals() {
		$this->view->displayJournals($this->getJournals());
	}

	public function displayJournal($jid) {
		$this->view->displayJournal($this->getJournal($jid), $this->getPages($jid));
	}

	public function searchContent($search, $journal) {
		$matching_pages = $this->model->searchContent($this->user['uid'], $search, $journal);
		return $this->view->displaySearchResults($matching_pages);
	}
}
?>