<?php

class Action_Reward extends DataMapper {

    var $table = "actions_rewards";
    
    var $has_one = array("action");
    
    var $has_many = array();

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