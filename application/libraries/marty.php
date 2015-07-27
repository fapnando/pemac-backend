<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marty{
    
    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->config->load('marty');
        $this->token    = $this->ci->config->item('token');
        $this->client   = $this->ci->config->item('client');
        $this->url      = $this->ci->config->item('url');
    }
    
    function get($module,$file){

        $url = $this->url.'/get';  
        $fields = array(
            'module' 	=> $module,
            'file' 	=> $file,
            'client' 	=> $this->client,
            'token' 	=> $this->token
        );
        
        $fields_string = '';
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true ); // don't give anything back 
        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
        
    }
    
}
    
