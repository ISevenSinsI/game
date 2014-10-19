<?php
Class MBuilding extends CI_Model
{
	public function get($id){
		$building = new Building($id);
		$temp_data = $building->to_array();
		$data = array();
		$data["id"] = $id;
		$data["name"] = $building->name;
		$data["description"] = $building->description;
		$data["image"] = $building->img_path;

		foreach($temp_data as $key => $_building){
			if(explode("_", $key)[0] == "action"){
				if($_building != "" && $_building > 0){
					$action = new Action($_building);
					$data["actions"][$key]["id"] = $action->id;
					$data["actions"][$key]["name"] = $this->maction->get_name_by_id($_building);
				}
			}			
		}

		return $data;
	}
}
?>