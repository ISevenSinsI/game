<div class="actions_wrapper pure-u-3-4">
	<div class="actions_content pure-u-1">
		<h3><?= $action["name"];?></h3>
		<div class="action_image">
			<?php if(isset($action["img_path"])): ?>
				<img src="<?= $action['img_path']; ?>"/>
			<?php endif; ?>
			<input id="input_timer" class="action_timer" type="text" name="timer" value="<?= $action['timer']; ?>" readonly/>
		</div>
		<div class="action_description">
			<?= $action["description"]; ?><br />
			This will take <?= $action["timer"]; ?> seconds.
		</div>
	</div>
	<div class="action_results pure-u-1">
<?php 	if(isset($rewards)){
		
			foreach($rewards as $key => $_reward){
				if($_reward != ""){
					if($key == "currency" && $_reward != 0){
						echo "You have earned " . $_reward . " " . $key . "<br />";	
					} else if($key == "exp"){
						echo "You have gained " . $_reward . " " . $key . "<br />";	
					}
					if($key == "items"){
						foreach($_reward as $item){
							echo $item . "<br/>";
						}
					}
				}
			}
		} 
?>
	</div>

	<div class="action_skill_level pure-u-1">
	 	<?= "<br />	Level " . $player["level"] . " (" . number_format($player["exp"]) ." exp) <br /> Next: ". number_format($player["exp_next_level"]) . " exp"; ?>
	</div>
</div>

<div class="pure-u-1-6 action_current_players">
	<h4>Other players working here</h4>
	<?php foreach($action["other_users"] as $_player): ?>
		<?= $_player; ?><br />
	<?php endforeach; ?>
</div>