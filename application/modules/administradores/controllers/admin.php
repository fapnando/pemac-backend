<?php	

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->config('config');	
		$this->data = $this->base->startModule($this->config,'admin');
		
	}

	function index($page=1) {
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

	function ordenar(){
		$this->base->ordenar();
	}
	
	function logout() {
		$this->session->unset_userdata( 'admin_logged' );
		$this->session->unset_userdata( 'admin_level'  );
		redirect('/admin/login');		
	}
	
	function get_salt(){
		
		$email 	= $this->input->post('email');
		$senha 	= $this->input->post('senha');
		
		$user 	= $this->crud->check_password($this->data->table,$email, $senha);

		if($user != FALSE){
			$this->session->set_userdata( 'admin_logged', 	TRUE );
			$this->session->set_userdata( 'admin_acesso', 	$user['acesso'] );
			echo 'true';
		}else{
			echo 'false';
		}
	}
	
	function login(){
		$this->load->view('login', $this->data);
	}
	
	function detalhamento(){
        echo $this->base->detalhamento($_POST['id']);
    }  

    function condicional(){     
        echo $this->base->get_condicional();
    }
        
}

?>