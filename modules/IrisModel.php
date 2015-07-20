<?php

include("lib/password.php");

class IrisModel {
	private $server;
	private $database;
	private $username;
	private $password;
	private $dsn;

	public function __construct() {
		$this->server = '127.0.0.1';
		$this->database = 'iris';
		$this->username = 'adminn8qcPyU';
		$this->password = 'En9H8_kr5X4J';
		$this->dsn = 'mysql:host=' . $this->server . ';dbname=' . $this->database;
	}

	/**
	 * GET DATABASE CONNECTION
	 *
	 * This will return a connection to the database.
	 * 
	 * @return [PDO Object] a connection to the database using PDO
	 */
	private function getDBConnection() {
		$db_connection = null;
		try {
			$db_connection = new PDO($this->dsn, $this->username, $this->password);
			return $db_connection;
		} catch (Exception $e) {
			echo "Connection failed!";
		}
	}

	/**
	 * GET USERS
	 *
	 * This will get all of the users.
	 * 
	 * @return [Multi-Dimentional Array] each index contains an associative array about each user.
	 */
	public function getUsers() {
		$db_conn = $this->getDBConnection();

		$pages = [];

		foreach ($db_conn->query('SELECT * FROM user') as $row) {
			$pages[] = $row;
		}

		return $pages;
	}

	/**
	 * GET JOURNALS
	 *
	 * This will return all the journals belonging to a user.
	 * 
	 * @param  INT 		$uid the id of the current user.
	 * @return [Multi-Dimentional Array] each index contains an associative array about each journal.
	 */
	public function getJournals($uid) {
		$db_conn = $this->getDBConnection();

		try {
			$query = 'SELECT * FROM journal WHERE uid = :uid';
			$statement = $db_conn->prepare($query);
			$statement->bindValue(':uid', $uid);
			$statement->execute();
			$journals = $statement->fetchAll();
			return $journals;
		} catch (Exception $e) {
			echo "An error occured while retrieving journals.";
		}
	}

	/**
	 * GET PAGES
	 *
	 * This will return all the pages that belong to the given user and journal.
	 * 
	 * @param  INT 		$uid 			 the id a user.
	 * @param  INT 		$jid 			 the id a journal.
	 * @return [Multi-Dimentional Array] each index contains an associative array about each page.
	 */
	public function getPages($uid, $jid) {
		$db_conn = $this->getDBConnection();

		try {
			$query = 'SELECT * FROM page WHERE uid = :uid AND jid = :jid';
			$statement = $db_conn->prepare($query);
			$statement->bindValue(':uid', $uid);
			$statement->bindValue(':jid', $jid);
			$statement->execute();
			$pages = $statement->fetchAll();
			return $pages;
		} catch (Exception $e) {
			echo "An error occured while retrieving pages.";
			return false;
		}
	}

	/**
	 * GET USER
	 *
	 * This will return a user with the given id.
	 * 
	 * @param  INT 		$uid 			the id a user.
	 * @return [Associative Array]      contains information about the user.
	 */
	// public function getUser($uid) {
	// 	$db_conn = $this->getDBConnection();

	// 	try {
	// 		$query = 'SELECT * FROM user WHERE uid = :uid';
	// 		$statement = $db_conn->prepare($query);
	// 		$statement->bindValue(':uid', $uid);
	// 		$statement->execute();
	// 		$user = $statement->fetch();
	// 		return $user;
	// 	} catch (Exception $e) {
	// 		echo "An error has occured while retriving user from database";
	// 	}
	// }
	
	/**
	 * GET USER
	 *
	 * Use the given username and password to verify that the user
	 * actually exists.
	 * 
	 * @param  String $username       a string containing the passed in username.
	 * @param  String $password 	  a string containing the passed in password.
	 * @return Boolean                returns true if the user is valid otherwise returns false.
	 */
	public function getUser($username) {
		$db_conn = $this->getDBConnection();

		try {
			$query = 'SELECT * FROM user WHERE username = :username';
			$statement = $db_conn->prepare($query);
			$statement->bindValue(':username', $username);
			$statement->execute();
			$user = $statement->fetch();
			return $user;
		} catch (Exception $e) {
			return false;
		}
	}

	/**
	 * GET JOURNAL
	 *
	 * This will return a journal that has the given id that belongs to a
	 * specific user.
	 * 
	 * @param  INT 		$uid 			the id a user.
	 * @param  INT 		$jid 			the id a journal.
	 * @return [Associative Array]      contains information about the journal.
	 */
	public function getJournal($uid, $jid) {
		$db_conn = $this->getDBConnection();

		try {
			$query = 'SELECT * FROM journal WHERE uid = :uid AND jid = :jid';
			$statement = $db_conn->prepare($query);
			$statement->bindValue(':uid', $uid);
			$statement->bindValue(':jid', $jid);
			$statement->execute();
			$journal = $statement->fetch();
			return $journal;
		} catch (Exception $e) {
			echo "An error has occured while retriving journal from database";
			return false;
		}
	}

