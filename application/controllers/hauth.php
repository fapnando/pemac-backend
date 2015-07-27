<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HAuth extends CI_Controller {

	public function index()
	{
		$this->load->view('hauth/home');
	}
	
	public function desconectar($provider){
	
		if(!$this->session->userdata( 'user_logged')){
			echo 'Usuário não logado';	
		}else{
			$user_id = $this->session->userdata( 'user_id');
			$param = array('user_id' => $user_id, 'provider' => $provider);			
			$aut = $this->crud->select_by_array('authentications',$param);
			
			$this->crud->delete('authentications', array('id' => $aut[0]['id']));
		}
		
		redirect(ci_site_url('perfil'));
		
	}
	
	public function conectar($provider){
	
		
		
		if(!$this->session->userdata( 'user_logged')){
			echo 'Usuário não logado';	
		}else{
			$user_id = $this->session->userdata( 'user_id');
			$param = array('user_id' => $user_id, 'provider' => $provider);
			
			$aut = $this->crud->select_by_array('authentications',$param);
			
			if(sizeof($aut)>0){
				echo "Conta já conectada";
			}else{
				
				$this->load->library('HybridAuthLib');
				
				if($this->hybridauthlib->providerEnabled($provider)){
					
					$service = $this->hybridauthlib->authenticate($provider);
					
					if($service->isUserConnected()){
					
						$user_profile = $service->getUserProfile();

						$save['user_id'] 	= $user_id;
						$save['provider'] 	= $provider;
						$save['provider_uid']	= $user_profile->identifier;
						$save['image']		= $user_profile->photoURL;						
						$save['email']		= $user_profile->email;
						$save['display_name']	= $user_profile->displayName;
						$save['first_name']	= $user_profile->firstName;
						$save['last_name']	= $user_profile->lastName;
						$save['profile_url']	= $user_profile->profileURL;
						
						$save['created_at']	= date('Y-m-d H:i:s');
						
						$id = $this->crud->save('authentications',$save);
					}
				}
			}
		}
		
		redirect(ci_site_url('perfil'));
		
	}

	public function login($provider, $url=false)
	{
		
		if($url){
			
			$url = str_replace('_-_','/', $url);
			
		}
		
		log_message('debug', "controllers.HAuth.login($provider) called");

		try
		{
			log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
			$this->load->library('HybridAuthLib');

			if ($this->hybridauthlib->providerEnabled($provider))
			{
				
				log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
				$service = $this->hybridauthlib->authenticate($provider);

				if ($service->isUserConnected())
				{
					log_message('debug', 'controller.HAuth.login: user authenticated.');

					$user_profile = $service->getUserProfile();
					
					log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));

					$data['user_profile'] = $user_profile;
					
					$email = $data['user_profile']->emailVerified;

					$aut = $this->crud->select_by_array('authentications', array('email' => $email));
						
					if(sizeof($aut)>0){
					
						if(!$this->session->userdata( 'user_logged')){							
							$this->session->set_userdata( 'user_logged', 	TRUE );
							$this->session->set_userdata( 'user_id', 	$aut[0]['user_id'] );
							$this->session->set_userdata( 'user_acesso', 	"" );
						}
						
						if($url){
							redirect($url);
						}else{
							redirect(ci_site_url('/perfil'));
						}
						
					}else{
						$cadastro = $this->crud->select_by_array('usuario', array('email' => $email));
					
						if(sizeof($cadastro)>0){
						
							$save['user_id'] 	= $cadastro[0]['id'];
							$save['provider'] 	= $provider;
							$save['provider_uid']	= $data['user_profile']->identifier;
							$save['image']		= $data['user_profile']->photoURL;
							$save['email']		= $email;
							$save['display_name']	= $data['user_profile']->displayName;
							$save['first_name']	= $data['user_profile']->firstName;
							$save['last_name']	= $data['user_profile']->lastName;
							$save['profile_url']	= $data['user_profile']->profileURL;
							//$save['website_url']	= $data['user_profile']->webSiteURL;
							$save['created_at']	= date('Y-m-d H:i:s');
							
							$id = $this->crud->save('authentications',$save);
							
							if(!$this->session->userdata( 'user_logged')){							
								$this->session->set_userdata( 'user_logged', 	TRUE );
								$this->session->set_userdata( 'user_id', 	$cadastro[0]['id'] );
								$this->session->set_userdata( 'user_acesso', 	"" );
							}
							
							if($url){
								redirect($url);
							}else{
								redirect(ci_site_url('/perfil'));
							}
						}else{
							$user['images'] 		= $data['user_profile']->photoURL;
							$user['nome'] 			= $data['user_profile']->firstName;
							$user['sobrenome'] 		= $data['user_profile']->lastName;
							$user['data_nascimento'] 	= str_pad($data['user_profile']->birthDay, 2, "0", STR_PAD_LEFT).'/'.str_pad($data['user_profile']->birthMonth, 2, "0", STR_PAD_LEFT).'/'.$data['user_profile']->birthYear;
							$user['email'] 			= $email;
							
							$senha = $this->base->geraSenha();
							
							$user['senha'] 			= $senha;
							$user['data_inscricao'] 	= date('Y-m-d H:i:s');
							$user['cidade'] 		= $data['user_profile']->city;
							$user['estado'] 		= $data['user_profile']->region;
							$user['pais'] 			= $data['user_profile']->country;
							$user['acesso'] 		= "";
							$user['sexo'] 			= $data['user_prodile']->gender;
							$user['token'] 			= "";
							$user['ativo'] 			= "1";
							
							$user['origem'] 		= "PRODUZINDOFUTUROS,".$provider;
							
							$user_id = $this->crud->save('usuario',$user);
							
							/*########################| Envia email |##############*/
							
							$this->load->library('email');
								
							$config['mailtype'] = 'html';
							
							$this->email->initialize($config);
							
							$this->email->from('contato@produzindofuturos.com', 'Produzindo Futuros');
							$this->email->to($email);
							
							$this->email->subject('Produzindo Futuros | Cadastro');
							
							$msg  = "Olá ".$data['nome'].',<br/></br>';
							$msg .= "Seu cadastro na plataforma Produzindo Futuros foi realizado com sucesso.<br/>";
							$msg .= "Veja abaixo seus dados de login";
							$msg .= "<br/>--------------------------<br/><br/>";
							$msg .= 'Email: '.$email.'<br/>';
							$msg .= 'Senha: '.$senha.'';
							$msg .= "<br/>--------------------------<br/><br/>";
							
							$msg .= "";
							
							$msg .= "<br/><br/>";
							$msg .= "Atenciosamente,<br/>";
							$msg .= "Equipe Produzindo Futuros";
							
							$this->email->message($msg);		
							
							if ( ! $this->email->send()){
								
							}else{
								
							}
							
							/*######################################################*/
							
							$save['user_id'] 		= $user_id;
							$save['provider'] 		= $provider;
							$save['provider_uid']		= $data['user_profile']->identifier;
							$save['image']			= $data['user_profile']->photoURL;
							$save['email']			= $email;
							$save['display_name']		= $data['user_profile']->displayName;
							$save['first_name']		= $data['user_profile']->firstName;
							$save['last_name']		= $data['user_profile']->lastName;
							$save['profile_url']		= $data['user_profile']->profileURL;
							//$save['website_url']		= $data['user_profile']->webSiteURL;
							$save['created_at']		= date('Y-m-d H:i:s');
							
							$id = $this->crud->save('authentications',$save);
							
							if(!$this->session->userdata( 'user_logged')){							
								$this->session->set_userdata( 'user_logged', 	TRUE );
								$this->session->set_userdata( 'user_id', 	$user_id );
								$this->session->set_userdata( 'user_acesso', 	"" );
							}
							
							if($url){
								redirect($url);
							}else{
								redirect(ci_site_url('/perfil/novo'));
							}
						}
					}
					
					
				}
				else // Cannot authenticate user
				{
					show_error('Cannot authenticate user');
				}
			}
			else // This service is not enabled.
			{
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         //redirect();
				         if (isset($service))
				         {
				         	log_message('debug', 'controllers.HAuth.login: logging out from service.');
				         	$service->logout();
				         }
				         show_error('User has cancelled the authentication or the provider refused the connection.');
				         break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				         break;
				case 7 : $error = 'User not connected to the provider.';
				         break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}

	public function endpoint()
	{

		log_message('debug', 'controllers.HAuth.endpoint called.');
		log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
			$_GET = $_REQUEST;
		}

		log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
		require_once APPPATH.'/third_party/hybridauth/index.php';

	}
	
	function logout(){
		
		$this->load->library('HybridAuthLib');
		
		$this->hybridauthlib->logoutAllProviders();
		
		redirect('/hauth');
		
	}
	
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */