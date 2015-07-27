<?php

class Crud extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}

//============================================================================================================
	
	/****** reconect ********* 
		Fecha a conexão atual com o banco de dados e inicializa uma nova
	*/	
	function reconnect(){
		$this->db->close();
		$this->db->initialize();
	}
	
//============================================================================================================
	
	/****** query ********* 
		Executa uma instrução SQL criada manualmente pelo usuário podendo ter ou não retorno

		String 	$query 		= 	string contendo a instrução SQL
		Boolean 	$return 	= 	se TRUE, retorna um array contendo os resultados da consulta
		
	*/	
	function query($query,$return = false){
		$result = $this->db->query($query);
		if($return){
			return $result->result_array();
		}
	}

//============================================================================================================
	
	/****** count ********* 
		retorna o total de registros retornado na instrução SQL

		String 	$table 		= 	nome da tabela à ser verificada
		Array 	$where 		= 	array contendo as condições where da instrução
	*/	
	function count($table, $where = false){
		if($where){
			foreach($where as $fields => $values){
				$this->db->where($fields, $values);
			}
		}
		return $this->db->count_all_results($table);
	}

//============================================================================================================
	
	/****** sum ********* 
		retorna a soma de valores de um determinado campo em um determinada tabela de acordo
		com a clausula where informada

		String 	$table 		= 	nome da tabela à ser verificada
		String 	$field 		= 	nome do campo a ser feito a soma
		Array 	$where 		= 	array contendo as condições where da instrução
	*/	
	function sum($table, $field, $where = false){
		if($where){
			foreach($where as $fields => $values){
				$this->db->where($fields, $values);
			}
		}
		
		$this->db->select_sum($field);
		$result = $this->db->get($table)->row_array();
		return $result[$field];
	}


//============================================================================================================
	
	/****** count_pagination ********* 
		Retorna a quantidade de páginas necessária para organizar os dados retornados da instrução SQL,
		de acordo com a quantidade por página especificado

		String 	$table 		= 	nome da tabela à ser verificada
		Array 	$where 		= 	array contendo as condições where da instrução
		Int 	$perpage 	= 	Número correspondente a quantidade por página desejada	
	*/	
	function count_pagination($table, $where = false, $perpage){
		if($where){
			foreach($where as $fields => $values){
				$this->db->where($fields, $values);
			}
		}
		
		$total = $this->db->count_all_results($table);
		return intval($total / $perpage) + 1;
	}
//============================================================================================================

	/*function do_hash_password( $pass, $salt ) {
		return md5( $salt . md5($pass) . $salt );
	}*/
	
	function hash_password( $pass, $salt ) {
		return md5( $salt . $pass . $salt );
	}
	
	function check_password($table, $email, $password){
		$user = $this->select_by_array($table, array('email' => $email));

		if($user[0]['ativo'] != '0'){
			
			if( $this->hash_password( $password, $user[0]['salt'] ) == $user[0]['senha'] ) {
				
				$data['id'] 		= $user[0]['id'];
				$data['nome'] 		= $user[0]['nome'];
				$data['acesso'] 	= $user[0]['acesso'];
				$data['email'] 		= $user[0]['email'];
				    
				return $data;
			    
			} else {
			    return false;
			}
			
		}
		else{
			return false;
		}
	}
	
	
/*###################################*/
/*###########| SELECT'S |############*/
/*###################################*/
	
//============================================================================================================
	
	/****** select_by_id ********* 
		Usado para retornar apenas um registro atravé do id do mesmo

		String 	$table 		= 	nome da tabela onde será buscado o registro;
		String 	$id 		= 	id que será buscado no banco;
		Array 	$fields 	= 	Campos a serem retornados no resultado;
	*/
	function select_by_id($table, $id, $fields = false){
		if($fields){
			$this->db->select($fields);
		}

		return $this->db->get_where($table, array('id' => $id))->row_array();
	}

