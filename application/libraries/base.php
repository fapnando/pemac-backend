<?php
class Base{
    
    public function __construct(){
        $this->CI =& get_instance();
		$this->perpage = 12;
    }

    
    function startModule($config,$ambiente){
        $this->data = array();

        foreach ($config->config as $conf => $k){
            if($k!=''){
                $this->data[$conf] = $k;
            }
        }
        
        $this->data['path_module'] = ci_site_url($ambiente.'/'. $this->data['module']);
		$this->data['atual'] = $this->CI->uri->uri_string();

        return (object)$this->data;
    }
    
    function index($page){
	
		$this->CI->access->check_login_admin();
		$this->CI->access->check_admin_level();

		$this->data['page']  = $page;
		
		$this->data['itens'] = $this->CI->crud->select_by_array($this->data['table'], false, false, $page, 'id','DESC');
 		$this->data['total'] = $this->CI->crud->count($this->data['table']);

		$this->data['pages'] = ceil($this->data['total']/$this->perpage);

		if(!empty($this->CI->config->config['filtro'])){
			if(sizeof($this->CI->config->config['filtro'])>0){
			    
			    foreach($this->CI->config->config['filtro'] as $filtro ){
			       
			       $this->data['filtros'][$filtro['id']] = 'test';
			       
			    }
			}
		}
		
		foreach($this->data['campos'] as $campos){	
		    if($campos['type'] == 'relate'){                
                $this->data['drop'][$campos['id']] = $this->CI->crud->menu_dropdown($campos['relate']['tabela'],$campos['relate']['campo'], $campos['fk'], $campos['required']);
		    }	    
		}
		
		if($this->data['index'] == 'modulo'){
		    return $this->CI->load->view('index', $this->data );
		}
		else{
		    return $this->CI->load->view(ADMIN_VIEW.'layouts/index', $this->data );
		}
    }
    
    function get_condicional(){
        $field  = $this->CI->input->post('field');
        $table  = $this->CI->input->post('table');
        $campo  = $this->CI->input->post('campo');
        $id     = $this->CI->input->post('id');
        $null   = $this->CI->input->post('null');
       
        if($id != ''){
            $conteudo = $this->CI->crud->select_by_array($table, array($field => $id), array('id', $campo));
        }
        else{
            $conteudo = $this->CI->crud->select_by_array($table, false, array($field));
        }
        
        
        $txt = '';
        
        if($null){
            $txt.= '<option value="">--</option>';
       	}
        
        foreach($conteudo as $item){
            $txt.= '<option value="'.$item['id'].'">'.$item[$campo].'</option>';
        }
        
        return $txt;
    }
    
    function add(){
    	$data = array();

    	$possuiCampoRota = false;
    	foreach($this->data['campos'] as $campo){
            switch($campo['type']){
            	case 'button':
            	case 'image':
            	case 'upload':
            	case 'galeria':
            	case 'repositorio':
            		break;

            	case 'senha':
            		$data['salt'] = substr( md5( microtime() ), 0, 10);
            		$data[$campo['id']] = $this->CI->crud->hash_password($this->CI->input->post($campo['id']), $data['salt']);
            		break;

            	case 'rota':
            		$route['slug'] = $this->CI->input->post($campo['id']);
            		$route['route'] = $campo['rota'];
            		$route['id'] = $this->CI->routes->save($route);
            		
            		$data[$campo['id']] = $route['id'];
            		$possuiCampoRota = true;
            		break;

            	case 'createtime':
            		$data['createtime'] = date('d/m/Y h:i');
            		break;

            	default:
            		if($campo['id'] != 'salt'){
            			$data[$campo['id']] = $this->CI->input->post($campo['id']);	
            		}
            		break;
            }
        }

        $id_registro = $this->CI->crud->save($this->data['table'], $data);

        if($possuiCampoRota){
        	$route['route'] = $route['route'].$id_registro;
        	$this->CI->routes->save($route);
        }

        echo 'true';
    }

