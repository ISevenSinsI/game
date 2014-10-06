<?php
class MSpeed extends CI_Model
{
	public function calculate_travel_time($player_id, $location_from_id, $location_to_id){
		// Get player speed lvl
		$speed_level = $this->mskill->get_by_name("travelling", $player_id);
		$speed_level = $speed_level["level"];

		// Calculate his base speed, 0,5 per lvl
		$base_speed = ($speed_level / 2);

		// Get location
		$location = new Location($location_from_id);
			

		// Get travel scheme
		$travel_scheme = new Travel_scheme();
		$travel_scheme
			->where("location_from_id", $location_from_id)
			->where("location_to_id", $location_to_id)
			->get();


		// If not found try looking other way around.
		if(!isSet($travel_scheme->id) || $travel_scheme->id == ""){
			$travel_scheme
			->where("location_to_id", $location_from_id)
			->where("location_from_id", $location_to_id)
			->get();			
		}

		// Split outcome for round numbers
		$timer_decrease = explode(".", $base_speed / 1.5);

		// fence of null values
		if($timer_decrease[0] == 0){
			$timer_decrease = "0";
		} else {
			$timer_decrease = $timer_decrease[0];
		}
		

		//  Calculate actual timer
		$timer = ($travel_scheme->base_time - $timer_decrease);

		if($timer < 20){
			$timer = 20;
		}

		return $timer;
	}		
	public function give_exp($player_id, $location_from_id, $location_to_id){
		$player = new Player($player_id);

		// debug($player->to_array());
		$scheme = new Travel_Scheme();

		$scheme ->where("location_from_id", $location_from_id)
				->where("location_to_id", $location_to_id)
				->get();

		if(!isset($scheme->id) || $scheme->id == ""){
			$scheme ->where("location_from_id", $location_to_id)
					->where("location_to_id", $location_from_id)
					->get();
		} 

		$exp_gain = $scheme->exp;

		$player = new Player($player_id);
		$skill = $player->skill;
		$skill->where("id", 2)->include_join_fields()->get();

		$current_exp = $skill->join_exp;
		$new_exp = $current_exp + $exp_gain;

		$skill->set_join_field($player, "exp", $new_exp);

		$char = $player->skill;
		$char->where("id", 1)->include_join_fields()->get();

		$current_char_exp = $char->join_exp;
		$char_exp_gain = round($exp_gain * 0.45);
		$new_char_exp = $current_char_exp + $char_exp_gain;

		$char->set_join_field($player, "exp", $new_char_exp);
	}
}
?>