<?php  

include_once('handlers/DisplayLoginHandler.php');
include_once('handlers/LoginHandler.php');
include_once('handlers/LogoutHandler.php');
include_once('handlers/DisplayHomeHandler.php');
include_once('handlers/RegisterHandler.php');
include_once('handlers/DisplayAccountHandler.php');

include_once('handlers/DisplayAddJournalHandler.php');
include_once('handlers/AddJournalHandler.php');
include_once('handlers/DisplayEditJournalHandler.php');
include_once('handlers/EditJournalHandler.php');
include_once('handlers/DeleteJournalHandler.php');
include_once('handlers/ReadJournalHandler.php');
include_once('handlers/SearchHandler.php');

include_once('handlers/DisplayAddPageHandler.php');
include_once('handlers/AddPageHandler.php');
include_once('handlers/DisplayEditPageHandler.php');
include_once('handlers/EditPageHandler.php');
include_once('handlers/DeletePageHandler.php');

include_once('handlers/NotFoundHandler.php');

class AppController {
	private $handlers;

	public function __construct() {
		
		// Handlers for Users
		$this->handlers['display_login'] = new DisplayLoginHandler();
		$this->handlers['login'] = new LoginHandler();
		$this->handlers['logout'] = new LogoutHandler();

		$this->handlers['display_home'] = new DisplayHomeHandler();
		$this->handlers['register'] = new RegisterHandler();

		$this->handlers['display_account'] = new DisplayAccountHandler();

		// Handlers for Journals
		$this->handlers['display_add_journal'] = new DisplayAddJournalHandler();
		$this->handlers['add_journal'] = new AddJournalHandler();

		$this->handlers['display_edit_journal'] = new DisplayEditJournalHandler();
		$this->handlers['edit_journal'] = new EditJournalHandler();

		$this->handlers['delete_journal'] = new DeleteJournalHandler();

		$this->handlers['read_journal'] = new ReadJournalHandler();
		$this->handlers['search_journal'] = new SearchHandler();

		// Handlers for Pages
		$this->handlers['display_add_page'] = new DisplayAddPageHandler();
		$this->handlers['add_page'] = new AddPageHandler();
		
		$this->handlers['display_edit_page'] = new DisplayEditPageHandler();
		$this->handlers['edit_page'] = new EditPageHandler();
		$this->handlers['delete_page'] = new DeletePageHandler();

		// Error Page
		$this->handlers['not_found'] = new NotFoundHandler();
	}

	public function handleRequest($action) {
		$handler = $this->handlers[$action];
		if ($handler !== NULL) {
			$handler->handleAction();
		}
		else {
			$this->handlers['not_found']->handleAction();
		}
	}
}

?>