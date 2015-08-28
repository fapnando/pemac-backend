<?php	

class noticias extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->load->config('config');	
        $this->data = $this->base->startModule($this->config,'admin');     
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
    
    function index(){
    	$this->data->noticias = $this->crud->select_by_array('noticias',array('ativo'=>1),false,array(1,6),'id','desc');
        foreach($this->data->noticias as &$noticia){
            $noticia['data'] = $this->trataData($noticia['data']);
            $noticia['titulo_categoria'] = $this->getCategory($noticia['categoria']);
            $auxiliar = $this->crud->select_by_array('routes',array('id'=>$noticia['id_route']));
            if(count($auxiliar)>0){
                $noticia['link'] = base_url().'noticias/'.$auxiliar[0]['slug'];
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
                $this->data->noticia = $noticia[0];
                //pegar 3 noticias
                $this->data->outrasNoticias = $this->crud->select_by_array('noticias',array('ativo'=>1,'id <>'=>$noticia[0]['id']),false,array(1,3),'id','DESC');
                foreach($this->data->outrasNoticias as &$not){
                    $not['data'] = $this->trataData($not['data']);
                    $not['titulo_categoria'] = $this->getCategory($not['categoria']);
                    $auxiliar = $this->crud->select_by_array('routes',array('id'=>$not['id_route']));
                    if(count($auxiliar)>0){
                        $not['link'] = base_url().'noticias/'.$auxiliar[0]['slug'];
                    }
                }
                $this->load->view('noticias_ver',$this->data);
	    	}
    	}
    }    
}

?>