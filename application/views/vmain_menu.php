<div class="pure-u-1 town">
	<h3 class="town_header"><?= $location["name"]; ?></h3>
</div>
<div class="pure-u-1 travel">
	<h4>Travel</h4>
	<div class="travel_options">
		<?php foreach($location["travel_options"] as $key => $_travel): ?>
			<div class="travel_option" data-location_from_id="<?= $location['id']; ?>" data-location_to_id="<?= $key; ?>">
				<?= $_travel["name"]; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<div class="pure-u-1 actions">
	<h4>Actions</h4>
	<? if(isSet($location["actions"])): ?>
		<?php foreach($location["actions"] as $_action): ?>
			<div class="action_option"  data-action_id="<?= $_action["id"]; ?>">
				<?= $_action["name"];?>
			</div>
		<?php endforeach; ?>
	<? endif ?>
</div>
<div class="pure-u-1 inventory">
	<h4>Inventory</h4>
	<div class="inventory_inner">
		<?php foreach($player["inventory"] as $key => $_inventory): ?>
			<div class="pure-u-1-6 inventory_slot" data-item_id="<?= $_inventory['id']; ?>">	
				<?php if($_inventory["equiped"]): ?>
					<div class="equiped" src="<?= $_inventory['img_path'] ?>" 
					 title="<?= $_inventory["name"]; ?><br /> 
					 		<span class='item_amount'>
					 			amount: <?= $_inventory["amount"]; ?><br />
					 		</span>
					 		<span class='item_description'>
					 			<?= $_inventory["description"] ?>
					 		</span>
					 		"/>></div>
				<?php endif;?>

				<img class="item_image" src="<?= $_inventory['img_path'] ?>" 
					 title="<?= $_inventory["name"]; ?><br /> 
					 		<span class='item_amount'>
					 			amount: <?= $_inventory["amount"]; ?><br />
					 		</span>
					 		<span class='item_description'>
					 			<?= $_inventory["description"] ?>
					 		</span>
					 		"/>

				<div class="amount"></div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<style>
.item_description{
	font-size: 12px;
	font-size: italic;
}
.item_amount{
	font-size: 12px;
}
.ui-tooltip, .arrow:after {
	margin-left: 7.5%;
	background: rgba(58, 12, 12, 0.75);
	border: 2px solid white;	
}
.ui-tooltip {
	color: white;
	font-size: 14px;
	box-shadow: 0 0 7px black;
}
</style>
<script>
	$(".equiped").tooltip({
		show: {
	    	effect: "slideDown",
	    	delay: 500
	  	},
		content: function() {
        	return $(this).attr('title');
    	},
		position: {
	        my: "left bottom-20",
	        at: "left bottom",
	        using: function( position, feedback ) {
	          	$( this ).css( position );
	          	$( "<div>" )
	            	.addClass( "arrow" )
		            .addClass( feedback.vertical )
		            .addClass( feedback.horizontal )
		            .appendTo( this );
        }
      }
	});

	$(".item_image").tooltip({
		show: {
	    	effect: "slideDown",
	    	delay: 500
	  	},
		content: function() {
        	return $(this).attr('title');
    	},
		position: {
        // my: "center bottom-0",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
	});

</script>