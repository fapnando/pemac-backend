<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Button extends MX_Controller{

	function __construct(){
	    parent::__construct();
	}

	function index(){
		$id_item = $this->input->post('id_item');
		$module_pk = $this->input->post('module_pk');
		$campo_pk = $this->input->post('campo_pk');
		$campo_pk_titulo = $this->input->post('campo_pk_titulo');
		$module_fk = $this->input->post('module_fk');
		$campo_fk = $this->input->post('campo_fk');
		$campos_exibicao = explode(',', $this->input->post('campos_exibicao'));
		$item = $this->crud->select_by_array($module_pk, array($campo_pk => $id_item), array($campo_pk_titulo));
		$item = $item[0];

		//para uso da exportaçao
		$header = array();

		$dados = $this->crud->select_by_array($module_fk, array($campo_fk => $id_item), $campos_exibicao);

		if(sizeof($dados) == 0){
			echo '	<div class="panel panel-default">
						<div class="panel-heading">Resultados para '.$item[$campo_pk_titulo].'</div>
							<div class="panel-body">
								<p>Nenhum registro encontrado</p>
							</div>
						</div>
					</div>';
		}
		else{
			$return = '	<div class="panel panel-default">
		  					<div class="panel-heading">Resultados para '.$item[$campo_pk_titulo].'</div>
		  						<div class="panel-body">
		    						<button id="btn_exportar_modalButton" type="button" class="btn btn-success">
		    							<span class="glyphicon glyphicon-list-alt"></span>
		    							Exportar para Excel
		    						</button>
		  						</div>
		  						<table class="table">
		  							<tr>';

		  	foreach($dados[0] as $key => $value){
		  		$return .= '			<td style="text-align: center;"><b style="font-size: 1.1em;">'.ucwords($key).'</b></td>';
		  		$header[$key] = ucwords($key);
		  	}

		  	$return .= '			</tr>';

		  	foreach($dados as &$dado){
		  		$return .= '		<tr>';
		  		foreach($dado as $k => $campo){
		  			if($k == $campo_fk){
		  				$return .= '		<td style="text-align: center;">'.$item[$campo_pk_titulo].'</td>';
		  				$dado[$k] = $item[$campo_pk_titulo];
		  			}
		  			else{
		  				$return .= '		<td style="text-align: center;">'.$campo.'</td>';	
		  			}
		  		}
		  		$return .= '		</tr>';
		  	}

			$return .= '		</table>
							</div>
						</div>
						<script>
							$("#modalButton .modal-body").delegate("#btn_exportar_modalButton", "click", function(e){
								$.ajax({
							        url: "'.base_url('button/exportar').'",
							        type: "POST",
							        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
							        data: {
							        	dados: \''.json_encode($dados).'\',
							        	header: \''.json_encode($header).'\',
							        	filename: \''.$module_fk.'_'.$item[$campo_pk_titulo].'\'
							        },
							        dataType: "html",
							        success: function(data){
							        	$(\'#modalDownload .modal-body\').html(\'<p>Arquivo gerado com sucesso. Faça o download do arquivo clicando no botão abaixo.</p><a href="\'+basepath+data+\'"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-download"></span> Download</button></a>\');
            							$(\'#modalDownload\').modal(\'show\');
							        }
								});
							});
						</script>';

			echo $return;
		}
	}

	function exportar(){
		$header = json_decode($this->input->post('header'), true);
		$dados = json_decode($this->input->post('dados'), true);
		$filename =  $this->input->post('filename');
		
		echo $this->base->to_excel($header, $dados, $filename, true);
	}

	function edit(){
		$id_item = $this->input->post('id_item');
		$module_pk = $this->input->post('module_pk');

		$module_fk = $this->input->post('module_fk');
		$campo_fk = $this->input->post('campo_fk');

		$module = modules::load($module_fk);
		
		$campo_fk_value = $this->crud->select_by_array($module_pk, array('id' => $id_item), array($campo_fk));
		$campo_fk_value = $campo_fk_value[0][$campo_fk];

		echo $this->base->detalhamento($campo_fk_value, false, $module);	
	}

	function monta_modal_associacao(){
		$id_item = $this->input->post('id_item');
		$module_fk = $this->input->post('module_fk');
		$campo_fk = $this->input->post('campo_fk');

		$tabela_associativa = $this->input->post('tabela_associativa');
		$campo_ass_pk 		= $this->input->post('campo_ass_pk');
		$campo_ass_fk 		= $this->input->post('campo_ass_fk');		
		

		$itens_associados = $this->crud->select_by_array($tabela_associativa, array($campo_ass_pk => $id_item));
		foreach($itens_associados as &$ia){
			$ia = $ia[$campo_ass_fk];
		}


		$itens_module_fk = $this->crud->select_by_array($module_fk, false, array('id', $campo_fk));

		$return = '	<div class="panel panel-default">
	  					<div class="panel-heading">Associar '.$module_fk.'</div>
	 	  					<table class="table">
	 	  						<tr>
									<td width="10%">-</td>
									<td width="10%">ID</td>
									<td width="80%">'.ucwords($campo_fk).'</td>
								</tr>';

	 	foreach($itens_module_fk as $i){
	 		$checked = (in_array($i['id'], $itens_associados)) ? 'checked' : '';
			$return .= '		<tr>
									<td width="10%"><input class="associar_checkbox" type="checkbox" value="'.$i['id'].'" '.$checked.'/></td>
									<td width="10%">'.$i['id'].'</td>
									<td width="80%">'.$i[$campo_fk].'</td>
								</tr>';
	 	}				
								
	  	$return .= '		</table>
	  					</div>
		  			</div>
		  			<button id="btn-marcar" type="button" class="btn btn-default">
						<span class="glyphicon glyphicon-list-alt"></span> Marcar Todos
					</button>
					<button id="btn-desmarcar" type="button" class="btn btn-default">
						<span class="glyphicon glyphicon-list-alt"></span> Desmarcar Todos
					</button>
		  			<button id="btn-associa-dados" type="button" class="btn btn-success">
						<span class="glyphicon glyphicon-list-alt"></span> Gravar
					</button>
					<script>
						$("#modalButton .modal-body").on("click", "#btn-associa-dados", function(){
							var values = [];
							$(".associar_checkbox:checked").each(function(){
								values.push($(this).val());
							})

							if(values.length == 0){
								values = false;
							}

							$.ajax({
								url: "'.base_url('button/associar').'",
								type: "POST",
								dataType: "html",
								data: {
									tabela_associativa: "'.$tabela_associativa.'",
									campo_ass_pk: "'.$campo_ass_pk.'",
									value_pk: "'.$id_item.'",
									campo_ass_fk: "'.$campo_ass_fk .'",
									values_fk : values
								}
							})
							.done(function(data) {
								if(data == "true"){
									alert("Itens associados com sucesso.");
									$("#modalButton").modal("hide");
								}
							})
						})

						$("#modalButton .modal-body").on("click", "#btn-marcar", function(){
							$(".associar_checkbox").prop("checked", true);

						})

						$("#modalButton .modal-body").on("click", "#btn-desmarcar", function(){
							$(".associar_checkbox").prop("checked", false);
						})
					</script>';

		 echo $return;
	}

	function associar(){
		$values_fk = $this->input->post('values_fk');
		$this->crud->delete($this->input->post('tabela_associativa'), array($this->input->post('campo_ass_pk') => $this->input->post('value_pk')));

		if($values_fk != 'false'){
			foreach($values_fk as &$val){
				$val = array(
					'ativo' => '1',
					$this->input->post('campo_ass_pk') => $this->input->post('value_pk'),
					$this->input->post('campo_ass_fk') => $val
				);
			}

			$this->crud->save_multiple($this->input->post('tabela_associativa'), $values_fk);
		}

		echo 'true';
	}
}
?>