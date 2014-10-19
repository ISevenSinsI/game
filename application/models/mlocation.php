<?php
class MLocation extends CI_Model
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("mskill");
    }

	public function get($player_id, $location_id){
		$location = new Location($location_id);
		$data = array();

		$data = $location->to_array();
		$data["travel_options"] = $this->get_travel_options_by($player_id,$location_id);
		$data["players_on_location"] = $this->get_players_on_location($location_id);
		$data["actions"] = $this->maction->get_by_location($location_id);
		$data["buildings"] = $this->get_buildings_by_location($location_id);
		$data["shops"] = $this->get_shops_by_location($location_id);

		return $data;
	}

	public function get_shops_by_location($id){
		$location = new location($id);
		$data = array();

		foreach($location->shop->get() as $_shop){
			$data[$_shop->name] = $_shop->to_array();
 		}

 		return $data;
	}

	public function get_buildings_by_location($id){
		$location = new location($id);
		$data = array();

		foreach($location->buildings->get() as $_building){
			$data[$_building->name] = $_building->to_array();
		}

		return $data;
	}

	public function get_players_on_location($location_id){
		$player = new Player();
		$data = array();

		foreach($player->where("location_id", $location_id)->get() as $_player){
			$data[] = $_player->username;
		}

		return $data;
	}
	
	public function get_travel_options_by($player_id, $location_id){
		$location_from = new Location($location_id);
		$travel_scheme = new Travel_scheme();	
		$data = array();

		foreach($travel_scheme
				->where("location_from_id", $location_from->id)
				->get() as $_scheme){

			$location_to = new Location($_scheme->location_to_id);

			$data[$location_to->id]["name"] = $location_to->name;
			$data[$location_to->id]["exp"] = $_scheme->exp;
			$data[$location_to->id]["timer"] = $this->mspeed->calculate_travel_time($player_id, $location_id, $location_to->id);

			$timer = $data[$location_to->id]["timer"];
		} 	
		
		foreach($travel_scheme
			->where("location_to_id", $location_from->id)
			->get() as $_scheme){

			$location_to = new Location($_scheme->location_from_id);

			$data[$location_to->id]["name"] = $location_to->name;
			$data[$location_to->id]["exp"] = $_scheme->exp;
			$data[$location_to->id]["timer"] = $this->mspeed->calculate_travel_time($player_id, $location_id, $location_to->id); 		
			$timer = $data[$location_to->id]["timer"];
		}
		return $data;	
	}

	public function go_to_location($player_id, $location_from_id, $location_to_id){
		$player = new Player($player_id);

		$timer = $this->mspeed->calculate_travel_time($player_id, $location_from_id, $location_to_id);

		$set = $this->mskill->set_action_end($player_id, $timer);

		return $timer;
	}

	public function get_travel_image($location_from_id,$location_to_id){
		$travel_scheme = new Travel_Scheme();

		$travel_scheme->where("location_from_id", $location_from_id)->where("location_to_id", $location_to_id)->get();

		if($travel_scheme->id == "" ){
			$travel_scheme->where("location_to_id", $location_from_id)->where("location_from_id",$location_to_id)->get();
			if($travel_scheme->id == ""){
				return false;
			}
		} 
		
		return $travel_scheme->img_path;
	}
}
?>