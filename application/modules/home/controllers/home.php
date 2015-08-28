<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();   
		$this->data = array();
		$this->data = (object) $this->data;
	}

    function trataData($data){
        $auxiliar = explode('-', $data);
        return $auxiliar[2].'/'.$auxiliar[1].'/'.$auxiliar[0];
    }

    function getCategory($id){
        $auxiliar = $this->crud->select_by_array('categorias',array('id'=>$id));
        if(count($auxiliar)>0){
            return $auxiliar[0]['titulo'];
        }else{
            return 'Sem categoria';
        }
    }

	public function index(){
		$this->data->sliders = $this->crud->select_by_array('slider',array('ativo'=>1));

		$this->data->servicos = $this->crud->select_by_array('servicos',array('ativo'=>1,'destacar'=>'SIM'),false,array(1,6),'id','desc');
    	foreach($this->data->servicos as &$servico){
    		$auxiliar = $this->crud->select_by_array('routes',array('id'=>$servico['id_route']));
    		if(count($auxiliar)>0){
    			$servico['link'] = base_url().'servicos/'.$auxiliar[0]['slug'];
    		}
    	}

    	$this->data->noticias = $this->crud->select_by_array('noticias',array('ativo'=>1),false,array(1,6),'id','desc');
    	foreach($this->data->noticias as &$noticia){
            $noticia['data'] = $this->trataData($noticia['data']);
            $noticia['titulo_categoria'] = $this->getCategory($noticia['categoria']);
    		$auxiliar = $this->crud->select_by_array('routes',array('id'=>$noticia['id_route']));
    		if(count($auxiliar)>0){
    			$noticia['link'] = base_url().'noticias/'.$auxiliar[0]['slug'];
    		}
    	} 

    	$this->data->depoimentos = $this->crud->select_by_array('depoimentos',array('ativo'=>1));
    	$this->data->clientes = $this->crud->select_by_array('clientes',array('ativo'=>1));
    	

    	$this->data->cases = $this->crud->select_by_array('cases',array('ativo'=>1),false,array(1,4),'id','desc');
    	foreach($this->data->cases as &$case){
    		$auxiliar = $this->crud->select_by_array('routes',array('id'=>$case['id_route']));
    		if(count($auxiliar)>0){
    			$case['link'] = base_url().'cases/'.$auxiliar[0]['slug'];
    		}
    	}      
		$this->load->view('home', $this->data);
	}

    function institucional(){
        $this->load->view('institucional', $this->data);
    }
	
}