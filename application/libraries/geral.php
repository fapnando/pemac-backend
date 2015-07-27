<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Geral {
    
    public function __construct(){
        $this->CI =& get_instance();
		if($this->CI->session->userdata('idioma') != ''){
		    $this->idioma = $this->CI->session->userdata('idioma');
		}
		else{
		    $this->idioma = 'portugues';
		}

        $this->CI->lang->load("site",$this->idioma);
	
    }
    
    function get_idioma(){
		return $this->idioma;
    }
    
    function widget($module, $return = false){
    	if($return){
			return modules::widget($module);
    	}
    	else{
    		echo modules::widget($module);
    	}
    }

    function montarLink($texto){
		if (!is_string ($texto))
		    return $texto;

		$er = "/(http:\/\/(www\.|.*?\/)?|www\.)([a-zA-Z0-9]+|_|-)+(\.(([0-9a-zA-Z]|-|_|\/|\?|=|&)+))+/i";
		preg_match_all ($er, $texto, $match);

		foreach ($match[0] as $link){
		    $haystack = $texto;
		    $needle   = $link;
		    $pos      = strripos($haystack, $needle);
		    
		    return $haystack;
		    


		    if ($pos === false){
		    
		    } 
		    else{
				$href = substr($texto,($pos-6),6);

				if($href == 'href="' ){
				  
				}
				else{
				    //coloca o 'http://' caso o link não o possua
				    $link_completo = (stristr($link, "http://") === false) ? "http://" . $link : $link;
				    $link_len = strlen ($link);
				    //troca "&" por "&", tornando o link válido pela W3C
				   $web_link = str_replace ("&", "&amp;", $link_completo);
				   $texto = str_ireplace ($link, "<a href=\"" . strtolower($web_link) . "\" target=\"_blank\">". (($link_len > 60) ? substr ($web_link, 0, 25). "...". substr ($web_link, -15) : $web_link) ."</a>", $texto);
				}
		    }
		}
		return $texto;
    }
    
    function getMenuAdmin(){
		$menu = Array();

		$modulos = $this->CI->crud->select_by_array('modulos', array('tipo' => 'normal'), false, false, 'titulo', 'ASC');
		
		foreach($modulos as $mod){
			$submodulos = $this->CI->crud->select_by_array('modulos', array('tipo' => 'submodulo',
																			'modulo_base' => $mod['modulo']), false, false, 'titulo', 'ASC');

			if($submodulos != NULL){
				$mod['submodulos'] = $submodulos;
			}
			else{
				$mod['submodulos'] = 'nenhum';	
			}
			array_push($menu, $mod);
		}
		return $menu;
    }

	function parseObjectToArray($d){
		if(is_array($d) && sizeof($d) > 1 && @get_class($d) != 'stdClass'){
			foreach($d as &$ob){
				if(is_array($ob) && sizeof($d) > 1 && @get_class($d) != 'stdClass'){
					$ob = parseObjectToArray($ob);
 				}
 				else{
 					$ob = get_object_vars($ob);
 				}
			}
		}
		else if(is_object($d) && get_class($d) =='stdClass'){
			$d = get_object_vars($d);
		}
		return $d;
	}
}

?>
