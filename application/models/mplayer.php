<?php
class MPlayer extends CI_Model{

	public function __construct(){
    	parent::__construct();
    	$this->load->model("mitem");
   	}

	public function get($id){
		$player = new Player($id);
		$data = array();

		$data["id"] = $player->id;
		$data["username"] = $player->username;
		$data["character"] = $this->mskill->get_by_name("character", $player->id);
		$data["currency"] = $player->currency;
		$data["location_id"] = $player->location_id;
		$data["rank_id"] = $player->rank_id;
		$data["action_end"] = $player->action_end;
		$data["inventory"] = $this->get_inventory($id);

		return $data;
	}

	public function check_action_end($player_id){
		$player = new Player($player_id);

		$action_end = $player->action_end;
		$current_time = strtotime(date("Y-m-d H:i:s"));

		if($action_end <= $current_time)
		{
			$player->action_end = 99999 * 100;
			$player->save();
			return true;
		} else {
			return false;
		}
	}

	public function change_location($player_id,$location_to_id, $location_from_id){
		$player = new Player($player_id);

		if($_SESSION["user"]["username"] == $player->username 
			&& $this->check_action_end($player_id)){

			$player->location_id = $location_to_id;

			$this->mspeed->give_exp($player_id, $location_from_id, $location_to_id);

			return $player->save();
		} else {
			return false;
		}
	}

	public function get_inventory($player_id){
		$player = new Player($player_id);
		$inventory = $player->inventory->get();
		$temp_data = $inventory->to_array();

		$pattern = "/(\d+)/";

		foreach($temp_data as $key => $inv){
			$conditions = preg_split($pattern, $key, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
			if(isSet($conditions[1])){
				if(is_numeric($conditions[1]) && $conditions[2] != "_amount"){	
					$slot_id = preg_split($pattern, $key, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE)[1];
					$item_id = $inv;
					$array_item = "item_" . $item_id . "_amount";

					$data["item_" + $slot_id] = $this->mitem->get($item_id);

					$data["item_" + $slot_id]["amount"] = $inventory->{$array_item};
					$data["item_" + $slot_id]["equiped"] = $this->mitem->check_equiped($player_id, $item_id);
				}
			}
		}
		
		return $data;
	}

	public function check_required_level($player_id,$skill_id, $required){
		$player = new Player($player_id);
		$skill = $player->skill->where("id", $skill_id)->include_join_fields()->get();

		if($skill->join_level == "" && $skill->join_exp == ""){
			$skill->id =  $skill_id;
			$player->save($skill);

			$skill->set_join_field($player, "player_id", $player_id);
			$skill->set_join_field($player, "level", 1);
			$skill->set_join_field($player, "exp", 1);
			
			$skill = $player->skill->where("id", $skill_id)->include_join_fields()->get();
		}

		if($skill->join_level >= $required){
			return true;
		} else {
			return false;
		}
		
 	}

 	public function check_authentication($player_id){
 		if($player_id == $_SESSION["user"]["id"]){
 			return true;
 		} else{
 			return false;
 		}
 	}

 	public function check_shop_authentication($shop_id){
 		$shop = new Shop($shop_id);
 		$location = $shop->location->get();

 		if($_SESSION["user"]["location_id"] === $location->id){
 			return true;
 		} else {
 			return "Don't try fucking around with SQL injections =]";
 		}
 	}

 	public function check_building_authentication($building_id){
 		$building = new Building($building_id);
 		$location = $building->location->get();

 		if($_SESSION["user"]["location_id"] === $location->id){
 			return true;
 		} else {
 			return "Don't try fucking around with SQL injections =]";
 		}
 	}
}
?>	



