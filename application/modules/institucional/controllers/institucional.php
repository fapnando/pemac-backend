<?php	

class institucional extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->load->config('config');	
        $this->data = $this->base->startModule($this->config,'admin');     
    }
    
    function index(){
    	$this->data->institucional = $this->crud->select_by_array('institucional',array('ativo'=>'1'));        
        $this->load->view($this->data->module,$this->data);
    }    
}

?>