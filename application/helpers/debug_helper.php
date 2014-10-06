<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start();

	function debug($var, $die = false){
		echo "<pre>";
			print_r($var);
		echo "</pre>";

		if($die){
			die();
		}
	}

	function check_session(){
		if(isSet($_SESSION["user"])
			&& $_SESSION["user"]["username"] != ""){
			return true;
		} else {
			return false;
		}
	}
?>
