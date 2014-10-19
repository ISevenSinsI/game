<?php

class Building extends DataMapper {

    var $table = "buildings";
    
    var $has_one = array();
    
    var $has_many = array(
    	"action" => array(
    		"join_table" => "buildings"
    	),
    	"location" => array(
    		"join_table" => "buildings_locations"
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