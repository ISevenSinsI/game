<?php

class Action extends DataMapper {

    var $table = "actions";
    
    var $has_one = array();
    
    var $has_many = array(
    	"location" => array(
    		"join_table" => "actions_locations"
    	),
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