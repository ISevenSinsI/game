<div class="actions_wrapper pure-u-2-3">
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
					if($key != "currency" || $_reward != 0){
						echo "You have gained " . $_reward . " " . $key . "<br />";
					}
				}
			}
		} 
?>
	</div>
</div>

<div class="pure-u-1-4 action_current_players">
	<h4>Other players working here</h4>
	<?php foreach($action["other_users"] as $_player): ?>
		<?= $_player; ?><br />
	<?php endforeach; ?>
</div>