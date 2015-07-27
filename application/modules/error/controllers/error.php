<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends MX_Controller {
	
	function __construct() {}
	
	public function index() {		
		$this->load->view('error');	
	}
	
}