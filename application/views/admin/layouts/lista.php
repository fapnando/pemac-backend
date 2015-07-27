<?php
if(isset($campos)){
    $cfm = 0;
    
    foreach($campos as $c){
    	if(isset($c['hidden']) && !$c['hidden']){
		    if(isset($c['listagem']) && $c['id'] != 'ativo'){
				if($c['listagem']){
				    $cfm++;
				}
		    }
		}
    }
    if($cfm != 0){   
    	$w = (90/$cfm);
    }
}
?>

<style>
	.butativo{
		color: #9bb911 !important;
	}

    .flipped {
		overflow:hidden;
        transform:rotateY(180deg);
        -moz-transform:rotateY(180deg);
        -webkit-transform:rotateY(180deg);
    }
    
    .unflipped{
		overflow:scroll;
        transform:rotateY(0deg);
        -moz-transform:rotateY(0deg);
        -webkit-transform:rotateY(0deg);               
    }

    #indices{
        position: relative;
        width:960px;
        min-height: 100%;
        margin:0 auto;
    }
    
    #indices .bloco:hover{
        opacity:1;
        border:1px solid rgba(50,50,50,1);
    }
    
    #indices .bloco .titulo h1{
		display:table-cell;
		vertical-align:middle;
    	font-size: 14px;
    }
    
    #indices .bloco .titulo p{
		display:table-cell;
		vertical-align:middle;
        font-size: 14px;
    }
    
    #indices .bloco .img-area .imagem{
		background-size: cover !important;
		-webkit-background-size: cover !important;
		-moz-background-size: cover !important;
		height: 100%;
		width: 100%;
    }
    
    .modal-bloco{
		padding: 20px 30px;
        z-index:9999;             
        position: absolute;
        top:0%;
        left:0%;
        width:100%;
        height:auto;
        background: rgba(255,255,255,.98);
		-moz-box-shadow:    5px 4px 10px 4px rgba(0,0,0,.35);
		-webkit-box-shadow: 5px 4px 10px 4px rgba(0,0,0,.35);
		box-shadow:         5px 4px 10px 4px rgba(0,0,0,.35);
    }

    .modal-bloco, .bloco{
        perspective: 500px;
        -webkit-perspective: 500px;
        -moz-perspective: 500px;
        transform-style: preserve-3d;
        -webkit-transform-style: preserve-3d;
        -moz-transform-style: preserve-3d;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        border-radius:5px;
        -webkit-border-radius:5px;
        -moz-border-radius:5px;
        -o--border-radius:5px;
        transition: all .4s ease;
        -webkit-transition: all .4s ease;
        -ms-transition: all .4s ease;
        -moz-transition: all .4s ease;
        -o-transition: all .4s ease;                 
    }

    .modal-campo{
    	margin-right:25px;
    	padding:10px;
    	line-height: 5px;
    }
    
    .modal-campo .editable-click{
    	line-height:25px;
    }
    
    .modal-campo h1{
    	font-size:14px;
    	margin:0;
    	padding:0;
    }

    .modal-bloco .coluna.left{
    	width:30%;
    }
    
    .modal-bloco .coluna.left > div{
    	clear:both;
    }
    
    .modal-bloco .coluna.right{
    	width:70%;
    }
    
    .modal-bloco .coluna.right > div{
    	width:100%;
    }
    
    #lista{
    	margin-top:90px;
    }
    
    #lista:after, #indices:after{
    	clear: both;
    }

    .table .header .titulo{ 
		background: #333 !important; 
		color: #fff; 
	} 
    
    .table #indices .bloco{
	    z-index:100;
	    cursor:pointer;
	    overflow:hidden;                
	    width: 100%;                
	    height:auto;
	    float:left;
	    margin:0;
	    border:1px solid #cecece;
	    
	    opacity:.8;
	    border-radius:0;
	    -webkit-border-radius:0;
	    -moz-border-radius:0;
	    -o--border-radius:0;
    }
    
    .table #indices .bloco .img-area{
	    text-align: center;
	    height: 100px;
	    width: <?php echo $w; ?>%;
	    float: left;
    }
    
    .table .botao-set{
	    width: 10%;
	    float: right;
	    text-align: center;
	    margin-top: 15px;
    }
    
    #indices .bloco .titulo{
	    -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
	    -moz-box-sizing: border-box;    /* Firefox, other Gecko */
	    box-sizing: border-box;/* Opera/IE 8+ */
	    line-height:25px !important;
	    display: table;
	    background:#f9f9f9;
	    margin:0;
	    min-height:50px;
	    text-align: center;
	    float: left !important;
	    vertical-align:middle;
	    width: <?php  echo $w; ?>%;
    }
    
    .blocos  #indices .bloco{
	    z-index:100;
	    cursor:pointer;
	    overflow:hidden;                
	    width: 100%;
	    height:auto;
	    float:left;
	    margin:0;
	    border:2px dotted rgba(50,50,50,.5);
	    opacity:.8;
    }
    
    .blocos #indices .bloco:hover{
		opacity:1;
		border:2px solid rgba(50,50,50,1);
    }

    .blocos #indices .bloco .titulo-wrapper{
    	overflow:hidden;
    	min-height:50px;
    }
    
    .blocos #indices .bloco .titulo{
		-webkit-box-sizing: border-box; 
		-moz-box-sizing: border-box;    
		box-sizing: border-box;
		line-height:25px !important;
		display: table;
		background:#f9f9f9;
		margin:0;
		min-height:50px;
		text-align: center;
		width: 100%;		
    }
    
    .blocos #indices .bloco .img-area{
	    text-align: center;
	    height:120px;
	    width:100%;
    }
    
    .blocos #indices .bloco:hover .botao-bloco.ativar{
    	left:78px;
    }
    
    .blocos #indices .bloco:hover .botao-bloco.editar{
    	display:block;
    	opacity:1;
    	margin-left:-17.5px;
    	height:35px;
    	width:35px;
    }
    
    .blocos #indices .bloco:hover .botao-bloco.deletar{
    	right:78px;
    }
    
    .blocos #indices .bloco:hover .botao-set{
    	background:rgba(0,0,0,.45);
    }
    
    .blocos .botao-set{
		position:absolute;
		top:0;
		left:0;
		width:100%;
		height:100%;
		 transition: all .4s ease;
		-webkit-transition: all .4s ease;
		-ms-transition: all .4s ease;
		-moz-transition: all .4s ease;
		-o-transition: all .4s ease;                 
		background:rgba(0,0,0,0);
    }
    
    .blocos .botao-bloco{
	    position: absolute;
	    top:50%;
	    margin-top:-17.5px;
	    width:35px;
	    height:35px;
	    border-radius:100%;
	    background:white;
	    -webkit-box-sizing: border-box;
	    -moz-box-sizing: border-box;
	    box-sizing: border-box;
	    padding-top: 8px;
	    padding-left: 10px;		    
	     transition: all .4s ease;
	    -webkit-transition: all .4s ease;
	    -ms-transition: all .4s ease;
	    -moz-transition: all .4s ease;
	    -o-transition: all .4s ease;	
    }

    .blocos .botao-bloco.ativar{
    	left:-37px; 
    	background-color: #67bb6a; 
    	color: #fff;
    }
    
    .blocos .botao-bloco.editar{
	    left:50%;
	    margin-left:-17.5px;
	    opacity:0;
	    height:35px;
	    width:35px;
	    background-color: #000;
	    color: #fff;
	    padding-top: 8px;
	    padding-left: 10px;	
    }
    
    .blocos .botao-bloco.deletar{right:-37px; 
    	background-color: #d9534f; 
    	color: #fff; 
    }
	
	.coluna{
		padding: 0 15px;
	}
    
    .campo-interno{
    	display: block;
    	width:100%;
		margin-bottom:20px;
    }

    .campo-interno h3{
    	display:block;
    	font-size:18px;
    	padding:0;
    	margin:0 0 5px 0;
    }    
