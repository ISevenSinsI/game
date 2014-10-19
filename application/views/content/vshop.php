<div class="shop_wrappper pure-u-1">	
	<div class="shop_buy pure-u-1-4">
		<h3>Buy items</h3>
		<?php if(isSet($shop["sell"])): ?>
			<table class="shop_buy_table">
				<thead>
					<tr>
						<th>Price</th>
						<th style="width: 40%;">Name</th>
						<th>Amount</th>
						<th>Buy</th>
					</tr>
				</thead>	
				<tbody>
					<?php foreach($shop["sell"] as $key => $item): ?>
						<tr>
							<td style="text-align:center;"><?= $item["price"]; ?></td>
							<td style="width: 40%; padding-left: 5%"><?= $item["name"]; ?></td>
							<td><input class="shop_input" type="text" data-item_buy_id="<?= $key; ?>"/></td>
							<td><div class="pure-button shop_button shop_buy_button" data-item_buy_id="<?= $key; ?>" data-shop_id="<?= $shop["id"]; ?>" data-player_id="<?= $_SESSION["user"]["id"]; ?>">Buy</div></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>

	<div class="shop_main pure-u-1-2">
		<h3><?= $shop["name"];?></h3>
		<div class="shop_image">
			<?php if(isset($shop["image"])): ?>
				<img src="<?= $shop['image']; ?>"/>
			<?php endif; ?>
		</div>
		<?php if(isSet($action)):?>
			<?= $action; ?>
		<?php endif; ?>
	</div>

	<div class="shop_buy pure-u-1-4">
		<h3>Sell items</h3>
		<?php if(isSet($shop["buy"])): ?>
			<table class="shop_buy_table">
				<thead>
					<tr>
						<th>Price</th>
						<th style="width: 40%;">Name</th>
						<th>Amount</th>
						<th>Buy</th>
					</tr>
				</thead>	
				<tbody>
					<?php foreach($shop["buy"] as $item): ?>
						<tr>
							<td style="text-align:center;"><?= $item["price"]; ?></td>
							<td style="width: 40%; padding-left: 5%"><?= $item["name"]; ?></td>
							<td><input class="shop_input" type="amount" data-item_id="<?= $key; ?>"/></td>
							<td><div class="pure-button shop_button shop_sell">sell</div></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</div>
