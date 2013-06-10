<?php

class AppController {
    
    public $Model;

    protected $get  = array();

    public function __construct () {

     }

     public function  set ($name , $value) {
        $this->get['name'] = $name;
        $this->get['value'] = $value;
     }

     public function getvar() {
        return $this->get;
     }

     public function model_obj ($nume,$obj) {
            $this->{$nume}= $obj;
     }
}

?>