//============================================================================================================
	
	/****** select_by_join ********* 
		Usado para fazer relacionamento entre 2 ou mais tabelas

		Array 	$table_fields =  Array com todas as informações para realizar o select
								seguindo o modelo abaixo

 			array(
				array(
					'table' => 'nome_da_tabela1',
					'fields' => array('campo1', 'campo2', 'campo3', '...'), 
					'join_table' => 'nome_da_tabela2',
					'join_fields' => array('campo da tabela 1', 'campo da tabela 2'),
					'join_type' => 'INNER',
					'where' => array('campo' => 'valor para o campo')
				),
				array(
					'table' => 'nome_da_tabela2',
					'fields' => array('campo1', 'campo2', 'campo3', '...'), 
					'join_table' => 'nome_da_tabela3',
					'join_fields' => array('campo da tabela 2', 'campo da tabela 3'),
					'join_type' => 'INNER',
					'where' => array('campo' => 'valor para o campo')
				),
				array(
					'table' => 'nome_da_tabela3',
					'fields' => array('campo1', 'campo2', 'campo3', '...'), 
					'where' => array('campo' => 'valor para o campo')
				)
			);

			OBSERVAÇÕES:
		
			tipos de join em 'join_type': left, right, outer, inner, left outer, and right outer.

			Se houver campos com o mesmo nome, deve ser utilizado um apelido através de AS
				'fields' => array('campo1 as apelido_campo1', '...'), 


		Array 		$page 	  		= monta paginação para os dados;

			array(índice, quantidade por índice)
	*/
	function select_by_join($table_fields, $page = false){
		if($page){
			$perpage 	= 12;
			
			if(is_array($page)){
				$p 		= $page[0];
				$perpage 	= $page[1];
				$page 		= $p;
			}
			
			$p2		= ($page-1);
			$l1 	= ($p2*$perpage);
			$l2 	= $perpage;

			$this->db->limit( $l2, $l1 );
		}

		$this->db->from($table_fields[0]['table']);
		foreach($table_fields as $tables){
			foreach($tables['fields'] as &$field){
				$this->db->select($tables['table'].'.'.$field);
			}

			if(isset($tables['where'])){
				foreach($tables['where'] as $k => $w){
					$this->db->where($tables['table'].'.'.$k , $w);
				}
			}

			if(isset($tables['join_table'])){
				$this->db->join($tables['join_table'], $tables['table'].'.'.$tables['join_fields'][0].' = '.$tables['join_table'].'.'.$tables['join_fields'][1], $tables['join_type']);
			}
		}
		
		return $this->db->get()->result_array();
	}

//============================================================================================================
	
	/****** select_by_array ********* 
		Retorna dados de uma tabela de acordo com as clausulas where informadas e campos de retorno

		String		$table 	  		= nome da tabela onde será buscado os dados;
		Array 		$where 	  		= cláusula where do select;

			array('campo1' => 'valor1', 'campo2' => 'valor2')
			array('or' => array('campo1' => 'valor1', 'campo2' => 'valor2'))
			array('or' => array('campo1' => array('valor1', 'valor2', 'valor3'))
			array('like' => array('campo1' => 'valor1'))
			array('between' => array('campo1' => array(valor1, valor2)))

		Array 		$fields 		= campos a serem retornados;

			array('campo1', 'campo2', campo3)

		Array 		$page 	  		= monta paginação para os dados;

			array(índice, quantidade por índice)

		String 		$order_field 	= campo pelo qual os dados serão ordenados;
		String 		$order_side 	= tipo de ordenaçao - ASC: crescente e DESC: decrescente;
	*/
	function select_by_array($table, $where=false, $fields_ret=false, $page=false, $order_field=false, $order_side=false){
		if($page){
			$perpage 	= 12;
			
			if(is_array($page)){
				$p 		= $page[0];
				$perpage 	= $page[1];
				$page 		= $p;
			}
			
			$p2		= ($page-1);
			$l1 	= ($p2*$perpage);
			$l2 	= $perpage;

			$this->db->limit( $l2, $l1 );
		}

		if($order_field && $order_side){
			$this->db->order_by($order_field,$order_side);
		}

		if($where){
			foreach($where as $fields => $values){
				switch($fields){
					case 'or':
						if(is_array($values)){
							foreach($values as $field => $value){
								if(!is_array($value)){
									$this->db->or_where($field, $value);
								}
								else{
									foreach($value as $val){
										$this->db->or_where($field, $val);
									}
								}
							}
						}
						break;

					case 'like':
						if(is_array($values)){
							foreach($values as $field => $value){
								$this->db->like($field, $value);
							}
						}
						break;

					case 'fromtoday':
						$this->db->where($v." >= CURRENT_DATE()");
						break;

					case 'pasttoday':
						$this->db->where($v." <= CURRENT_DATE()");
						break;

					case 'between':
						if(is_array($values)){
							foreach($values as $field => $value){
								$this->db->where($field." BETWEEN ".$value[0]." AND ".$value[1]);
							}
						}		
						break;

					default:
						$this->db->where($fields, $values);
						break;	
				}
			}
		}

		if(!$fields_ret){
			return $this->db->get($table)->result_array();
		}else{
			$this->db->select($fields_ret)->from($table);	
			return $this->db->get()->result_array();
		}
	}