    function listar($exportar=false){
    	$this->data['layout'] = $this->CI->input->post('layout');
		$fields 	= $this->CI->input->post('fields');
		$page 		= $this->CI->input->post('page');
		$perpage 	= $this->CI->input->post('perpage');
		$order 		= $this->CI->input->post('order');
		$order_side 	= $this->CI->input->post('order_side');

		if($fields != ''){
			/*[
			[ ID DO FILTRO ] => Array
			        (
			            [0] => VALOR
			            [1] => FIELD (CAMPO DE REFER NCIA)
			            [2] => TYPE (TIPO DE CAMPO DE FILTRO - date, select, like)
			            [3] => ID DO FILTRO
			)*/

			foreach($fields as $key => $array){
				if($array[0] == ''){
					unset($fields[$key]);
				}
				else{
					switch($array[2]){
						case 'like':
							$fields[$array[1].' LIKE'] = '%'.$array[0].'%';
							unset($fields[$key]);
							break;

						case 'select':
						case 'date':
							$fields[$array[1]] = $array[0];
							if($array[1] != $array[3]){
								unset($fields[$key]);
							}
							break;	
					}
				}
			}
		}

		if(!$page){
		    $page = 1;
		}
	
		$this->data['page']  = $page;
	
		if($perpage){
		   $this->perpage = $perpage;
		   $p = $page;
		   $page = array();
		   $page[0] = $p;
		   $page[1] = $perpage;
		   $this->data['page']  = $p;
		}
	
		$ordenar = 'id';
		$ordenar_side = 'ASC';
	
		if($order){
			$ordenar = $order;    
		}
	
		if($order_side){
		    $ordenar_side = $order_side;
		}
	
	
		if(!$exportar){
			if($fields){
			    $this->data['itens'] = $this->CI->crud->select_by_array($this->data['table'], $fields, false, $page, $ordenar, $ordenar_side);
			    $this->data['total'] = count($this->CI->crud->select_by_array($this->data['table'],$fields,false));
			}
			else{
			    $this->data['itens'] = $this->CI->crud->select_by_array($this->data['table'], false, false, $page, $ordenar, $ordenar_side);
				$this->data['total'] = $this->CI->crud->count($this->data['table']);
			}
		}
		else{
			if($fields){
			    $this->data['itens'] = $this->CI->crud->select_by_array($this->data['table'],$fields,false);
			    $this->data['total'] = count($this->CI->crud->select_by_array($this->data['table'],$fields,false));
			}
			else{
				$this->data['itens'] = $this->CI->crud->select_by_array($this->data['table']);
				$this->data['total'] = $this->CI->crud->count($this->data['table']);
			}
		}

		$this->data['pages'] = ceil($this->data['total']/$this->perpage);

		foreach($this->data['campos'] as $campos){
			if($campos['type'] == 'relate'){
                $this->data['drop'][$campos['id']] = $this->CI->crud->menu_dropdown($campos['relate']['tabela'],$campos['relate']['campo'], $campos['fk'], $campos['required']);
		    }	    
		}
	
		if(!$exportar){
			if(isset($this->data['lista'])){
               return $this->CI->load->view( MODULES.$this->data['module'].'/views/listagem',$this->data);
            }
            else{
               return $this->CI->load->view( ADMIN_VIEW.'layouts/listagem', $this->data); 
        	}
		}
		else{
			header('Content-Type: text/html; charset=utf-8');
			$header = array();
			foreach($this->data['campos'] as $campos){
				$header[ $campos['id'] ] = $campos['txt'];
			}
    
 	    	$file = 'relatorio_'.$this->data['module'].'_'.date('dmY').'';
    	    echo $this->CI->base->to_excel($header,$this->data['itens'],$file,true);
		} 
    }

    function to_excel($headers, $array, $filename = 'exportar', $download=false){
	
		$header = '';
		foreach($headers as $K => $v){		    
		    $value = utf8_decode($v);
		    $value = str_replace('"', '""', $value);
		    $value = '"' . $value . '"' . "\t";
		    $header .= $value;		    
		}                
	  
		$data = '';

		foreach ($array as $row){
		
		    $line = '';
		    
		    foreach($headers as $k=>$v){
			$line .= utf8_decode($row[$k])."\t";
		    }
		    
		    $data .= trim($line) . "\n";
		}	
		
		$data = str_replace("\r", "", $data);
		
		if(!$download){
		    
		    header('Content-Encoding: UTF-8');
		    header("Content-type: application/x-msdownload;  charset=utf-8");
		    header("Content-Disposition: attachment; filename=$filename.xls");
		    header("Pragma: no-cache");
		    header("Expires: 0");
		
		    echo "$header\n$data";
		
		}else{
			if(!file_exists('export')){
                mkdir('export', 0777, true);
        	}

		    file_put_contents('export/'.$filename.'.xls', "$header\n$data");
		    return 'export/'.$filename.'.xls';
		}
    }
    
