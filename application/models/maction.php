<?php
Class MAction extends CI_Model{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("mluck");
        $this->load->model("mwoodcutting");
        $this->load->model("mfishing");
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
		$player = new Player($player_id);

		// Check if have required lvl.	
		if($this->mplayer->check_required_level($player_id,$action->skill_id, $action->level_required)){
			// Check if item is equiped
			if($this->mitem->check_subtype_equiped($player_id, $action->item_subtype_required_id)){
				$player->action_id = $action_id;
				$player->save();

				$timer = $this->calculate_timer($player_id, $action_id);

				return $timer;
			} else {
				return "item";
			}
		} else {
			return "level";
		}
	}

	public function calculate_timer($player_id, $action_id){
		$action = new Action($action_id);

		if($action->skill_id == "3"){
			$timer = $this->mluck->calculate_timer($player_id, $action_id);
		}
		if($action->skill_id == "4"){
			$timer = $this->mwoodcutting->calculate_timer($player_id, $action_id);
		}
		if($action->skill_id == "5"){
			$timer = $this->mfishing->calculate_timer($player_id,$action_id);
		}

		return $timer;
	}

	public function complete($player_id, $action_id){
		$data = array();

		if($this->mplayer->check_action_end($player_id)){
			$player = new Player($player_id);
			$player->action_id = 0;
			$player->save();

			$action = new Action($action_id);
			$reward = new Action_Reward();
			$reward->where("action_id",$action_id)->get();

			$data["exp"] = $this->calculate_experience($player_id,$reward->id);
			$data["currency"] = $this->calculate_currency($player_id, $reward->id);
			$data["items"] = $this->calculate_reward_change($player_id, $reward->id);
		}

		return $data;
	}

	public function calculate_reward_change($player_id, $reward_id){
		$reward = new Action_Reward($reward_id);
		$player = new Player($player_id);
		
		$luck = $player->skill->where("id", "3")->include_join_fields()->get();
		
		$chance_increase = explode(".", $luck->join_level * 0.25)[0];

		$data = array();

		if($reward->item_1_id > 0 && $reward->item_1_chance > 0){
			$rand = rand(0,100);
			if($rand <= ($reward->item_1_chance + $chance_increase)){
				$amount = explode("::", $reward->item_1_amount);
				$rand = rand(0, count($amount));

				$rand--;
				if($rand == -1){$rand = 0;}

				$item_amount = $amount[$rand];
				
				$give = $this->mitem->give_item($player_id, $reward->item_1_id, $item_amount);

				$item = new Item($reward->item_1_id);
				$data["item_1"]["name"] = $item->name; 
				$data["item_1"]["amount"] = $item_amount;
			}	
		}
		if($reward->item_2_id > 0 && $reward->item_2_chance > 0){
			$rand = rand(0,100);
			if($rand <= ($reward->item_1_chance + $chance_increase)){
				$amount = explode("::", $reward->item_2_amount);
				$rand = rand(0, count($amount));

				$rand--;
				if($rand == -1){$rand = 0;}

				$item_amount = $amount[$rand];
				
				$give = $this->mitem->give_item($player_id, $reward->item_2_id, $item_amount);

				$item = new Item($reward->item_2_id);
				$data["item_2"]["name"] = $item->name; 
				$data["item_2"]["amount"] = $item_amount;
			}	
		}

		return $data;
	}

	public function calculate_experience($player_id, $reward_id){
		$reward = new Action_Reward($reward_id);
		$action = new Action($reward->action_id);
		$exp = 0;

		$rand = rand(0,100);
		
		if($rand <= $reward->exp_chance){
			$player = new Player($player_id);
			$skill = $player->skill->where("id", $action->skill_id)->include_join_fields()->get();

			$current_exp = $skill->join_exp;
			$new_exp = $current_exp + $reward->exp;
			$exp = $reward->exp;

			$player->set_join_field($skill, "exp", $new_exp);
		}

		return $exp;
	}

	public function calculate_currency($player_id, $reward_id){
		$reward = new Action_Reward($reward_id);
		$currency = 0;

		$rand = rand(0,100);
		
		if($rand <= $reward->currency_chance){
			$player = new Player($player_id);

			$current = $player->currency;
			$new = $current + $reward->currency;

			$currency = $reward->currency;

			$player->currency = $new;
			$player->save();
		}

		return $currency;
	}

	public function get_users_working_here($player_id, $action_id){
		$player = new Player();
		$data = array();

		$current_time = strtotime(date("Y-m-d"));
		foreach($player->where("action_id", $action_id)->where("action_end >", $current_time)->get() as $_player){
			if($_player->id != $player_id){
				$data[] = $_player->username;
			}
		}

		return $data;
	}
}
?>