</style>



<?php
$painel_filtros = '';

if(isset($filtro) && sizeof($filtro) > 0){
	$painel_filtros .= '<div class="panel-group" id="accordion_filtros">
						  	<div class="panel panel-default">
						    	<div class="panel-heading">
						      		<a data-toggle="collapse" data-parent="#accordion_filtros" href="#collapse_filtros">
									    <h4 class="panel-title">
										    Filtros
										    <span class="right glyphicon glyphicon-chevron-down"></span>
									    </h4>
						      		</a>
						    	</div>
							    <div id="collapse_filtros" class="panel-collapse collapse">
							     	<div class="panel-body">
							     		<div class="input-group" style="float: left; width: 92%;">';

	foreach($filtro as $item){
		if($item['type'] == 'like'){	
			$painel_filtros .= '			<input type="text" class="form-control" placeholder="'.$item['titulo'].'"  id="filter_'.$item['id'].'" name="search" style="width: 150px; border-radius: 5px;"/>&nbsp';	    
		}

		if($item['type'] == 'select'){
			$painel_filtros .= '			<span> '.$item['titulo'].': </span>
											<select class="form-control multiselect select_filtros" id="filter_'.$item['id'].'">
												<option value="">Todos os Registros</option>';
			
			switch($campos[$item['field']]['type']){
				case 'select':
			    	foreach($campos[$item['field']]['options'] as $k => $v){
						$painel_filtros .= '	<option value="'.$k.'">'.$v.'</option>';
			        }
			    	break;

			    case 'relate':
					foreach($drop[$item['field']] as $k => $v){
						$painel_filtros .= '	<option value="'.$k.'">'.$v.'</option>';
			        }
			    	break;	    
			}
			$painel_filtros .= '			</select>';
		}

		if($item['type'] == 'date'){
	    	$painel_filtros .= '			<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
		            							<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
		            							<span></span> <b class="caret"></b>
		       								</div>
		        							<input type="hidden" id="filter_data" name="data" value="" />';
		}
	}

	$painel_filtros .=  '			</div>
									<div style="float: left; width: 8%;">
										<button class="right btn btn-info pag_teste" id="pesquisar" type="button">
											<span class="glyphicon glyphicon-search"></span>Filtrar
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>';
    
}
?>


