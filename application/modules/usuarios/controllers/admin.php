<?php	

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->config('config');	
        $this->data = $this->base->startModule($this->config,'admin');
        
    }

    function index($page=1){
        $this->base->index($page);
    }
    
    function add(){
        echo $this->base->add();
    }
    
    function listar($exportar=false){
        $this->base->listar($exportar);
    }
    
    function update(){
        echo $this->base->update();
    }
    
    function delete(){		
        echo $this->base->delete();
    }
    
    function upload(){		
        echo $this->base->upload();
    }

    function ordenar(){      
        $this->base->ordenar();
    }   
    
    function detalhamento(){
        echo $this->base->detalhamento($_POST['id']);
    }  

    function condicional(){     
        echo $this->base->get_condicional();
    }
}

?>