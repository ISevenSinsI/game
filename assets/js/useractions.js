function go_to_location(player_id, location_from_id, location_to_id){
	$.post("ajax/go_to_location",{
		player_id: player_id,
		location_from_id: location_from_id,
		location_to_id: location_to_id
	},function(data){
		data = jQuery.parseJSON(data);
		timer = parseFloat(data.timer);

		html = "";
		html += "You are currenctly traveling to " + data.location_to + "<br />";
		html += "This will take you " + data.timer + " seconds.<br/>"
		html += "<input id='input_timer' type='text' name='timer' value='"+timer+"' readonly/>";
		$(".wrapper").html(html);

		calculate_timer(data.timer, player_id, 0);		
	});
}

function change_location(player_id, location_to_id, location_from_id){
	$.post("ajax/change_location",{
		player_id: player_id,
		location_to_id: location_to_id,
		location_from_id: location_from_id,
	},function(data){
		reload_content();
	});
}

function calculate_timer(timer, player_id, action_id){
	if(typeof inter !== "undefined"){
		clearInterval(inter);
	}

	$(".wrapper").find($("input[name='timer']")).val(timer);

	inter = setInterval(function() {
		elem = $(".wrapper").find($("#input_timer"));
		timer= elem.val();
      	timer--;
      	elem.val(timer);

      	if(timer <= 0){
      		clearInterval(inter);
			if(action_id > 0){
				complete_action(player_id, action_id);
			}
		}

	}, 1000);
}

function check_action_end(player_id){

	$.post("ajax/check_action_end",{
	      	player_id: player_id
	  	},function(data){   
	  		
  		}
  	);
}
function reload_content(){
	reload_location();
	reload_main_menu();
	reload_right_menu();
}

function reload_location(){
	$(".wrapper").load("ajax/reload_location");
}

function reload_main_menu(){
	$(".main_menu").load("ajax/reload_main_menu");
}

function reload_right_menu(){
	$(".right_menu").load("ajax/reload_right_menu");
}

function do_action(player_id, action_id){
	$.post("ajax/do_action",{
		player_id: player_id,
		action_id: action_id,
	},function(data){
		response = jQuery.parseJSON(data);

		$(".wrapper").load("ajax/load_action/" + action_id + "/" + player_id);

		calculate_timer(data.timer, player_id, action_id);
	});
}

function complete_action(player_id, action_id){
	$.post("ajax/complete_action",{
		player_id: player_id,
		action_id: action_id
	},function(data){
		response = jQuery.parseJSON(data);

		$.post("ajax/set_rewards_session",{
			items: response.items,
			exp: response.exp,
			currency: response.currency
		},function(data){

		});

		reload_right_menu();
		do_action(player_id, action_id);
	});
}
function clear_all_intervals(){
	for (var i = 1; i < 10; i++){
        window.clearInterval(i);
	}
}