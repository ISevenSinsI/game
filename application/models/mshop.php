<?php
Class MShop extends CI_Model{

	public function get($id){
		$shop = new Shop($id);
		$data = array();

		$data["id"] = $id;
		$data["name"] = $shop->name;
		$data["image"] = $shop->img_path;

		foreach($shop->item->include_join_fields()->get() as $item){
			if($item->join_sell_price > 0){
				$data["sell"][$item->id]["name"] = $item->name;
				$data["sell"][$item->id]["price"] = $item->join_sell_price;
				$data["sell"][$item->id]["image"] = $item->img_path;
			}
			if($item->join_buy_price > 0){
				$data["buy"][$item->id]["name"] = $item->name;
				$data["buy"][$item->id]["price"] = $item->join_buy_price;	
				$data["buy"][$item->id]["image"] = $item->img_path;
			}
		}

		return $data;
	}

	public function buy_item($shop_id, $player_id, $item_id, $amount){
		$player = new Player($player_id);

		$shop = new Shop($shop_id);
		$item = $shop->item->where("id", $item_id)->include_join_fields()->get();
		$price = $item->join_buy_price;

		$total_price = $price * $amount;

		if($player->currency >= $total_price){
			if($this->mitem->give_item($player_id, $item_id, $amount)){
				$player->currency = $player->currency - $total_price;
				$player->save();
				return "You bought " . $amount . " " . $item->name . ".";
			} else {
				return "Not enough space.";
			}
		} else {
			return "Not enough money.";
		}
	}
}