<?php

class Player extends DataMapper {

    var $table = "players";
    
    var $has_one = array(
        "location",
        "inventory"
    );
    
    var $has_many = array(
        "skill",
        "item"
    );

    var $validation = array();

    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function post_model_init($from_cache = FALSE) {
        
    }
    function to_array(){
    	$data = array();

    	foreach($this->stored as $key => $attr){
    		$data[$key] = $attr;
    	}

    	return $data;
    }
}