<!-- Filtros -->				
<?php echo $painel_filtros; ?>
<!-- Fim de Filtros -->

<!-- Modos de Exibição -->
<div class="panel-group" id="accordion_exibicao">
  	<div class="panel panel-default">
    	<div class="panel-heading">
      		<a data-toggle="collapse" data-parent="#accordion_exibicao" href="#collapse_exibicao">
			    <h4 class="panel-title">
				    Modos de Exibição
				    <span class="right glyphicon glyphicon-chevron-down"></span>
			    </h4>
      		</a>
    	</div>
	    <div id="collapse_exibicao" class="panel-collapse collapse">
	     	<div class="panel-body">
				<div class="input-group" style="float: left; width: 90%;">
					<span> Nº de Itens: </span>
					<select class="multiselect form-control modos_exibicao" id="perpage" data-width="85px">
						<option value="12">12</option>
						<option value="24">24</option>
						<option value="36">36</option>
				    </select>
				
					<span> Modo de exibição: </span>
					<select class="multiselect form-control modos_exibicao" id="layout" data-width="80px">
						<option value="blocos">Blocos</option>
						<option value="table" selected>Tabela</option>
				    </select>

				    <span> Ordenar por: </span>
					<select class="multiselect form-control modos_exibicao" id="order" data-width="75px">
						<option value="id">ID</option>
						<option value="order">Ordem</option>	
				    </select>
				    <select class="multiselect form-control modos_exibicao" id="order_side" data-width="115px">
						<option value="asc">Crescente</option>
						<option value="desc" selected>Decrescente</option>
				    </select>
					<span> Reordenar: </span>
				    <input type="checkbox" id="ordenar"/>
				</div>

				<?php if($this->data->exportar != 'false'){ ?>
				
				<div style="float: left; width: 10%;">
					<button class="right btn btn-info" id="exportar" type="button">
						<span class="glyphicon glyphicon-file"></span>Exportar
					</button>
				</div>
				
				<?php } ?>
			</div>
	    </div>
  	</div>
</div>
<!-- Fim de Modos de Exibição -->
	

<?php $class = (isset($layout)) ? $layout : 'table'; ?>

<!-- listagem dos itens -->
<div id="div_layout" class="<?php echo $class;?>">
	<div id="indices" class="clear">
		<?php $this->load->view( ADMIN_VIEW.'layouts/listagem'); ?>
		<div class="clear"></div>
	</div>
</div>
<!-- Fim da listagem dos itens -->

<?php
if(isset($idiomas)){
	echo '<script>';
	foreach($itens as $item){	
		if( $item['id_idioma'] != '' ){
			echo '$("#item'.$item['id'].'").insertAfter("#item'.$item['id_idioma'].'");';
		}
	}
	echo '</script>';
}
?>

