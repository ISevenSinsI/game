<?php
class MItem extends CI_Model
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	public function get($id){
		$item = new Item($id);

		return $item->to_array();
	}

	public function equip($player_id, $item_id){
		$item = new Item($item_id);
		$item_slot = $item->equip_location_id;

		// Checken of item in inventory is.
		if($this->in_inventory($player_id, $item_id)){
			// Checken of item equipable is.
			if($this->check_if_equipable($item_id)){
				$item_equiped = new Item_equiped();
				$item_equiped->where("player_id", $player_id)->where("equip_location_id", $item_slot)->get();

				$item_equiped->player_id = $player_id;
				$item_equiped->item_id = $item_id;
				$item_equiped->equip_location_id = $item_slot;
				return $item_equiped->save();
			}
		}
	}

	public function get_equiped($player_id){
		$items_equiped = new Item_Equiped();
		$data = array();

		foreach($items_equiped->get() as $_equiped){
			$data[] = $_equiped->to_array();
		}

		return $data;
	}

	public function check_equiped($player_id, $item_id){
		$item_equiped = new Item_Equiped();
		$item_equiped->where("player_id",$player_id)->where("item_id", $item_id)->get();

		if($item_equiped->id != "" && $item_equiped->id > 0){
			return true;
		} else {
			return false;
		}
	}

	public function give_item($player_id, $item_id, $amount){
		$inventory = $this->mplayer->get_inventory($player_id);

		$found = false;
		foreach($inventory as $key => $inv_slot){
			foreach($inv_slot as $_key => $inv){
				if($_key == "id" && $inv_slot["id"] == $item_id){
					$found = $inventory[$key];
				} else {
				}
			}
		}

		if($found != false){
			$check = "item_".$found["id"]."_amount";
			$new_amount = $found["amount"] + $amount;

			$inventory = new Inventory();
			$inventory->where("player_id",$player_id)->get();
			$inventory->$check = $new_amount;
			$inventory->save();

			return true;
		} else{
			// Check if there is a free spot
			$free_spot = $this->check_free_spot($player_id);
			if($free_spot != false){
				$item_slot_id = $free_spot ."_id";

				$item_amount = $free_spot . "_amount";

				$inventory = new Inventory();
				$inventory->where("player_id",$player_id)->get();
				$inventory->$item_slot_id = $item_id;

				$current_amount = $inventory->$item_amount;
				$new_amount = $current_amount + $amount;

				$inventory->$item_amount = $new_amount;
				$inventory->save();
			}
		}
	}

	public function check_free_spot($player_id){
		$inventory = new Inventory();	
		$inventory->where("player_id",$player_id)->get();
		$data = $inventory->to_array();

		foreach($data as $key => $inv_slot){
			if($inv_slot == 0){	
				$item_slot_id = explode("_id",$key)[0];
				$slot = $item_slot_id."_amount";

				$inventory->$slot = 0;
				$inventory->save();
				
				return $item_slot_id;
			}
		}

		return false;
	}

	public function check_if_equipable($item_id){
		$item = new Item($item_id);

		if($item->type_id == 1){
			return true;
		} else {
			return false;
		}
	}

	public function check_subtype_equiped($player_id, $subtype_id){
		if($subtype_id == 0){return true;}
		$inventory = new Inventory();
		$inventory->where("player_id",$player_id)->get();
		$data = $inventory->to_array();

		foreach($data as $slot){
			if($slot > 0){
				$item = new Item($slot);
				if($item->subtype_id == $subtype_id){
					if($this->check_equiped($player_id,$item->id)){
						return true;
					}
				}
			}
		}
		return false;
	}

	public function in_inventory($player_id,$item_id, $amount = 0){
		$inventory = $this->mplayer->get_inventory($player_id);

		foreach($inventory as $key => $_inventory){
			if($_inventory["id"] == $item_id){
				if($amount == 0){
					return true;
				} else {
					if($_inventory["amount"] >= $amount){
						return true;
					}
				}
			}
		}
		return false;
	}

	public function delete_item_from_inventory($player_id, $item_id, $amount){
		$inventory = new Inventory();
		$inventory->where("player_id", $player_id)->get();

		$temp_inventory = $this->mplayer->get_inventory($player_id);	

		foreach($temp_inventory as $key => $_temp_inventory){
			if($_temp_inventory["id"] == $item_id){
				$string = "item_".$key."_amount";
				$old_amount = $inventory->$string;
				$new_amount = $old_amount - $amount;
				$inventory->$string = $new_amount;
				$inventory->save();

				if($new_amount == 0){
					$string = "item_".$key."_id";
					$inventory->$string = 0;
					$inventory->save();

					// replace everything
					for($i = $key+1; $i <= 20; $i++){
						// New string must become Old string;
						$string_old_id = "item_".$i."_id";
						$string_old_amount = "item_".$i."_amount";
						
						$string_new_id = "item_".($i-1)."_id";
						$string_new_amount = "item_".($i-1)."_amount";

						$inventory->$string_new_id = $inventory->$string_old_id;
						$inventory->$string_new_amount = $inventory->$string_old_amount;

						$inventory->$string_old_id = 0;
						$inventory->$string_old_amount = 0;

						$inventory->save();
					}
				}

				return true;
			}
		}

		return false;
	}
}