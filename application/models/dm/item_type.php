<?php

class Equip_Location extends DataMapper {

    var $table = "equip_locations";
    
    var $has_one = array();
    
    var $has_many = array( );

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