//============================================================================================================	
	
	function selectFromToday($table, $field, $page = 0) {
		
		$this->db->order_by($field,'DESC');
		$this->db->where($field." >= CURRENT_DATE()");
		$query = $this->db->get($table);
		$resultado = $query->result_array();
		return $resultado;
        }
	
	function selectPastToday($table, $field, $page = 0) {
		
		$this->db->where("data <= CURRENT_DATE()");
		$query = $this->db->get($table);
		$resultado = $query->result_array();
		return $resultado;
        }
	
	function selectBetween($table, $field, $value1, $value2) {

		$this->db->order_by($field,'DESC');
		$this->db->where($field." BETWEEN ".$value1." AND ".$value2);
		$query = $this->db->get($table);
		$resultado = $query->result_array();		
		return $resultado;
        }
	
	function selectBetweenCount($table, $field, $value1, $value2) {
		$query = $this->db->query("SELECT COUNT(id) AS total FROM ".$table." WHERE ".$field." BETWEEN '".$value1."' AND '".$value2."'");
		$resultado = $query->result_array();		
		return $resultado;
	}

//============================================================================================================

	/****** menu_dropdown *********
		Utilizado para montar os dados de um campo do tipo relate

		String 		$table 	  = nome da tabela onde será buscado os dados;
		String 		$field 	  = campo a ser retornado
		Boolean 	$fk 	  = se TRUE, os dados podem ter relacionamento uns com os outros
		Boolean 	$required = se FALSE, acrescenta uma posição 0 no array de retorno
	*/
	function menu_dropdown($table, $field, $fk = false, $required = false){
		if(!$fk){
			$this->db->select(array('id', $field))->from($table);
		}
		else{
			$this->db->select(array('id', $field, 'id_fk'))->from($table);
		}
		
		$itens = $this->db->get()->result_array();
		$result = array();

		if(!$required){
			$result['0'] = '-';
		}

		if(sizeof($itens) > 0){
			if(!$fk){
				foreach($itens as $r){
					$result[$r['id']] = $r[$field];
				}
			}
			else{
				$array = array();
				$i = 0;
			
				foreach($itens as $item){
				    $array[$item['id_fk']][$i]['id']      = $item['id'];
				    $array[$item['id_fk']][$i][$field]    = $item[$field];
				    $i++;
				}
		
				foreach( $array[0] as $item => $k) {
				    $result[$k['id']] = $k[$field];
				    if(array_key_exists($k['id'],$array)){
						foreach($array[$k['id']] as $p){
						    $result[$p['id']] = $k[$field].' » '.$p[$field];
						}
				    }
				}
			}
		}
		return $result;
	}