	/**
	 * GET Page
	 *
	 * This will return a page that has the given id that belongs to a
	 * specific user.
	 * 
	 * @param  INT 		$uid 			the id a user.
	 * @param  INT 		$pid 			the id a page.
	 * @return [Associative Array]      contains information about the page.
	 */
	public function getPage($uid, $jid, $pid) {
		$db_conn = $this->getDBConnection();

		try {
			$query = 'SELECT * FROM page WHERE uid = :uid AND jid = :jid AND pid = :pid';
			$statement = $db_conn->prepare($query);
			$statement->bindValue(':uid', $uid);
			$statement->bindValue(':jid', $jid);
			$statement->bindValue(':pid', $pid);
			$statement->execute();
			$page = $statement->fetch();
			return $page;
		} catch (Exception $e) {
			echo "An error has occured while retriving page from database";
			return false;
		}
	}

	/**
	 * SEARCH CONTENT
	 *
	 * This will return the pages that match.
	 * 
	 * @param  INT 		$uid     			the id for a user.
	 * @param  String 	$search  			the string to search for.
	 * @param  INT 		$journal 			the id for a journal.
	 * @return [Multi-Dimentional Array] 	each index contains an associative array about each page.
	 */
	public function searchContent($uid, $search, $journal) {
		$db_conn = $this->getDBConnection();

		try {
			$query = "SELECT p.title
			          ,		 p.event_date
			          ,		 p.page_number
					  FROM page p
					  WHERE p.content LIKE :search
					  AND uid = :uid
					  AND jid = :jid
					  LIMIT 5";
		  	$statement = $db_conn->prepare($query);
		  	$statement->bindValue(":search", '%'.$search.'%');
		  	$statement->bindValue(":uid", $uid);
		  	$statement->bindValue(":jid", $journal);
		  	$statement->execute();
		  	$matched_pages = $statement->fetchAll();
		  	return $matched_pages;
		} catch (Exception $e) {
			echo "An error has occured while searching";
			return false;
		}
	}

