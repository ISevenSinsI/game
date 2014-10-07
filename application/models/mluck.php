<?php
Class MLuck extends CI_Model
{


	public function calculate_timer($player_id, $action_id){
		$player = new Player($player_id);
		$skills = $player->skill->include_join_fields();
		$luck = $skills->where("id", 3)->get();

		$luck_lvl = $luck->join_level;

		$users = $this->maction->get_users_working_here($player_id, $action_id);

		$extra_time = count($users) * 2;

		$action = new action($action_id);

		$timer_decrease = explode(".", $luck_lvl * 0.5)[0];

		$timer = ($action->base_time + $extra_time) - $timer_decrease;

		if($timer < 20){
			$timer = 20;
		}

		return $timer;
	}
}
?>