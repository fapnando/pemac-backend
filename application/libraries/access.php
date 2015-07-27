<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access {

	function check_login_admin() {
		$CI =& get_instance();
		if( !$CI->session->userdata( 'admin_logged' ) ) {
			redirect('admin/login');
		}
	}
	
	function check_login() {
		$CI =& get_instance();
		if( !$CI->session->userdata( 'user_logged' ) ) {
			redirect('');
		}
	}
	
	function check_login_status() {
		$CI =& get_instance();
		if( !$CI->session->userdata( 'user_logged' ) ) {
			return true;
		}else{
			return false;
		}
	}
	
	function get_user_id(){
		$CI =& get_instance();
		return $CI->session->userdata( 'user_id' );
	}

	function check_admin_level() {
		
		$CI =& get_instance();

		if( $CI->session->userdata( 'admin_level' ) == 'USER' ) {
			die( 'Você não tem permissão de acesso para esta página' );
		
		}

	}
	
	function check_super_admin_level() {
		
		$CI =& get_instance();

		if( $CI->session->userdata( 'admin_level' ) != 'SUPER_ADMIN' ) {
		
			die( 'Você não tem permissão de acesso para esta página' );
		
		}

	}


}

?>