<div class="town">
	<h3 class="town_header"><?= $location["name"]; ?></h3>
</div>
<div class="travel">
	<h4>Travel</h4>
	<span class="travel_options">
		<?php foreach($location["travel_options"] as $key => $_travel): ?>
			<div class="travel_option" data-location_from_id="<?= $location['id']; ?>" data-location_to_id="<?= $key; ?>">
				<?= $_travel["name"]; ?>
			</div>
		<?php endforeach; ?>
	</span>
</div>
<div class="actions">
	<h4>Actions</h4>
	<? if(isSet($location["actions"])): ?>
		<?php foreach($location["actions"] as $_action): ?>
			<div class="action_option"  data-action_id="<?= $_action["id"]; ?>">
				<?= $_action["name"];?>
			</div>
		<?php endforeach; ?>
	<? endif ?>
</div>
<div class="inventory">
	
</div>