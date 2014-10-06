<?php

class Skill extends DataMapper {

    var $table = 'skills';
    
    var $has_one = array();
    
    var $has_many = array(
    	"player" => array(
    		"join_table" => "players_skills",
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