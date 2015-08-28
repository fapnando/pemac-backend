<?php	

class cases extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->load->config('config');	
        $this->data = $this->base->startModule($this->config,'admin');     
    }
    
    function index(){
    	$this->data->cases = $this->crud->select_by_array('cases',array('ativo'=>1));
    	foreach($this->data->cases as &$case){
    		$auxiliar = $this->crud->select_by_array('routes',array('id'=>$case['id_route']));
    		if(count($auxiliar)>0){
    			$case['link'] = base_url().'cases/'.$auxiliar[0]['slug'];
    		}
    	}        
        $this->load->view('cases',$this->data);
    }

    function ver($slug=false){
    	$route = $this->crud->select_by_array('routes',array('slug'=>$slug));
    	if(count($route)>0){
	    	$auxiliar = explode('/', $route[0]['route']);
	    	$case = $this->crud->select_by_array('cases',array('id'=>$auxiliar[2]));
	    	if(count($servico)>0){
	    		$this->load->view('cases_ver',$this->data);
	    	}
    	}
    }  
}

?>