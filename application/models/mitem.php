<?php
class MItem extends CI_Model
{
	public function get($id){
		$item = new Item($id);

		return $item->to_array();
	}

	public function equip($player_id, $item_id){
		$item = new Item($item_id);
		$item_slot = $item->equip_location_id;

		$item_equiped = new Item_equiped();
		$item_equiped->where("player_id", $player_id)->where("equip_location_id", $item_slot)->get();

		$item_equiped->player_id = $player_id;
		$item_equiped->item_id = $item_id;
		$item_equiped->equip_location_id = $item_slot;

		return $item_equiped->save();
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
		}
	}
}