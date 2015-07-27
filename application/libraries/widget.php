<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget {
    
    public function __construct(){
        $this->CI =& get_instance();
    }
    
    function run($module){
		return Modules::run($module);
    }
    
}