<?php
Class MAction extends CI_Model{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("mluck");
    }
   	public function get_timer($id){
   		$action = new Action($id);
   		$data = array();

   		$data = $action->to_array();
   	}
	public function get_by_location($location_id){
		$location = new Location($location_id);
		$action = $location->action;
		$data = array();

		foreach($action
				->include_join_fields()
				->get() as $_action){
			$data[] = $_action->to_array();
		}

		return $data;
	}

	public function do_action($player_id, $action_id){
		$action = new Action($action_id);
		$timer = $this->calculate_timer($player_id, $action_id);

		return $timer;
	}

	public function calculate_timer($player_id, $action_id){
		$action = new Action($action_id);

		if($action->skill_id == "3"){
			$timer = $this->mluck->calculate_timer($player_id, $action_id);
		}

		return $timer;
	}
}
?>