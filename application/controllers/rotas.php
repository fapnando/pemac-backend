<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rotas extends CI_Controller {


	public function check_slug()
	{
		$slug = $_POST['slug'];
		$verificar = $this->routes->validate_slug($slug);
		
		echo $verificar;

	}
	
}
