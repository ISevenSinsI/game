<div class="building_actions pure-u-1-8">
	<h4>Actions</h4>
	<?php foreach($building["actions"] as $action): ?>
		<div class="building_action" data-action="<?= $action["id"]; ?>" data-building="<?= $building["id"]; ?>" data-player="<?= $_SESSION["user"]["id"]; ?>">
			<?= $action["name"]; ?> 
		</div>
	<?php endforeach; ?>
</div>
<div class="building_actions_wrapper pure-u-5-6">
	<div class="building_actions_content pure-u-3-4">	
		<h3><?= $building["name"];?></h3>
		<div class="building_image">
			<?php if(isset($building["image"])): ?>
				<img src="<?= $building['image']; ?>"/>
			<?php endif; ?>
		</div>
		<div class="pure-u-1 building_description">
			<?= $building["description"]; ?>
		</div>
	</div>
	<div class="pure-u-1-4 building_action_current_players">
		<h4>Other players working here</h4>
		<?php foreach($other_users 	as $_player): ?>
			<?= $_player; ?><br />
		<?php endforeach; ?>
	</div>
</div>
