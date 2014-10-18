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

	public function get_travel_end($player_id){
		echo json_encode($this->mplayer->check_action_end($player_id));
	}

	public function reload_location(){
		$temp_data["location"] = $this->mlocation->get($_SESSION["user"]["id"], $_SESSION["user"]["location_id"]);
		$this->load->view("content/vlocation", $temp_data);
	}
	public function reload_main_menu(){
		$temp_data["location"] = $this->mlocation->get($_SESSION["user"]["id"], $_SESSION["user"]["location_id"]);
		$temp_data["player"] = $this->mplayer->get($_SESSION["user"]["id"]);
		
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

		$timer = $this->maction->do_action($player_id, $action_id);
		if((int)$timer){
			$action = new Action($action_id);
			$data = array();

			$data["timer"] = $timer;
			$data["action"] = $action->to_array();
			
		} else {
			$data = array();
			$data["error"] = $timer;
		}

		echo json_encode($data);
	}
	public function load_action($action_id, $player_id){
		$data["action"] = $action = $this->maction->get($action_id);
		$data["action"]["timer"] = $this->maction->calculate_timer($player_id, $action_id);
		$data["action"]["other_users"] = $this->maction->get_users_working_here($player_id, $action_id);
		$data["player"] = $this->mskill->get_by_action($player_id, $action_id);

		if(isSet($_SESSION["rewards"])){
			$data["rewards"] = $_SESSION["rewards"];
			unset($_SESSION["rewards"]);
		}

		$this->load->view("content/vaction", $data);
	}

	public function load_action_error($error, $action_id){
		$data["action"] = $this->maction->get($action_id);
		$data["error"] = $error;

		$this->load->view("content/vaction_error", $data);
	}

	public function complete_action(){
		$player_id = $this->input->post("player_id");
		$action_id = $this->input->post("action_id");

		echo json_encode($this->maction->complete($player_id, $action_id));
	}
	public function set_rewards_session(){
		$_SESSION["rewards"]["exp"] = $this->input->post("exp");
		$_SESSION["rewards"]["currency"] = $this->input->post("currency");
		$_SESSION["rewards"]["items"] = $this->input->post("items");
	}
	public function equip_item(){
		$player_id = $this->input->post("player_id");
		$item_id = $this->input->post("item_id");
		echo json_encode($this->mitem->equip($player_id, $item_id));
	}

	public function load_travel($player_id, $location_from_id, $location_to_id, $timer){
		$data["travel"]["image"] = $this->mlocation->get_travel_image($location_from_id, $location_to_id);
		$data["location_from"] = $this->mlocation->get($player_id,$location_from_id);
		$data["location_to"] = $this->mlocation->get($player_id,$location_to_id);
		$data["timer"] = $timer;

		$this->load->view("content/vtravel",$data);
	}
}	
?>