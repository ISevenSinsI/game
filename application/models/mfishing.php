<?php

class MFishing extends CI_Model
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
}