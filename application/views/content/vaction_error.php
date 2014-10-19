<div class="actions_wrapper pure-u-3-4">
	<div class="actions_content pure-u-1">
		<h3><?= $action["name"];?></h3>
		<div class="action_image">
			<?php if(isset($action["img_path"])): ?>
				<img src="<?= $action['img_path']; ?>"/>
			<?php endif; ?>
		</div>		
		<div class="action_description">
			<?php if($error == 1): ?>
				You do not have the required item type equiped to work here.
			<?php elseif($error == 2): ?>
				You do not meet the required level criteria to work here.
			<?php elseif($error == 3): ?>
				You do not have the required materials.
			<?php endif;?>
		</div>
	</div>
</div>