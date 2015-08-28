<?php	

class projetos extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->load->config('config');	
        $this->data = $this->base->startModule($this->config,'admin');     
    }
    
    function index(){        
        $this->load->view($this->data->module,$this->data);
    }    
}

?>