<?php	

class usuarios extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->load->config('config');	
        $this->data = $this->base->startModule($this->config,'admin');
        
    }
    
    function index(){

		if($this->session->userdata('user_id')){
			$this->load->view('perfil', $this->data);
		}else{
			redirect('/');
		}
		
	}       
	function logout(){

		$this->session->unset_userdata( 'user_logged' );
		$this->session->unset_userdata( 'user_acesso' );
		$this->session->unset_userdata( 'user_id'     );
		$this->session->unset_userdata( 'user_email'  );
		$this->session->unset_userdata( 'user_nome'   );
		redirect('/');
	}
	
	function get_salt(){	

		$email 	= $this->input->post('login');
		$senha 	= $this->input->post('senha');

		$user 	= $this->crud->check_password($this->data->table, $email, $senha);
		
		if($user != FALSE){

				$this->session->set_userdata( 'user_logged', 	TRUE );
            	$this->session->set_userdata( 'user_id', 		$user['id'] );
            	$this->session->set_userdata( 'user_nome', 		$user['nome'] );
            	$this->session->set_userdata( 'user_email', 	$user['email'] );
            	$this->session->set_userdata( 'user_acesso', 	'USER' );

            	$update['id'] 			= $user['id'];
            	$update['ultimologin']	= date('Y-m-d H:i:s');

            	$this->crud->update('usuarios',$update);

            	echo 'true';

		}else{
			echo 'false';
		}
		
	}

    function esqueci_senha(){
    	if($this->session->userdata('user_id')){
			redirect(ci_site_url());
		}else{
			$this->load->view('esqueci');	
		}
    }	
	
    function reset_senha(){
    	$login = $this->input->post('login');

    	$this->user = $this->crud->select_by_array('usuarios',array('email'=>$login));

    	if(sizeof($this->user)>0){

    		if($this->user[0]['email'] != ''){

				$email = $this->user[0]['email'];

				$token = md5(time());

				$update['token'] 	= $token;
				$update['id'] 		= $this->user[0]['id'];

				$this->crud->update('usuarios',$update);


				$this->load->library('email');
		        $config['mailtype'] = 'html';

		        
		        $this->email->initialize($config);
				        
		        $this->email->from();
		        $this->email->to( $email );
		        
		        $this->email->subject(' | Recadastre sua senha');
		        
				$msg = '<!doctype html>
								<html lang="pt-br">
								<head>
								  <meta charset="UTF-8">
									<title></title>
									<style>
										p{
											font-size: 15px;
											font-family: "Verdana";
										}
									</style>
								</head>
								<body>
									<table width="580" cellpadding="0" cellspacing="0" >
										<tr height="83">
											<td width="132"></td>
											<td width="132"></td>
											<td colspan="2"></td>
										</tr>
										<tr height="210">
											<td  height="210" colspan="4">
												
											</td>
										</tr>
										<tr height="210">
											<td colspan="4">
												<center>
													<p>
													<strong>Olá, '.$this->user[0]['nome'].', </strong><br /><br />
								Você solicitou a redefinição da sua senha.
								Para concluir o processo, clique no link abaixo.<br /><br />
								<a style="color: #b40036; font-weight: bold;" href="'.ci_site_url('trocasenha').'/'.$token.'">'.ci_site_url('trocasenha').'/'.$token.'</a><br/>
												</p>
												
												<p>
													Atenciosamente,</br>
													<strong>Equipe</strong>
												</p>
												</center>
											</td>
										</tr>
										<tr height="20" bgcolor="#005090" >
											<td colspan="4">
												
											</td>
										</tr>
										<tr height="43" bgcolor="#005090" >
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr height="118">
											<td colspan="4">
												
											</td>
										</tr>
										
										<tr height="133">
											<td colspan="4">
												<center>
													<p style="text-align: justify; font-size: 8px;"></p
												</center>
											</td>
										</tr>
									</table>
								</body>
								</html>';
		        
		
		        $this->email->message($msg);
			
		        if ( ! $this->email->send()){
		            echo "Ocorreu um erro no envio<br/>de sua mensagem. Tente novamente.";
		        }else{
		            echo "Foi enviado para seu email um link para você realizar a troca de sua senha.";
		        }
				


    		}else{
    			echo 'false';
    		}

    		
    	}else{
    		echo 'false';
    	}

    }

	

    function trocasenha($token){

    	if($token){

    		$this->user = $this->crud->select_by_array('usuarios', array('token'=>$token));
    		
    		if(sizeof($this->user)>0){

    			$this->data->token = $token;
    			$this->load->view('trocasenha', $this->data);

    		}else{
    			redirect('/');
    		}

    		

    	}else{
    		redirect('/');
    	}
    }

    function novasenha(){

    	$senha 	= $this->input->post('senha');
    	$token 	= $this->input->post('token');

    	if($token){

    		$this->user = $this->crud->select_by_array('usuarios', array('token'=>$token));
    	
    		$update['token'] 	= '';
    		$update['senha'] 	= $senha;
    		$update['id']		= $this->user[0]['id'];   		

    		$this->crud->update('usuarios', $update);

    		echo 'Senha alterada';

    	}else{
    		echo 'false';
    	}
    }
     
}

?>