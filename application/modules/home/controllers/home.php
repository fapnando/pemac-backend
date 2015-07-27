<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();   
		$this->data = array();
		$this->data = (object) $this->data;
	}

	public function index(){
		$this->data->sliders = $this->crud->select_by_array('slider',array('ativo'=>1));

		$this->data->servicos = $this->crud->select_by_array('servicos',array('ativo'=>1),false,array(1,6),'id','desc');
    	foreach($this->data->servicos as &$servico){
    		$auxiliar = $this->crud->select_by_array('routes',array('id'=>$servico['id_route']));
    		if(count($auxiliar)>0){
    			$servico['link'] = base_url().'servicos/ver/'.$auxiliar[0]['slug'];
    		}
    	}

    	$this->data->noticias = $this->crud->select_by_array('noticias',array('ativo'=>1),false,array(1,6),'id','desc');
    	foreach($this->data->noticias as &$noticia){
    		$auxiliar = $this->crud->select_by_array('routes',array('id'=>$noticia['id_route']));
    		if(count($auxiliar)>0){
    			$noticia['link'] = base_url().'noticias/ver/'.$auxiliar[0]['slug'];
    		}
    	} 

    	$this->data->depoimentos = $this->crud->select_by_array('depoimentos',array('ativo'=>1));
    	$this->data->clientes = $this->crud->select_by_array('clientes',array('ativo'=>1));
    	

    	$this->data->cases = $this->crud->select_by_array('cases',array('ativo'=>1),false,array(1,4),'id','desc');
    	foreach($this->data->cases as &$case){
    		$auxiliar = $this->crud->select_by_array('routes',array('id'=>$case['id_route']));
    		if(count($auxiliar)>0){
    			$case['link'] = base_url().'cases/ver/'.$auxiliar[0]['slug'];
    		}
    	}      
		$this->load->view('home', $this->data);
	}
	
}