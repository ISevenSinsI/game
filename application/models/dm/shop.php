<?php

class Shop extends DataMapper {

    var $table = "shops";
    
    var $has_one = array();
    
    var $has_many = array(
    	"item" => array(
    		"join_table" => "shops_items"
    	),
    	"location" => array(
    		"join_table" => "shops_locations"
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