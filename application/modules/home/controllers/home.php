<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();   
		$this->data = array();
		$this->data = (object) $this->data;
	}

	public function index(){
		
		$this->load->view('home', $this->data);
		
	}
	
}