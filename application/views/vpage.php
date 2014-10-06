<html>
	<head>
		<title><?= $page_title; ?></title>
		<!-- Stylesheets -->
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
		<link rel="stylesheet" href="assets/css/style.css">

		<!-- Scripts -->
		<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
		<script src="assets/js/useractions.js"></script>
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
	one_time = false;

	$(".right_menu").on("click", ".skill_span",function(){
		id = $(this).data("id");

		$(".skill_exp[data-id='"+id+"']").toggle();
	});

	$(".main_menu").on("click", ".action_option", function(){
		if(one_time == false){
			one_time = true;

			setTimeout(function(){
				one_time = false;
			},1000);

			player_id = <?= $player["id"] ?>;
			action_id = $(this).data("action_id");

			console.log(action_id);
			do_action(player_id, action_id);
		}
	});

	$(".main_menu").on("click", ".travel_option", function(){
		if(one_time == false){
			one_time = true;

			setTimeout(function(){one_time = false;},1000);

			var response;
			player_id = <?= $player["id"] ?>;
			location_from_id = $(this).data("location_from_id");
			location_to_id = $(this).data("location_to_id");

			go_to_location(player_id, location_from_id, location_to_id);

			var interval = setInterval(function() {
			    check_action_end(player_id);
			    $.get("ajax/get_action_end", function(e) {
			        response = jQuery.parseJSON(e);
			        if (response === "true") {
			            stop_interval(interval);
			            location_change = change_location(player_id, location_to_id, location_from_id)
			        }
			    })
			})
		}
	});
</script>