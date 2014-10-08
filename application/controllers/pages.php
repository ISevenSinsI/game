<?php
class Pages extends CI_Controller
{
	public function __construct(){
    	parent::__construct();
    	$this->load->model("mplayer");
    	$this->load->model("mskill");
    	$this->load->model("mlocation");
   	}

	public function index(){
		// session_unset();
		
		if(check_session()){

			$this->load->model("maction");
			($this->maction->calculate_reward_change(1,2));
			// debug($this->mitem->check_equiped(1,2));

			$player = $this->mplayer->get($_SESSION["user"]["id"]);
			$location = $this->mlocation->get($player["id"],$player["location_id"]);

			$data = array(
				"player" => $player,
				"location" => $location,
				"skills" => $this->mskill->get_all_by_player($player["id"]),
				"page_title" => "The game",
			);

			$this->load->view("vpage", $data);
		} else {
			redirect("login");
		}
	}
}
?>