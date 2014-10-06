<?php
Class MSkill extends CI_Model
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("mspeed");
        $this->load->model("maction");
    }

	public function get_all_by_player($id){
		$player = new Player($id);
		$skills = $player->skill;
		$data = array();

		foreach($skills->include_join_fields()->get() as $_skill){

			$data[$_skill->name]["id"] = $_skill->id;
			$data[$_skill->name]["name"] = $_skill->name;
			$data[$_skill->name]["exp"] = $_skill->join_exp;
			$data[$_skill->name]["level"] = $this->calculate_skill_level($id, $_skill->id, $_skill->join_exp);
			$data[$_skill->name]["exp_next_level"] = $this->get_remaining_exp($_skill->join_exp);
		}

		return $data;
	}

	public function set_action_end($player_id, $timer){
		$current_time = strtotime(date("Y-m-d H:i:s"));
		$action_end = $current_time + $timer;

		$player = new Player($player_id);
		$player->action_end = $action_end;
		$player->save();

		return $action_end;
	}

	public function get_by_name($name, $player_id){
		$player = new Player($player_id);
		$skill = $player
				 ->skill
				 ->where("name", $name)
				 ->include_join_fields()
				 ->get();

		$data = array(
			"level" => $skill->join_level,
			"exp" => $skill->join_exp,
			"exp_next_level" => $this->get_remaining_exp($skill->join_exp),
		);

		return $data;
	}

	public function get_remaining_exp($current_skill_exp){
		$exp_table = new Exp_Table();

		if($current_skill_exp != 0){
			$exp_table
				->where("exp <=", $current_skill_exp)
				->where("exp_max >=", $current_skill_exp)
				->get();
		} else {
			$exp_table->get(1);
		}

		return ($exp_table->exp_max - $current_skill_exp ) + 1;
	}

	public function calculate_skill_level($player_id, $skill_id, $current_skill_exp){
		if($current_skill_exp != 0){
			$exp_table = new Exp_Table();
			$exp_table
				->where("exp <=", $current_skill_exp)
				->where("exp_max >=", $current_skill_exp)
				->get();
		}

		$player = new Player($player_id);
		$skill = $player->skill;
		$skill->where("id", $skill_id)->include_join_fields()->get();
		$skill->set_join_field($player, "level", $exp_table->level);

		return $skill->join_level;
	}
}
?>