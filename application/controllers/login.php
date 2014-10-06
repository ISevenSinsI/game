<?php

class Login extends CI_Controller
{
   	public function __construct(){
    	parent::__construct();
    	$this->load->model("mlogin");
   	}

	public function index(){
		// session_unset();

		// Check if logged in
		if(isSet($_SESSION["user"]) 
			&& $_SESSION["user"]["username"] != ""){
			redirect("pages");			
		} else {
			$data = array(
				"page_title" => "Login",
				"page_path" => "login/login",
			);

			$this->load->view("login/vlogin", $data);
		}
	}

	public function login_validate(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$validation = $this->mlogin->login_validate($username,$password);

		echo $validation;
	}
}

?>