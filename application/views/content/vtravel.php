<div class="actions_wrapper pure-u-2-3">
	<div class="actions_content pure-u-1">
		<h3>You are currently travelling from <?= $location_from["name"]; ?> to <?= $location_to["name"]; ?></h3>
		This will take you <?= $timer; ?> seconds.
		<div class="action_image">
			<?php if(isset($travel["image"])): ?>
				<img src="<?= $travel['image']; ?>"/>
			<?php endif; ?>
			<input id="input_timer" class="action_timer" type="text" name="timer" value="<?= $timer; ?>" readonly/>
		</div>
		<div class="action_description">
			
		</div>
	</div>