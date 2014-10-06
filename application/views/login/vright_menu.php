<div class="map">
	<span class="pure-u-1-3 map_label">
		<h3><?= $location["name"]; ?></h3>
	</span>
</div>
<div class="sub_menu_right">
	<div class="char_info">
		<span class="player_username">
			<?= $player["username"]; ?>
		</span><br />
		<span class="player_character_level">
			Lvl: <?= $player["character"]["level"]; ?>
		</span><br />
		<span class="player_character_exp">
			Exp: <?= $player["character"]["exp"]; ?>
		</span><br />
		<span class="player_character_exp_next_lvl">
			Next lvl: <?= $player["character"]["exp_next_level"];?>
		</span><br />
		<span class="player_character_currency">
			Money: <?= $player["currency"]; ?>
		</span>
	</div>
	<div class="skills">
		<h4>Skills</h4>
		<?php foreach($skills as $_skill): ?>
			<?php if($_skill["name"] != "Character"): ?>
				<span class="skill_span" data-id="<?= $_skill['id']; ?>">
					<?= $_skill["name"]; ?>: Lvl. <?= $_skill["level"]; ?>
				</span><br />
				<span class="skill_exp" data-id="<?= $_skill['id']; ?>">
					Exp. <?= $_skill["exp"]; ?> / Next lvl. <?= $_skill['exp_next_level'];?>
				</span>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>