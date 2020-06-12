<?php
namespace anupam\ucs;

Class DB {
	
	protected $db_name = 'new_crm';
	protected $db_user = 'root';
	protected $db_pass = '';
	protected $db_host = 'localhost';
	
	// Open a connect to the database.
	// Make sure this is called on every page that needs to use the database.
	
	function __construct(){

	}

	public function connect() {
	
		$connect_db = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
		
		if ( mysqli_connect_errno() ) {
			printf("Connection failed: %s\ ", mysqli_connect_error());
			exit();
		}
		return $connect_db;	
	}
}
?>