//============================================================================================================
	
	function sum_by_field($table,$field,$value,$fieldSum){		
		$q = "SELECT SUM(".$fieldSum.") FROM ".$table." WHERE ".$field."=".$value."";
		$result = $this->query($q);
		$resultado = $result->result_array();
		return $resultado;
	}
	
	function select_like_search($table,$values){
		
		$query = 'id > "0" ';
		
		$i = 1;
		foreach($values as $value => $k){
			if($i == 1){
				$query .= 'AND '.$value.' LIKE "%'.$k.'%"';	
				$i++;
			}else{
				$query .= 'OR '.$value.' LIKE "%'.$k.'%"';
			}
		}
		
		$result	= $this->db->get_where($table, $query);
		$resultado = $result->result_array();
		return $resultado;
	}
	
	/*###################################*/
	/*##############| MENU |#############*/
	/*###################################*/
	

	function getMenuList($table, $page = 0, $order_field=false,$order_side=false) {
		
		if($order_field){
			$this->db->order_by($order_field,$order_side);
		}
		
		$query = $this->db->get($table);
		$resultado = $query->result_array();
		
		$return = array();
		
		$i=0;
		
		foreach($resultado as $result){
			
			$id_route = $result['id_route'];
			$route = $this->routes->get($id_route);

			$return[$i]['titulo'] 		= $result['titulo'];
			$return[$i]['link'] 		= $result['link'];
			$return[$i]['rota'] 		= $route->route;
			$return[$i]['slug'] 		= $route->slug;
			$return[$i]['id'] 		= $result['id'];
			$return[$i]['id_route'] 	= $id_route;
			
			$i++;
		}
		
		return $return;
        }
	
	/*###########################################*/
	/*########| Save / Update / Delete |########*/
	/*#########################################*/
	
//============================================================================================================
	
	/****** save_multiple ********* 
		Grava um conjunto de registros em uma determinada tabela

		String 	$table 		= 	nome da tabela onde será gravado os registros;
		Array 	$values 	= 	array contendo sub-arrays com os dados a serem gravados

			array(
				array(
					'campo1' => 'valor',
					'campo2' => 'valor',
					'campo3' => 'valor'
				),
				array(
					'campo1' => 'valor',
					'campo2' => 'valor',
					'campo3' => 'valor'
				)
			)
	*/
	function save_multiple($table, $values){
		return $this->db->insert_batch($table, $values); 
	}

//============================================================================================================
	
	/****** save ********* 
		Grava um registros da tabela informada

		String 	$table 		= 	nome da tabela onde será buscado o registro;
		Array 	$data 		= 	array contendo os dados a serem gravados

			array(
				'campo1' => 'valor',
				'campo2' => 'valor',
				'campo3' => 'valor'
			)

		OBS:
			Se for passado um valor de $where diferente de array, o mesmo sera associado a um campo 'id' no banco
	*/
	function save($table, $data){
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	
//============================================================================================================
	
	/****** update ********* 
		Atualiza um registros da tabela informada de acordo com id informado em $data

		String 	$table 		= 	nome da tabela onde será buscado o registro;
		Array 	$data 		= 	array contendo o id do registro e os campos a serem alterados
			
			array(
				'id' 	 => 'valor',
				'campo2' => 'valor',
				'campo3' => 'valor'
			)

		OBS:
			Se for passado um valor de $where diferente de array, o mesmo sera associado a um campo 'id' no banco
	*/
	function update($table, $data){
		$this->db->where('id', $data['id']);
		$this->db->update($table, $data);
		return $data['id'];
	}

//============================================================================================================
	
	/****** delete ********* 
		Deleta registros da tabela informada de acordo com as clausulas where

		String 	$table 		= 	nome da tabela onde será buscado o registro;
		Array 	$where 		= 	array contendo as condições where da instrução

		OBS:
			Se for passado um valor de $where diferente de array, o mesmo sera associado a um campo 'id' no banco
	*/
	function delete($table, $where){
		if(is_array($where)){
			foreach($where as $fields => $values){
				$this->db->where($fields, $values);
			}
		}
		else{
			$this->db->where('id', $where);
		}
		return $this->db->delete($table);
	}

//============================================================================================================	
}