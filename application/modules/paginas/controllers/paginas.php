<?php	

class Paginas extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->config('config');	
        $this->data = $this->base->startModule($this->config,'admin');
            
    }
    
    function index($slug=false){
        if(is_numeric($slug)){
            $this->data->conteudo = $this->crud->select_by_array($this->data->table, array('id'=>$slug));
        }
        else{
            $route = $this->crud->select_by_array('routes', array('like' => array('slug' => 'paginas/'.$slug)), array('route'));
            
            $route = array_pop(explode('/', $route[0]['route']));

            $this->data->conteudo = $this->crud->select_by_array($this->data->table, array('id'=>$route));

        }
        $this->load->view($this->data->module, $this->data);
    }   
}

?>