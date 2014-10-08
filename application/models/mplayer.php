<?php
class MPlayer extends CI_Model{

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

		return $data;
	}

	public function check_action_end($player_id){
		$player = new Player($player_id);

		$action_end = $player->action_end;
		$current_time = strtotime(date("Y-m-d H:i:s"));

		if($action_end <= $current_time)
		{
			$player->action_end = 0;
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

}
?>