    function update(){
        $pk = $_POST['pk'];
        $name = $_POST['name'];
		$values = $_POST['value'];
		$type = $_POST['type'];
		$value = '';

		switch($type){
			case 'senha':
				$data['salt'] = substr( md5( microtime() ), 0, 10);
				$values = $this->CI->crud->hash_password(md5($values), $data['salt'] );
				break;

			case 'rota':
				$value = trim(strtolower(str_replace(' ', '-', $values)), '-');
		
				$id_rota = $this->CI->crud->select_by_id($this->data['table'], $pk, array($name));

				$data['id'] = $id_rota[$name];
				$data['slug'] = $value;

				$this->CI->crud->update('routes', $data);

				echo 'true';
				break;

			case 'image':
				$files = $this->CI->crud->select_by_id($this->data['table'], $pk);
		    	$file = $files[$name];
				if($file != ''){
				    $filepath = 'uploads/'.$this->data['module'].'/'.$file;

				    if(file_exists($filepath)) {
						unlink($filepath);
				    }
				}
				break;

		}

		if(is_array($values)){
		    foreach($values as $val){
				$value .= $val.',';
		    }
		    $value = trim($value, ',');
		}
		else{
			$value = $values;
		}
	
        $data['id'] = $pk;
        $data[$name] = $value;
        
        if(in_array('updatetime', $this->CI->db->list_fields($this->data['table']))){
			$data['updatetime'] = date('d/m/Y h:i');
		}

        $item = $this->CI->crud->update($this->data['table'],$data);
        
        echo 'true';
	    
    }
  
    function delete(){
    	$id_registro = $this->CI->input->post('id');
        foreach($this->data['campos'] as $campo){
            switch($campo['type']){
            	case 'button':
            		if($campo['button_type'] == 'associar'){
            			$tabela_associativa = $campo['controller_param']['tabela_associativa'];
            			$campo_ass_pk = $campo['controller_param']['campo_ass_pk'];

            			$this->CI->crud->delete($tabela_associativa, array($campo_ass_pk => $id_registro));
            		}

            		break;

            	case 'upload':
            		$files = $this->CI->crud->select_by_array($this->data['table'], array('id' => $id_registro), array($campo['id']));

            		$files = explode(';', $files[0][$campo['id']]);
            		
            		foreach($files as $file){
            			$filepath = 'uploads/'.$this->data['module'].'/'.$file;
            			if(file_exists($filepath)) {
	                        @unlink($filepath);
	                    }
            		}
	            	

            		break;
            	case 'image':
            		$image = $this->CI->crud->select_by_array($this->data['table'], array('id' => $id_registro), array($campo['id']));
		
					if($image){
					    $image_path = 'uploads/'.$this->data['module'].'/'.$image[0][$campo['id']];
					    
					    if(file_exists($image_path)){
							@unlink($image_path);
					    }
					}
            		break;

            	case 'galeria':
            		$galeria = $this->CI->crud->select_by_array('galeria',array('module'=>$this->data['module'],'pk'=>$id_registro));
                
	                foreach($galeria as $g){
	                    $image_path = 'uploads/galeria/'.$g['file'];
	                    $thumbnail_path = 'uploads/galeria/thumbnail/'.$g['file'];
	                                
	                    if(file_exists($image_path)) {
	                        unlink($image_path);
	                    }

	                    if(file_exists($thumbnail_path)) {
	                        unlink($thumbnail_path);
	                    }
	                }
            		break;

            	case 'repositorio':
            		$repositorio = $this->CI->crud->select_by_array('repositorio', array('module' => $this->data['module'], 'pk' => $id_registro));

            		foreach($repositorio as $repo_file){
            			$filepath = 'uploads/'.$this->data['module'].'/'.$repo_file['new_name'];

            			if(file_exists($filepath)) {
	                        unlink($filepath);
	                    }
            		}
            		break;

            	case 'rota':
            		$id_rota = $this->CI->crud->select_by_id($this->data['table'], $id_registro, array($campo['id']));
            		$this->CI->crud->delete('routes', array('id' => $id_rota[$campo['id']]));
            		break;
            }
        }

        $item = $this->CI->crud->delete($this->data['table'], array('id' => $id_registro));
        echo 'true';
    }
    
