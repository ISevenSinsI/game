<?php
class MLogin extends CI_Model
{
	public function login_validate($username, $password){
		$username = strtolower($username);
		$password = substr($password,0,-10);

		$player = new Player();
		$player->where(strtolower("username"),$username)->get();

		if($player->id != "0" && $player->id != ""){
			if($password == $player->password){
				$player->last_ip = $_SERVER["REMOTE_ADDR"];
				$player->save();

				$_SESSION["user"] = $player->to_array();
				$_SESSION["user"]["action_end_check"] = false;

				return true;
			} else {
				return false;
			}
		}
	}
}
?>