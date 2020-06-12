<?php
namespace anupam\ucs;

require("DB.php");

Class Acl{

	private $db;
	private $connect_db;
	function __construct(){
		$conn = new DB;

		$this->connect_db = $conn->connect();
	}
	private function pr($arr = array()){
		echo "<pre>"; print_r($arr); echo "<pre>";
	}

	function check($permission,$userid,$group_id) {
		//we check the user permissions first
		if(!$this->user_permissions($permission,$userid)) {
			return false;
		}

		if(!$this->group_permissions($permission,$group_id) & $this->IsUserEmpty()) {
			return false;
		}

		return true;

	}
	function role_permissions($permission,$role_id) {

		$query = $this->connect_db->query("SELECT pr.* FROM `permissions` as p INNER JOIN `permission_role` as pr ON p.id = pr.permission_id WHERE `key` = '".addslashes($permission)."' and `role_id`= '".addslashes($role_id)."'");

		if($query->num_rows>0){
			echo "<br>success role_permissions<br>";
			return TRUE;
		}
		return FALSE;
   }
	function user_permissions($permission,$user_id)
	{
		$query = $this->connect_db->query("SELECT pu.* FROM `permissions` as p INNER JOIN `permission_user` as pu ON p.id = pu.permission_id WHERE `key` = '".addslashes($permission)."' and `user_id`= '".addslashes($user_id)."'");

		if($query->num_rows>0){
			echo "<br>success user_permissions<br>";
			return TRUE;		
		}

		return FALSE;
   }
}

$acl_obj = new Acl();

$acl_obj->role_permissions("browse_admin","1");
$acl_obj->user_permissions("browse_admin","2");
?>