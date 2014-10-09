<html>
	<head>
		<title><?= $page_title; ?></title>
		<!-- Stylesheets -->
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
		<link rel="stylesheet" href="assets/css/style.css">

		<!-- Scripts -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
		<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
		<script src="<?= site_url('assets/js/useractions.js'); ?>"></script>
	</head>
	<body>
		<div class="pure-g">
			<div class="pure-u-1-6 main_menu">
				<?= $this->load->view("vmain_menu"); ?>
			</div>
			<div class="pure-u-2-3 wrapper">
				<?= $this->load->view("content/vlocation"); ?>
			</div>
			<div class="pure-u-1-6 right_menu">
				<?= $this->load->view("vright_menu"); ?>
			</div>			
		</div>
	</body>
</html>

<script>
	clear_all_intervals();
	one_time = false;

	$(".right_menu").on("hover", ".skill_span",function(){
		id = $(this).data("id");
		elem = $(".skill_exp[data-id='"+id+"']");
		current = elem.css("display");

		if(current == "none"){
			elem.css("display","block");
		} else {
			elem.css("display","none");
		}
	});

	$(".main_menu").on("click", ".inventory_slot",function(){
		if(one_time == false){
			one_time = true;

			setTimeout(function(){
				one_time = false;
			},1000);

			player_id = <?= $player["id"]; ?>;
			item_id = $(this).data("item_id");

			equip_item(player_id, item_id);
		}
	});


	$(".main_menu").on("click", ".town_header", function(){
		clear_all_intervals();
		reload_content();
	});

	$(".main_menu").on("click", ".action_option", function(){
		if(one_time == false){
			one_time = true;

			clear_all_intervals();

			setTimeout(function(){
				one_time = false;
			},1000);

			player_id = <?= $player["id"] ?>;
			action_id = $(this).data("action_id");

			do_action(player_id, action_id);
		}
	});


	$(".main_menu").on("click", ".travel_option", function(){
		if(one_time == false){
			one_time = true;

			clear_all_intervals();

			setTimeout(function(){one_time = false;},1000);

			var response;
			player_id = <?= $player["id"] ?>;
			location_from_id = $(this).data("location_from_id");
			location_to_id = $(this).data("location_to_id");

			go_to_location(player_id, location_from_id, location_to_id);

			var interval = setInterval(function() {
			    $.get("ajax/get_travel_end/" + player_id, function(e) {
			        response = jQuery.parseJSON(e);
			        if (response === true) {
			            clearInterval(interval);
			            location_change = change_location(player_id, location_to_id, location_from_id);
			        }
			    })
			},2500);
		}
	});
</script>