    function upload(){    
		$image = $_FILES;
		$this->CI->upimage->upfile($image, $this->data['module']);
    }
	
    function pagination($data){
		$l = count( $data->itens);	
        if($l > 0){        
            if($data->page < $l){
                $data->next = $data->page+1;
            }
            else{
                $data->next = '';
            }
            
            if($data->page > 1 ){
                $data->prev = $data->page-1;
            }
            else{
                $data->prev = '';
            }
                
        }else{
            $data->next = '';
            $data->prev = '';
        }
        
        $data->page = ($data->page-1);
    }

    
    function ordenar(){
        $lista = $this->CI->input->post('lista');

        $e = explode(',',$lista);
        $e = array_filter($e);
        
        $i = 1;
        foreach($e as $id){
            $save['order']  = $i;
            $save['id']     = $id;
            
            $this->CI->crud->update($this->data['table'], $save);
            
            $i++;
        }   
    }
    
    function getMeses(){
		$meses = array();
		$meses['01'] = 'Janeiro';
		$meses['02'] = 'Fevereiro';
		$meses['03'] = 'MarÁço';
		$meses['04'] = 'Abril';
		$meses['05'] = 'Maio';
		$meses['06'] = 'Junho';
		$meses['07'] = 'Julho';
		$meses['08'] = 'Agosto';
		$meses['09'] = 'Setembro';
		$meses['10'] = 'Outubro';
		$meses['11'] = 'Novembro';
		$meses['12'] = 'Dezembro';
		
		return $meses;
    }
    
    function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
	    $lmin = 'abcdefghijklmnopqrstuvwxyz';
	    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $num = '1234567890';
	    $simb = '!@#$%*-';
	    $retorno = '';
	    $caracteres = '';
	    
	    $caracteres .= $lmin;
	    if ($maiusculas) $caracteres .= $lmai;
	    if ($numeros) $caracteres .= $num;
	    if ($simbolos) $caracteres .= $simb;
	    
