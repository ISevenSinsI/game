<?php
Class MCooking extends CI_Model
{
	public function calculate_timer($player_id, $action_id){
		$action = new Action($action_id);
		$skill_id = $action->skill_id;

		$player = new Player($player_id);
		$skill = $player->skill->where("id", $skill_id)->include_join_fields()->get();

		$timer_decrease = explode(".", $skill->join_level / 3)[0];

		$users = $this->maction->get_users_working_here($player_id, $action_id);

		$extra_time = count($users) * 2;

		$timer = $action->base_time + $extra_time - $timer_decrease;

		if($timer < 20){
			$timer = 20;
		}

		return $timer;
	}

	public function calculate_reward_change($player_id, $reward_id){
		$reward = new Action_Reward($reward_id);
		$player = new Player($player_id);
		$action = new Action($reward->action_id);

		$cooking = $player->skill->where("id","7")->include_join_fields()->get();
		$chance_increase = $cooking->join_level - $action->level_required;
		
		$data = array();
		$succesful = false;

		if($reward->item_1_id > 0 && $reward->item_1_chance > 0){
			$rand = rand(0,100);
			if($rand <= ($reward->item_1_chance + $chance_increase)){
				$succesful = true;
				$amount = explode("::", $reward->item_1_amount);
				$rand = rand(0, count($amount));

				$rand--;
				if($rand == -1){$rand = 0;}

				$item_amount = $amount[$rand];
				
				$give = $this->mitem->give_item($player_id, $reward->item_1_id, $item_amount);

				$item = new Item($reward->item_1_id);
				$data["items"]["item_1"] = "You have obtained " . $item_amount . " " .$item->name . "."; 
			}	
			else {
				$item = new Item($reward->item_1_id);
				$explode = explode(" ", $item->name);
				if($explode[0] == "Cooked"){
					$data["items"]["item_1"] = "You burned the " . $explode[1] . ".";
				}
			}
		} 
	
		$data["exp"] = $this->calculate_experience($player_id, $reward_id, $succesful);

		return $data;
	}

	public function calculate_experience($player_id, $reward_id, $successful){
		$reward = new Action_Reward($reward_id);
		$action = new Action($reward->action_id);
		$exp = 0;

		$rand = rand(0,100);
		
		if($rand <= $reward->exp_chance){
			$player = new Player($player_id);
			$skill = $player->skill->where("id", $action->skill_id)->include_join_fields()->get();
			$current_exp = $skill->join_exp;

			if($successful){			
				$new_exp = $current_exp + $reward->exp;
				$exp = $reward->exp;
			} else {
				$new_exp = $current_exp + (floor($reward->exp / 2));
				$exp = floor($reward->exp / 2);
			}

			$player->set_join_field($skill, "exp", $new_exp);
		}

		return $exp;
	}
}