<?php
class MItem extends CI_Model
{
	public function get($id){
		$item = new Item($id);

		return $item->to_array();
	}
}