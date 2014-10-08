<?php

class Item extends DataMapper {

    var $table = "items";
    
    var $has_one = array();
    
    var $has_many = array(
    	// Bonus
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