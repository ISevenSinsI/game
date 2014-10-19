$(document).ready(function(){
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

	$(".main_menu").on("click", ".town_header", function(){
		clear_all_intervals();
		reload_content();
	});

	$(".main_menu").on("click", ".building", function(){
		building_id = $(this).data("building_id");
		clear_all_intervals();

		$(".wrapper").load("ajax/load_building_view/" + building_id)
	});

	$(".wrapper").on("click",".building_action",function(){
		action_id = $(this).data("action");
		building_id = $(this).data("building");
		player_id = $(this).data("player");

		do_action_building(player_id, action_id, building_id);
	});
});

function go_to_location(player_id, location_from_id, location_to_id){
	clear_all_intervals();
	$.post("ajax/go_to_location",{
		player_id: player_id,
		location_from_id: location_from_id,
		location_to_id: location_to_id
	},function(data){
		data = jQuery.parseJSON(data);
		timer = parseFloat(data.timer);

		$(".wrapper").load("ajax/load_travel/" + player_id + "/" + location_from_id + "/" + location_to_id + "/" + timer);
		calculate_timer(data.timer, player_id, 0);		
	});
}

function change_location(player_id, location_to_id, location_from_id){
	clear_all_intervals();
	$.post("ajax/change_location",{
		player_id: player_id,
		location_to_id: location_to_id,
		location_from_id: location_from_id,
	},function(data){
		reload_content();
	});
}

function calculate_timer(timer, player_id, action_id, building_id){
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
				complete_action(player_id, action_id, building_id);
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

		if(response.timer){
			$(".wrapper").load("ajax/load_action/" + action_id + "/" + player_id);
			calculate_timer(data.timer, player_id, action_id, 0);
		} else {
			if(response.error == "item"){
				error = 1;
			} else if (response.error == "level"){
				error = 2;
			} else if (response.error == "material"){
				error = 3;
			}
			$(".wrapper").load("ajax/load_action_error/" + error + "/" + action_id);
		}
	});
}

function do_action_building(player_id, action_id, building_id){
	$.post("ajax/do_action",{
		player_id: player_id,
		action_id: action_id,
		building_id: building_id,
	},function(data){
		response = jQuery.parseJSON(data);

		if(response.timer){
			$(".building_actions_wrapper").load("ajax/load_action/" + action_id + "/" + player_id);
			calculate_timer(data.timer, player_id, action_id, building_id);
		} else {
			if(response.error == "item"){
				error = 1;
			} else if (response.error == "level"){
				error = 2;
			}  else if (response.error == "material"){
				error = 3;
			}
			$(".building_actions_wrapper").load("ajax/load_action_error/" + error + "/" + action_id);
		}
	});
}

function complete_action(player_id, action_id, building_id){
	clear_all_intervals();
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

		reload_main_menu();
		reload_right_menu();
		if(building_id > 0){
			do_action_building(player_id, action_id, building_id);	
		} else{
			do_action(player_id, action_id);	
		}
		
	});
}
function clear_all_intervals(){
	for (var i = 1; i < 10; i++){
        window.clearInterval(i);
	}
}

function equip_item(player_id, item_id){

	$.post("ajax/equip_item",{
		player_id: player_id,
		item_id: item_id
	},function(data){
		reload_main_menu();
	});
}