	/**
	 * REGISTER USER
	 *
	 * This will add a new user to the application.
	 * 
	 * @param  String $first_name 		a string containing the wanted first_name.
	 * @param  String $last_name  		a string containing the wanted last_name.
	 * @param  String $username   		a string containing the wanted username.
	 * @param  String $email      		a string containing the wanted email.
	 * @param  String $password   		a string containing the wanted password.
	 * @return Boolean             		returns user information otherwise returns false.
	 */
	public function addUser($first_name, $last_name, $username, $email, $password) {
		$db_conn = $this->getDBConnection();

		try {
			$query = 'INSERT INTO user
					  ( username
					  , email
					  , password
					  , first_name
					  , last_name
					  )
					  VALUES
					  ( :username
					  , :email
					  , :password
					  , :first_name
					  , :last_name
					  )';
			$statement = $db_conn->prepare($query);
			$statement->bindValue(':username', $username);
			$statement->bindValue(':email', $email);
			$statement->bindValue(':password', $password);
			$statement->bindValue(':first_name', $first_name);
			$statement->bindValue(':last_name', $last_name);
			$statement->execute();
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	/**
	 * ADD PAGE
	 *
	 * This will add a new page to the user and journal.
	 * 
	 * @param INT 		$uid          	the id of a journal.
	 * @param INT 		$jid          	the id of a user.
	 * @param String 	$page_title   	the data for the page_title field.
	 * @param String 	$page_date    	the data for the page_date field.
	 * @param String 	$page_content 	the data for the page_content field.
	 * @return INT               		returns a number if we were able to add the page, or false if we failed.
	 */
	public function addPage($uid, $jid, $page_title, $page_date, $page_content) {
		$db_conn = $this->getDBConnection();

		// Get the next value for page_number
		$number_statement = $db_conn->prepare("SELECT MAX(page_number) FROM page WHERE jid = :jid LIMIT 1");
		$number_statement->bindValue(':jid', $jid);
		$number_statement->execute();
		$row = $number_statement->fetch();
		$page_number = $row[0] + 1;

		try {
			$query = "INSERT INTO page
					  ( jid
					  , uid
					  , title
					  , event_date
					  , content
					  , page_number
					  )
					  VALUES
					  ( :jid
					  , :uid
					  , :title
					  , :event_date
					  , :content
					  , :page_number
					  )";
		  	$statement = $db_conn->prepare($query);
		  	$statement->bindValue(":jid", $jid);
		  	$statement->bindValue(":uid", $uid);
		  	$statement->bindValue(":title", $page_title);
		  	$statement->bindValue(":event_date", $page_date);
		  	$statement->bindValue(":content", $page_content);
		  	$statement->bindValue(":page_number", $page_number);
		  	$statement->execute();
		  	return $page_number;
		} catch (Exception $e) {
			echo "An error has occured while adding page.";
			return false;
		}
	}

	/**
	 * UPDATE PAGE
	 *
	 * This will update a page with the given content.
	 * 
	 * @param INT 		$uid          	the id of a user.
	 * @param INT 		$pid          	the id of a page.
	 * @param String 	$page_title   	the data for the page_title field.
	 * @param String 	$page_date    	the data for the page_date field.
	 * @param String 	$page_content 	the data for the page_content field.
	 * @return Boolean               	returns false if we failed to update the page.
	 */
	public function updatePage($uid, $jid, $pid, $page_title, $page_date, $page_content) {
		$db_conn = $this->getDBConnection();

		try {
			$query = "UPDATE page
					  SET title = :title
					  ,   event_date = :event_date
					  ,   content = :content
					  WHERE uid = :uid
					  AND jid = :jid
					  AND pid = :pid";

		  	$statement = $db_conn->prepare($query);
		  	$statement->bindValue(":uid", $uid);
		  	$statement->bindValue(":jid", $jid);
		  	$statement->bindValue(":pid", $pid);
		  	$statement->bindValue(":title", $page_title);
		  	$statement->bindValue(":event_date", $page_date);
		  	$statement->bindValue(":content", $page_content);
		  	$statement->execute();
		  	return true;
		} catch (Exception $e) {
			echo "An error has occured while updating page.";
			return false;
		}
	}

	/**
	 * ADD JOURNAL
	 *
	 * This will add a new journal to the given user.
	 * 
	 * @param INT 		$uid   		the id of a user.
	 * @param String 	$title 		the new title.
	 * @return Boolean        		return false if the query failed.
	 */
	public function addJournal($uid, $title) {
		$db_conn = $this->getDBConnection();

		try {
			$query = "INSERT INTO journal
					  (uid,title,theme)
					  VALUES
					  (:uid,:title,'default')";
			$statement = $db_conn->prepare($query);
			$statement->bindValue(":uid", $uid);
			$statement->bindValue(":title", $title);
			$statement->execute();
			return true;
		} catch (Exception $e) {
			echo "An error has occured while adding journal.";
			return false;
		}
	}

	/**
	 * UPDATE JOURNAL
	 *
	 * This will update a journal with the given content.
	 * 
	 * @param  INT 		$uid   		the id of a user.
	 * @param  INT 		$jid   		the id of a journal.
	 * @param  String  	$title 		the updated title.
	 * @return Boolean        		return false if the query failed.
	 */
	public function updateJournal($uid, $jid, $title) {
		$db_conn = $this->getDBConnection();

		try {
			$query = "UPDATE journal
					  SET title = :title
					  WHERE uid = :uid
					  AND jid = :jid";
			$statement = $db_conn->prepare($query);
			$statement->bindValue(":uid", $uid);
			$statement->bindValue(":jid", $jid);
			$statement->bindValue(":title", $title);
			$statement->execute();
		} catch (Exception $e) {
			echo "An error has occured while adding journal.";
			return false;
		}
	}

	public function deleteJournal($uid, $jid) {
		$db_conn = $this->getDBConnection();

		try {
			$query = "DELETE FROM journal
					  WHERE uid = :uid AND jid = :jid";
			$statement = $db_conn->prepare($query);
			$statement->bindValue(":uid", $uid);
			$statement->bindValue(":jid", $jid);
			$statement->execute();
			return true;
		} catch (Exception $e) {
			echo "An error has occured while adding journal.";
			return false;
		}
	}

	public function deletePage($uid, $jid, $pid) {
		$db_conn = $this->getDBConnection();

		try {
			$query = "DELETE FROM page
					  WHERE uid = :uid
					  AND jid = :jid
					  AND pid = :pid";
			$statement = $db_conn->prepare($query);
			$statement->bindValue(":uid", $uid);
			$statement->bindValue(":jid", $jid);
			$statement->bindValue(":pid", $pid);
			$statement->execute();
			return true;
		} catch (Exception $e) {
			echo "An error has occured while adding journal.";
			return false;
		}
	}
}
?>