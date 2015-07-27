
<!-- Modal de novo registro -->
<form class="modal fade" id="novo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" action="#" method="post" enctype="multipart/form-data">
	<div class="modal-dialog">
		<div class="modal-content">
    		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h4 class="modal-title" id="myModalLabel">Adicionar <?php echo $module; ?></h4>
      		</div>
      		<div class="modal-body">
        		<div id="form">
        			<?php
        			if(isset($campos)){
        				$form = '';
        				foreach($campos as $c){
        					if(!$c['hidden']){
        						$data = array('type' => $c['type'], 'id' => $c['id'], 'txt' => $c['txt'], 'required' => @$c['required'], 'module' => $module);
        						switch($c['type']){

        							//CAMPOS QUE NÃO SÃO EXIBIDOS NO FORM DE CADASTRO
                                    case 'button':
                                    case 'image':
                                    case 'upload':
                                    case 'galeria':
                                    case 'repositorio':
        								break;

        							case 'hidden':
        								$value = $c['value'];
        								$form .= $this->my_form->form_hidden($data, $value);
        								break;

        							case 'text':
        								$form .= $this->my_form->form_text($data);
        								break;

        							case 'textarea':
        								$form .= $this->my_form->form_textarea($data);
        								break;
        								
        							case 'senha':
        								$form .= $this->my_form->form_senha($data);
        								break;

        							case 'wys':
        								$form .= $this->my_form->form_wys($data);
        								break;
        								
        							case 'onoff':
        								$options = array('1' => 'Sim', '0' => 'Não');
        								$form .= $this->my_form->form_onoff($data, $options);
        								break;

        							case 'sexo':
        								$options = array('F' => 'Feminino', 'M' => 'Masculino');
        								$form .= $this->my_form->form_onoff($data, $options);
        								break;

        							case 'video':
        								$form .= $this->my_form->form_video($data, $c['origem']);
        								break;

        							case 'rota':
        								$rota = array('rota' => $c['rota'], 'campo' => $c['campo'], 'prefix' => $c['prefix']);
        								$form .= $this->my_form->form_rota($data, $rota);
        								break;
        								
        							case 'date':
        								$form .=  $this->my_form->form_date($data);
        								break;

        							case 'time':
        								$form .= $this->my_form->form_time($data);
        								break;

        							case 'tags':
        								$form .= $this->my_form->form_tags($data);
        								break;
        								
        							case 'select': 
        								$options = $c['options'];
        								$multiple = $c['multiple'];
        								$form .= $this->my_form->form_select($data, $options, $multiple);
        								break;

        							case 'relate':
										$condicional = array('condicional' => $c['condicional'], 'table' => $c['relate']['tabela'], 'campo' => $c['relate']['campo']);
										$options = $drop[$c['id']];
										$multiple = $c['multiple'];
        								$form .= $this->my_form->form_relate($data, $options, $condicional, $multiple);
        								break;
        						}
        					}
        				}
        				echo $form;
        			}

        			?>
				</div>
      		</div>
      		<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
				<button class="btn btn-primary" id="submit" type="button">Gravar Dados</button>
      		</div>
    	</div>
  	</div>
</form>
<script>
	$("#submit").on('click', function(){
		$(this).css("display", "none");
		setTimeout(function(){
			$("#submit").css("display", "inline-block");
		}, 1000);
	});
</script>
<!-- Fim do modal de novo registro -->