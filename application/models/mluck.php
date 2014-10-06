<?php
Class MLuck extends CI_Model
{
	public function calculate_timer($player_id, $action_id){
		$player = new Player($player_id);
		$skills = $player->skill->include_join_fields();
		$luck = $skills->where("id", 3)->get();

		$luck_lvl = $luck->join_level;

		$action = new action($action_id);

		$timer_decrease = explode(".", $luck_lvl * 0.75)[0];

		$timer = $action->base_time - $timer_decrease;

		return $timer;
	}
}
?>