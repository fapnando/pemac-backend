<?php	

class contato extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->load->config('config');	
        $this->data = $this->base->startModule($this->config,'admin');     
    }
    
    function index(){        
        $this->load->view($this->data->module,$this->data);
    }

    function cadastrar_banco($nome,$email,$fone,$mensagem,$assunto,$empresa){
    	$this->crud->save('contato',array(
    		'nome'=>$nome,
    		'email'=>$email,
    		'telefone'=>$fone,
    		'mensagem'=>$mensagem,
    		'assunto'=>$assunto,
    		'empresa'=>$empresa
    	));
    }

    function enviar(){
		$this->load->library('email');
        $config['mailtype'] = 'html';
        
        $this->email->initialize($config);

        $nome		= $this->input->post('nome');
        $email     = $this->input->post('email');
        $fone   	= $this->input->post('telefone');
        $mensagem	= $this->input->post('mensagem');
        $assunto = $this->input->post('assunto');
        $empresa = $this->input->post('empresa');
        
        $this->email->from('fapnando@gmail.com');
        $this->email->to('fapnando@gmail.com');
        
        $this->email->Subject('CONTATO NOVO SITE');
        
        $msg  = "---------------------<br/>";
        $msg .= "CONTATO NOVO SITE<br/>";
        $msg .= "---------------------<br/>";
        $msg .= "<br/>";
        $msg .= "Nome: ".$nome."<br/>";
        $msg .= "Email: ".$email."<br/>";
        $msg .= "Telefone: ".$fone."<br/>";
        $msg .= "Empresa: ".$empresa."<br/>";
        $msg .= "Assunto: ".$assunto."<br/>";
        $msg .= "Mensagem:<br>".$mensagem."<br/>";
        $msg .= "<br/>";
        $msg .= "Contato rebebido em ".date('l jS \of F Y h:i:s A')."<br/>";

        $this->email->message($msg);

        $this->cadastrar_banco($nome,$email,$fone,$mensagem,$assunto,$empresa);
        if (!$this->email->send()){
            echo "false";
        }else{
            echo 'true';
        }
    	
    }    
}

?>