	    $len = strlen($caracteres);
	    for ($n = 1; $n <= $tamanho; $n++){
		    $rand = mt_rand(1, $len);
		    $retorno .= $caracteres[$rand-1];
	    }
	    return $retorno;
    }

    function detalhamento($id, $somenteLeitura = false, $module_fk = false){
    	if(!$module_fk){
    		$module = @$this->data['module'];
    		$table = @$this->data['table'];
    		$campos = @$this->data['campos'];
    	}
    	else{
			$module = $module_fk->data->module; 
			$table = $module_fk->data->table;
			$campos = $module_fk->data->campos;
    	}
    	
    	$item = $this->CI->crud->select_by_array($table, array('id' => $id));
    	
    	$coluna_esquerda = '<div class="coluna left">';
		$coluna_direita = '<div class="coluna right">';
		$galeria = '';
    	$repositorio = '';
    	

    	foreach($item as $i){
    		foreach($this->data['campos'] as $c){
    			$data = array('id' => $c['id'], 'type' => $c['type'], 'txt' => $c['txt'], 'required' => @$c['required'], 'module' => $module, 'pk' => $i['id'], 'value' => @$i[$c['id']], 'somenteLeitura' => $somenteLeitura);
    			switch($c['type']){

    				
    				case 'text':
    					if(!$c['hidden']){
	    					$coluna_esquerda .= $this->CI->my_list->list_text($data);
	    				}
    					break;

    				
    				case 'textarea':
    					if(!$c['hidden']){
						    $coluna_direita .= $this->CI->my_list->list_textarea($data);
						}
						break;
					
					case 'rota':
						if(!$c['hidden']){
							$slug = $this->CI->crud->select_by_array('routes', array('id' => $data['value']));
							$data['value'] = $slug[0]['slug'];

							$coluna_esquerda .= $this->CI->my_list->list_rota($data);
						}
						break;
					
					case 'senha':
	    				if(!$c['hidden']){
							$coluna_esquerda .= $this->CI->my_list->list_senha($data);
						}
    					break;
    				
    				case 'tags':
    					if(!$c['hidden']){
							$coluna_direita .= $this->CI->my_list->list_tags($data);
						}
						break;

					
					case 'wys':
						if(!$c['hidden']){
							$coluna_direita .= $this->CI->my_list->list_wys($data);
						}
						break;

					
					case 'image':
	    				if(!$c['hidden']){
	    					$coluna_direita .= $this->CI->my_list->list_image($data, $c['n_images']);
	    				}
    					break;
					
					case 'galeria':
						if(!$c['hidden']){
							$galeria = $this->CI->my_list->list_galeria($data);
						}
						break;

					case 'repositorio':
						if(!$c['hidden']){
							$repositorio = $this->CI->my_list->list_repositorio($data);
						}
						break;
					
					case 'upload':
						if(!$c['hidden']){
							$coluna_direita .= $this->CI->my_list->list_upload($data, $c['n_files']);
						}
						break;
					
					case 'onoff':
						if(!$c['hidden']){
							$coluna_esquerda .= $this->CI->my_list->list_onoff($data);
						}
						break;
					
					case 'sexo':
						if(!$c['hidden']){
							$coluna_esquerda .= $this->CI->my_list->list_sexo($data);
						}
						break;
					
					case 'date':
						if(!$c['hidden']){
							$coluna_esquerda .= $this->CI->my_list->list_date($data);
						}
						break;

					
					case 'time':
						if(!$c['hidden']){
							$coluna_esquerda .= $this->CI->my_list->list_time($data);
						}
						break;

					case 'video':
						if(!$c['hidden']){
							$coluna_direita .= $this->CI->my_list->list_video($data, $c['origem']);
						}
						break;
					
					case 'select':
						if(!$c['hidden']){
							$coluna_esquerda .= $this->CI->my_list->list_select($data, $c['options'], $c['multiple']);
						}
						break;

					case 'relate':
						if(!$c['hidden']){
							$condicional = array('condicional' => $c['condicional'], 'table' => $c['relate']['tabela'], 'campo' => $c['relate']['campo']);
							$options = $this->CI->crud->menu_dropdown($c['relate']['tabela'], $c['relate']['campo'], $c['fk'], $c['required']);
							$multiple = $c['multiple'];

							$coluna_esquerda .= $this->CI->my_list->list_relate($data, $options, $condicional, $multiple);
						}
						break;

					case 'createtime':
					case 'updatetime':
						if(!$c['hidden'] && $data['value'] != ''){
							$coluna_esquerda .= $this->CI->my_list->list_infoTime($data);
						}
						break;

					case 'idioma':
						$data = array('id'=>$c['id'],'name'=>$c['id'],'pk'=>$i['id'],'module'=>$module);
						$coluna_esquerda .= $this->CI->my_list->list_relate($data, $idiomas, $i[$c['id']], $c['txt']);
						break;
    			}
    		}
    	}

		$coluna_esquerda .= '</div>';
		$coluna_direita .= '</div>';

		$modal = '<div class="right">
					<button type="button" id="botao_voltar" class="voltar right btn btn-success"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</button>
				  </div>

				  <ul class="tab nav nav-tabs" id="tab" >
					<li class="active" style="width: auto;">
						<a href="#dados_tab" data-toggle="tab">Dados</a>
					</li>';

		if($galeria != ''){
			$modal .= '<li id="galeria" style="width: auto;">
							<a href="#galeria_tab" data-toggle="tab">Galeria</a>
						</li>';
		}

		if($repositorio != ''){
			$modal .= '<li id="repositorio" style="width: auto;">
							<a href="#repositorio_tab" data-toggle="tab">Repositorio</a>
						</li>';
		}

		$modal .= ' </ul>
				  	<div class="tab-content">
						<div class="tab-pane active" id="dados_tab">
							'.$coluna_esquerda.' '.$coluna_direita.'	
						</div>';
		if($galeria != ''){
			$modal .= '<div class="tab-pane" id="galeria_tab">
					  		'.$galeria.'
						</div>';
		}
		
		if($repositorio != ''){
			$modal .= '<div class="tab-pane" id="repositorio_tab">	
							'.$repositorio.'
						</div>';
		}
		
		$modal .= '</div>
			  	   <div class="clear"></div>';

    	return $modal;
    }
}