<?php	

class noticias extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->load->config('config');	
        $this->data = $this->base->startModule($this->config,'admin');     
    }
    
    function index(){
    	$this->data->noticias = $this->crud->select_by_array('noticias',array('ativo'=>1));
    	foreach($this->data->noticias as &$noticia){
    		$auxiliar = $this->crud->select_by_array('routes',array('id'=>$noticia['id_route']));
    		if(count($auxiliar)>0){
    			$noticia['link'] = base_url().'noticias/ver/'.$auxiliar[0]['slug'];
    		}
    	}        
        $this->load->view('noticias',$this->data);
    }

    function ver($slug=false){
    	$route = $this->crud->select_by_array('routes',array('slug'=>$slug));
    	if(count($route)>0){
	    	$auxiliar = explode('/', $route[0]['route']);
	    	$noticia = $this->crud->select_by_array('noticias',array('id'=>$auxiliar[2]));
	    	if(count($noticia)>0){
	    		$this->load->view('noticias_ver',$this->data);
	    	}
    	}
    }    
}

?>