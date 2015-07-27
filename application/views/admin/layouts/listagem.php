<script src="<?php echo base_url(); ?>assets/js/jquery/jquery-sortable.js"></script>
<link href="<?php echo base_url(); ?>assets/css/admin/listagem.css" rel="stylesheet">

<?php $this->load->view( ADMIN_VIEW.'layouts/pagination.php'); ?>

<br class="clear" />

<ol id="sortable" style="padding: 0px;">
	<?php
	if(sizeof($itens) <= 0){
		echo '<h4 class="wrap txtcenter">Nenhum item encontrado</h4>';	
	}
	else{
		if(isset($campos)){
			if(isset($layout)){
				if($layout =='table'){
					$header = '<div class="bloco header">';

					foreach($campos as $c){
						if(isset($c['hidden']) && !$c['hidden']){
							if(isset($c['listagem']) && $c['id'] != 'ativo'){
								if($c['listagem']){
									$header .= '<div class="titulo-wrapper">
													<div class="titulo">
														<h1>'.$c['txt'].'</h1>
													</div>
												</div>';
								}
							}
						}
					}
					
					$header .= '	<div class="titulo-wrapper">
										<div class="titulo" style="width: 10% !important;">
											<h1>Ações</h1>
										</div>
									</div>
								</div>';

					echo $header;
				}
			}
		}

		foreach($itens as $item){

			$botaoAtivo = '';
			echo '<li id="'.$item['id'].'">
					<div class="bloco icon-th-list" id="item'.$item['id'].'">';
				
			if(isset($campos)){

				foreach($campos as $c){

					if(isset($c['hidden']) && !$c['hidden']){

						$bloco = '';

						switch($c['type']){

							//CAMPOS QUE NÃO APARECEM FORA DO MODAL
							case 'idioma':
							case 'senha':
							case 'video':
							case 'wys':
								break;
					    	
					    	//CAMPOS QUE APARECEM FORA DO MODAL
					     	case 'date':
					     	case 'tags':
					     	case 'text':
					     	case 'textarea':
							case 'time':
								if($c['listagem']){
									if($item[$c['id']] == '' || $item[$c['id']] == null){
										$item[$c['id']] = 'Vazio';
									}
									$bloco .= '<div class="titulo-wrapper">
													<div class="titulo">
														<h1>'.$item[$c['id']].'</h1>
													</div>
												</div>';
							    }
								break;

							case 'button':
								$bloco .= '<div class="titulo-wrapper">
												<div class="titulo" style="padding-top: 7px;">
													<button id="button_'.$c['id'].'_'.$item['id'].'" type="button" class="btn btn-'.$c['config']['color'].'">
														<span class="glyphicon glyphicon-'.$c['config']['icon'].'"></span>
														'.$c['txt'].'
													</button>
												</div>
												<script>
													$("#indices").delegate("#button_'.$c['id'].'_'.$item['id'].'", "click", function(e){
														e.preventDefault();
														$(".loading").removeClass("hide") ;
														$.ajax({
													        url: "'.base_url($c['controller_link']).'",
													        type: "POST",
													        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
													        data: {
													        	id_item: "'.$item['id'].'",
													        	module_pk: "'.$module.'",';
													        	
								$parametros = '';
								foreach($c['controller_param'] as $param_key => $param_value){
									if(is_array($param_value)){
										$parametros .= $param_key.': "'.implode(',', $param_value).'",'; 	
									}
									else{
										$parametros .= $param_key.': "'.$param_value.'",'; 	
									}
									
								}
								$parametros = trim($parametros, ',');
								$bloco .= $parametros;
								

								$bloco .= '			        },
													        dataType: "html",
													        success: function(data){
													        	$(".loading").addClass("hide");';

								switch($c['button_type']){

									case 'associar':
									case 'export':
										$bloco .= '				$("#modalButton .modal-body").off();
																$("#modalButton .modal-body").html(data);
											            		$("#modalButton").modal("show");';
										break;

									case 'edit';
										$bloco .= '				$(".modal-bloco").html(data);
												            	open_close_modalDetalhamento($(this));';
										break;
								}

								$bloco .= '					}
														});
													});
												</script>
											</div>';
								break;

							case 'galeria':
								if($c['listagem']){
									$n_images = sizeof($this->crud->select_by_array('galeria', array('module' => $module, 'pk' => $item['id'])));
									$imagem = ($n_images == 1) ? 'imagem' : 'imagens';
									$bloco .= '<div class="titulo-wrapper">
													<div class="titulo">
														<h1>'.$n_images.' '.$imagem.'</h1>
													</div>
												</div>';
								}
								break;
						
							case 'image':
								if($c['listagem']){
									if($item[$c['id']] == '' || $item[$c['id']] == null){
										$imageSrc = base_url().'assets/img/bootstrap/noimage.gif';
									}
									else{
										$imageSrc = base_url().'uploads/'.$module.'/'.$item[$c['id']];
									}

									if($layout == 'blocos'){
										$bloco .= '<div class="img-area">
														<div class="imagem" style="background:url('.$imageSrc.') center center"></div>
													</div>';	
									}
									else{
										$bloco .= '<div class="titulo-wrapper">
														<div class="titulo">
															<img height="50px" src="'.$imageSrc.'">
														</div>
													</div>';
									}
								}
								break;

							case 'onoff':
								if($c['listagem']){
									if($c['id'] == 'ativo'){
										$butativo = '';
										if($item['ativo'] == 1){
											$butativo = 'butativo';
										}
										$botaoAtivo = '<a href="#" class="'.$butativo.' ativar botao-bloco" data-pk="'.$item['id'].'"><span class="glyphicon glyphicon-off"></span> </a>';	
									}
									else{
										$status = ($item[$c['id']] == 1) ? 'Sim' : 'Não';
										$bloco .= '<div class="titulo-wrapper">
													<div class="titulo">
														<h1>'.$status.'</h1>
													</div>
												</div>';
									}
								}
								break;

							case 'relate':								
								if($c['multiple'] == 'true'){
									if($c['listagem']){
									 	$bloco .= '<div class="titulo-wrapper">
									 					<div class="titulo">
									 						<p>';

									 	$opcoes = trim($item[$c['id']], ',');
										$opcoes = explode(',', $opcoes);

										foreach($opcoes as $op){
										 	if($op == "0" || $op == ""){
										 		$bloco.= "--";
										 		break;
										 	}
										 	else{
										 		$bloco.= $drop[$c['id']][$op].", ";

										 	}
										 	
										}
										$bloco = trim($bloco, ", ");
									 	$bloco .= '			</p>
									 					</div>
									 				</div>';	
									}
								}
								else{
									if($c['listagem']){
										$value = (!isset($drop[$c['id']][$item[$c['id']]])) ? '--' : $drop[$c['id']][$item[$c['id']]];
										$bloco .= '<div class="titulo-wrapper">
														<div class="titulo">
															<p>'.$value.'</p>
														</div>
													</div>';
									}
								}	
								break;

							case 'repositorio':
								if($c['listagem']){
									$n_files = sizeof($this->crud->select_by_array('repositorio', array('module' => $module, 'pk' => $item['id'])));
									$file = ($n_files == 1) ? 'arquivo' : 'arquivos';
									$bloco .= '<div class="titulo-wrapper">
													<div class="titulo">
														<h1>'.$n_files.' '.$file.'</h1>
													</div>
												</div>';
								}
								break;

							case 'rota':
								$slug = $this->crud->select_by_array('routes', array('id' => $item[$c['id']]));
 							    if($c['listagem']){
 							    	if(sizeof($slug) == 0 || $slug[0]['slug'] == ''){
										$slug = 'Vazio';		 							    	    
 							    	}
 							    	else{
 							    		$slug = $slug[0]['slug'];
 							    	}
									$bloco .= '<div class="titulo-wrapper">
													<div class="titulo">
														<h1>'.$slug.'</h1>
													</div>
												</div>';
							    }
								break;
						
							case 'select':
								if($c['multiple'] == 'true'){
									if($c['listagem']){
										 $bloco .= '<div class="titulo-wrapper">
										 				<div class="titulo">
										 					<p>';

										 $opcoes = trim($item[$c['id']], ',');
										 $opcoes = explode(',', $opcoes);

										 foreach($opcoes as $op){
											if($op == "0" || $op == ""){
										 		$bloco.= "--";
										 		break;
										 	}
										 	else{
										 		$bloco.= $c['options'][$op].", ";	
										 	}
										 	
										 }
										 $bloco = trim($bloco, ", ");
										 $bloco.= '			</p>
										 				</div>
										 			</div>';	
									}
								}
								else{
									if($c['listagem']){
										$value = (!isset($c['options'][$item[$c['id']]])) ? '--' : $c['options'][$item[$c['id']]];
									 	$bloco .= '<div class="titulo-wrapper">
									 					<div class="titulo">
									 						<p>'.$value.'</p>
									 					</div>
									 				</div>';	
									}
								}
								break;

							case 'sexo':
								if($c['listagem']){
									$sexo = ($item[$c['id']] == 'F') ? 'Feminino' : 'Masculino';
									$bloco .= '<div class="titulo-wrapper">
													<div class="titulo">
														<h1>'.$sexo.'</h1>
													</div>
												</div>';
							    }
								break;

							case 'upload':
								if($item[$c['id']] == '' || $item[$c['id']] == null){
									$totalArquivos = 0;
								}
								else{
									$arquivos = explode(';', $item[$c['id']]);
									$totalArquivos = sizeof($arquivos);
								}
								
							    if($c['listagem']){
									$bloco .= '<div class="titulo-wrapper">
													<div class="titulo">
														<h1>'.$totalArquivos.' / '.$c['n_files'].'</h1>
													</div>
												</div>';
							    }
								break;
							
						    case 'createtime':
						    case 'updatetime':
							    if($c['listagem']){
							    	$data = ($item[$c['id']] != '') ? $item[$c['id']] : 'Sem data';
									$bloco .= '<div class="titulo-wrapper">
									 				<div class="titulo">
									 					<p>'.$data.'</p>
									 				</div>
									 			</div>';	
							    }
						  	 	break;
						}// fim do switch case

						echo $bloco;
					}
				}
				
				$acoes = '  <div class="botao-set">
							   '.$botaoAtivo.'
							   <a href="#" class="editar botao-bloco" data-id="'.$item['id'].'"><span class="glyphicon glyphicon-cog"></span></a>
			    			   <a href="#" class="confirm-delete deletar botao-bloco" data-id="'.$item['id'].'"><span class="glyphicon glyphicon-trash"></span></a>
						    </div>
						</div>';
			
				echo $acoes;
			} // fim do if(isset($campos))
				
			echo '</li>';
		
		} //fim do foreach($itens as $item)
	} //fim do else de if(sizeof($itens) <= 0)
	?>

</ol>		
<br class="clear" />

<?php $this->load->view( ADMIN_VIEW.'layouts/pagination.php');?>

<!-- Modal de detalhamento de item -->
<div class="modal-bloco flipped">
	<!-- Ao editar um item, o detalhamento aparecerá aqui -->
</div>
<!-- Fim do modal de detalhamento -->

<script>
	$(document).ready(function() {
		$('.relate').trigger('change');
		$('#ordenar').bootstrapSwitch({
			onColor: 'success',
			offColor: 'danger',
			onText: 'Sim',
			offText: 'Não'
		});

		$('#ordenar').bootstrapSwitch('state', false);

		$('#ordenar').on('switchChange.bootstrapSwitch', function (e, data) {
		    value = $('#ordenar').bootstrapSwitch('state');
		    
		    if(value == true){
				$( "#sortable" ).sortable("enable");
		    }
		    else{
				$( "#sortable" ).sortable("disable");
		    }
		}); 

		$("#sortable").sortable({
			group: 'sortable',
			pullPlaceholder: true,
			sortable: 'disable',
			cancel:".disabled",
			onDrop: function  (item, targetContainer, _super) {
			    var clonedItem = $('<li/>').css({height: 0})
			    item.before(clonedItem)
			    clonedItem.animate({'height': item.height()})
			    item.animate(clonedItem.position(), function  () {
			    clonedItem.detach()
			    _super(item)
			    })
			
			    ordem = new Array();
			
			    $('ol').children('li').each(function(idx, elm) {
			   	 ordem.push(elm.id);
			    });

			    $.ajax({
				    url: "<?php echo ci_site_url($module.'/admin/ordenar'); ?>",
				    type: "POST",
				    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				    data: { lista: ordem.toString() },
				    dataType: "html",
				    success: function(data) {
				    }
			    });
			},
			// set item relative to cursor position
			onDragStart: function ($item, container, _super) {
			  var offset = $item.offset(),
			  pointer = container.rootGroup.pointer
			
			  adjustment = {
			    left: pointer.left - offset.left,
			    top: pointer.top - offset.top
			  }
			
			  _super($item, container)
			},
			onDrag: function ($item, position) {
			  $item.css({
			    left: position.left - adjustment.left,
			    top: position.top - adjustment.top
			  })
			}
		});

		$( "#sortable" ).sortable("disable");

	});
</script>
