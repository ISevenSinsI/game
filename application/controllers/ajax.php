<?php
class Ajax extends CI_Controller
{
	public function __construct(){
    	parent::__construct();
    	$this->load->model("mlocation");
    	$this->load->model("mskill");
    	$this->load->model("mplayer");
   	}

	public function get_character_by(){
		$id = $this->input->post("id");
		
		echo json_encode($this->mplayer->get($id));
	}
	public function go_to_location(){
		$player_id = $this->input->post("player_id");
		$location_from_id = $this->input->post("location_from_id");
		$location_to_id = $this->input->post("location_to_id");

		$timer = $this->mlocation->go_to_location($player_id,$location_from_id, $location_to_id);

		$location_to = new Location($location_to_id);

		$data = array(
			"location_to" => $location_to->name,
			"timer" => $timer,
		);

		echo json_encode($data);
	}

	public function change_location(){
		$player_id = $this->input->post("player_id");
		$location_to_id = $this->input->post("location_to_id");
		$location_from_id = $this->input->post("location_from_id");

		unset($_SESSION["user"]["location_id"]);
		$_SESSION["user"]["location_id"] = $location_to_id;

		echo $this->mplayer->change_location($player_id,$location_to_id,$location_from_id);
	}

	public function get_action_end($player_id){
		echo json_encode($this->mplayer->check_action_end($player_id));
	}

	public function reload_location(){
		$temp_data["location"] = $this->mlocation->get($_SESSION["user"]["id"], $_SESSION["user"]["location_id"]);
		$this->load->view("content/vlocation", $temp_data);
	}
	public function reload_main_menu(){
		$temp_data["location"] = $this->mlocation->get($_SESSION["user"]["id"], $_SESSION["user"]["location_id"]);
		$this->load->view("vmain_menu", $temp_data);
	}
	public function reload_right_menu(){
		$temp_data["location"] = $this->mlocation->get($_SESSION["user"]["id"], $_SESSION["user"]["location_id"]);
		$temp_data["player"] = $this->mplayer->get($_SESSION["user"]["id"]);
		$temp_data["skills"] = $this->mskill->get_all_by_player($_SESSION["user"]["id"]);

		$this->load->view("vright_menu", $temp_data);
	}
	public function do_action(){
		$player_id = $this->input->post("player_id");
		$action_id = $this->input->post("action_id");
		$action = new Action($action_id);
		$data = array();

		$timer = $this->maction->do_action($player_id, $action_id);

		$data["timer"] = $timer;
		$data["action"] = $action->to_array();


		echo json_encode($data);
	}
	public function load_action($action_id, $player_id){
		$data["action"] = $action = $this->maction->get($action_id);
		$data["action"]["timer"] = $this->maction->calculate_timer($player_id, $action_id);
		
		$this->load->view("content/vaction", $data);
	}
}	
?>