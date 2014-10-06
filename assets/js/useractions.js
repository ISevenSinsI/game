function go_to_location(player_id, location_from_id, location_to_id){
	$.post("ajax/go_to_location",{
		player_id: player_id,
		location_from_id: location_from_id,
		location_to_id: location_to_id
	},function(data){
		console.log(data);

		data = jQuery.parseJSON(data);
		timer = parseFloat(data.timer);

		html = "";
		html += "You are currenctly traveling to " + data.location_to + "<br />";
		html += "This will take you " + data.timer + " seconds.<br/>"
		html += "<input class='input_timer' type='text' name='timer' value='"+timer+"' readonly/>";
		$(".wrapper").html(html);

		calculate_timer(data.timer, player_id);		
	});
}

function change_location(player_id, location_to_id, location_from_id){
	$.post("ajax/change_location",{
		player_id: player_id,
		location_to_id: location_to_id,
		location_from_id: location_from_id,
	},function(data){
		// console.log(data);

		reload_content();
	});
}

function calculate_timer(data, player_id){
	if(typeof inter !== "undefined"){
		clearInterval(inter);
	}

	input = $(".wrapper").find($("input[name='timer']")).val(data);
	
	timer = input.val();

	inter = setInterval(function() {
      	timer--;
      	$("input[name='timer']").val(timer);

      	if(timer <= 0){
			stop_interval(inter);
			check_action_end(player_id);
		}
	}, 1000);
}

function stop_interval(interval){
	clearInterval(interval);
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
		data = jQuery.parseJSON(data);

		$(".wrapper").load("ajax/load_action/" + action_id + "/" + player_id);

		calculate_timer(data.timer, player_id);
	});
}