<!-- Modal para uso do campo button -->
<div class="modal fade" id="modalButton" tabindex="-1" role="dialog" aria-labelledby="modalButtonLabel" aria-hidden="true" style="width: auto;overflow: scroll;">
 	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h4 class="modal-title" id="modalButtonLabel">Dados</h4>
      		</div>
      		<div class="modal-body"></div>
      		<div class="modal-footer">
				<button type="button" id="btn_fechar_modalButton" class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
			</div>
   		</div>
 	</div>
</div>
<!-- Modal para uso do campo button -->

<!-- Modal de exportação de dados -->
<div class="modal fade" id="modalDownload" tabindex="-1" role="dialog" aria-labelledby="modalDownloadLabel" aria-hidden="true">
 	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h4 class="modal-title" id="modalDownloadLabel">Download</h4>
      		</div>
      		<div class="modal-body"></div>
      		<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
			</div>
   		</div>
 	</div>
</div>
<!-- Fim do modal de exportação de dados -->

<div class='clear'></div>

<script>
	$(document).ready(function(){
		$.fn.editable.defaults.mode = 'inline';

		$('.edit').editable({emptytext: 'Vazio'});

		$('body').delegate(".editable-submit", "click", function(e) {	
			tinyMCE.triggerSave();	
		});
		
		$('body').delegate(".showLanguages", "click", function(e){
			e.preventDefault();
			id = this.id;
			$('.'+id).toggleClass('hide');	
		});
		
		$('body').delegate(".addLanguage", "click", function(e){	
			e.preventDefault();
			$('#id_idioma').val($(this).data('id'));
		});


		/**********************************
			CONFIGURAÇÕES PARA FILTROS
		***********************************/

		$('.modos_exibicao').each(function(){
			$(this).multiselect({
				buttonWidth: $(this).data('width'),
				onChange: function(event){
					listarDados($(this));
				}
			});
		});

		$('.select_filtros').each(function(){
			$(this).multiselect({
				buttonWidth: '155px',
			});
		});

		<?php	    
	    foreach($filtro as $item){
	    	
	    	if($item['type'] == 'like'){
				echo "info['".$item['id']."'] = new Array($('#filter_".$item['id']."').val(),'".$item['field']."','".$item['type']."','".$item['id']."'); \n";
	    	}

	    	if($item['type'] == 'select'){
	    		echo "info['".$item['id']."'] = new Array( $('#filter_".$item['id']."').val(), '".$item['field']."','".$item['type']."','".$item['id']."' ); \n";	
	    	}

	    	if($item['type'] == 'date'){
	    		echo "info['data'] = new Array($('#filter_data').val(),'".$item['field']."','".$item['type']."','".$item['id']."'); \n";
	    	}
	    }	    
		?>

		//FILTRO DE CAMPO DATA
	    var cb = function(start, end, label) {
		    $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
		    $('#filter_data').val(start.format('YYYY-MM-DD') + ' 00:00:00;' + end.format('YYYY-MM-DD') + ' 23:59:59');
		}

		var optionSet1 = {
		    startDate: moment().subtract('days', 29),
		    endDate: moment().add('days',1),
		    minDate: '01/03/2014',
		    maxDate: moment(),                    
		    dateLimit: { days: 90 },
		    showDropdowns: true,
		    showWeekNumbers: true,
		    timePicker: false,
		    timePickerIncrement: 1,
		    timePicker12Hour: true,
		    ranges: {
		       'Hoje': [moment(), moment()],
		       'Ontem': [moment().subtract('days', 1), moment().subtract('days', 1)],
		       'Últimos 7 dias': [moment().subtract('days', 6), moment()],
		       'Últimos 30 dias': [moment().subtract('days', 29), moment()],
		       'Este Mês': [moment().startOf('month'), moment().endOf('month')],
		       'Mês passado': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
		    },
		    opens: 'left',
		    buttonClasses: ['btn btn-default'],
		    applyClass: 'btn-small btn-primary',
		    cancelClass: 'btn-small',
		    format: 'DD/MM/YYYY',
		    separator: ' a ',
		    locale: {
		        applyLabel: 'Escolher',
		        cancelLabel: 'Limpar',
		        fromLabel: 'De',
		        toLabel: 'até',
		        customRangeLabel: 'Escolher',
		        daysOfWeek: ['S', 'T', 'Q', 'Q', 'S', 'S','D'],
		        monthNames: ['Janeiro', 'Feveveiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
		        firstDay: 1
		    }
		};

	});
</script>
