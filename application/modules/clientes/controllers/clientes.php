<?php	

class clientes extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->load->config('config');	
        $this->data = $this->base->startModule($this->config,'admin');     
    }
    
    function index(){
        $this->data->clientes = $this->crud->select_by_array('clientes',array('ativo'=>1));      
        $this->load->view($this->data->module,$this->data);
    } 

    function getProjects(){
    	$id = $this->input->post('cliente');
    	$projetos = $this->crud->select_by_array('projetos',array('cliente'=>$id));
    	echo json_encode($projetos);
    }   
}

?>