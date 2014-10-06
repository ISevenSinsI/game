<div class="pure-u-2-3 location_wrapper">
	<h1 class="location_town_name"><?= $location["name"]; ?></h1>

	<img class="location_img" src="<?= $location["img_path"]; ?>"/>

	<div class="location_description">
		<?= $location["description"]; ?>
	</div>
</div>

<div class="pure-u-1-4 location_players_this_location">
	<h4 class="players_location_head">Players on this location</h4>

	<div class="location_players_list">
	 	<?php foreach($location["players_on_location"] as $_player): ?>
	 		<?= $_player; ?>
	 	<?php endforeach; ?>
	</div>
</div>