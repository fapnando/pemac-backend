<?php	

class servicos extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->load->config('config');	
        $this->data = $this->base->startModule($this->config,'admin');     
    }
    
    function index(){
    	$this->data->servicos = $this->crud->select_by_array('servicos',array('ativo'=>1));
    	foreach($this->data->servicos as &$servico){
    		$auxiliar = $this->crud->select_by_array('routes',array('id'=>$servico['id_route']));
    		if(count($auxiliar)>0){
    			$servico['link'] = base_url().'servicos/ver/'.$auxiliar[0]['slug'];
    		}
    	}        
        $this->load->view('servicos',$this->data);
    }

    function ver($slug=false){
    	$route = $this->crud->select_by_array('routes',array('slug'=>$slug));
    	if(count($route)>0){
	    	$auxiliar = explode('/', $route[0]['route']);
	    	$servico = $this->crud->select_by_array('servicos',array('id'=>$auxiliar[2]));
	    	if(count($servico)>0){
	    		if($servico[0]['modelo'] == 1){
	    			$this->load->view('servicos_ver_um',$this->data);
	    		}else if($servico[0]['modelo'] == 2){
	    			$this->load->view('servicos_ver_dois',$this->data);
	    		}else if($servico[0]['modelo'] == 3){
	    			$this->load->view('servicos_ver_tres',$this->data);
	    		}
	    	}
    	}
    }    
}

?>