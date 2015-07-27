<?php

class my_list{
	function list_text($data){
		$return =  '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<a href="#" id="text_'.$data['id'].'">'.$data['value'].'</a>
						<script>
							$("#text_'.$data['id'].'").editable({';
		if($data['somenteLeitura']){
			$return .= '		disabled: true,';
		}
		$return .= '			type: "text",
								mode: "inline",
								url: "'.base_url('admin/'.$data['module'].'/update').'",
								title: "'.$data['txt'].'",
								name: "'.$data['id'].'",
								pk: "'.$data['pk'].'",
								params: { type: "'.$data['type'].'" },
								ajaxOptions: { type: "post" }
							});
						</script>
					</div>';
		return $return;
	}

	function list_textarea($data){
		$return = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<a href="#" id="textarea_'.$data['id'].'">'.$data['value'].'</a>
						<script>
							$("#textarea_'.$data['id'].'").editable({';
		if($data['somenteLeitura']){
			$return .= '		disabled: true,';
		}
		$return .= '			type: "textarea",
								rows: 15,
								mode: "inline",
								url: "'.base_url('admin/'.$data['module'].'/update').'",
								title: "'.$data['txt'].'",
								name: "'.$data['id'].'",
								pk: "'.$data['pk'].'",
								tpl: "<textarea cols=\"80\"></textarea>",
								params: { type: "'.$data['type'].'" },
								ajaxOptions: { type: "post" }
							});
						</script>
					</div>';
		return $return;
		
	}

	function list_rota($data){
		$return = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<a href="#" id="rotas_'.$data['id'].'">'.$data['value'].'</a>
						<script>
							$("#rotas_'.$data['id'].'").editable({';
		if($data['somenteLeitura']){
			$return .= '		disabled: true,';
		}
		$return .= '			type: "text",
								mode: "inline",
								url: "'.base_url('admin/'.$data['module'].'/update').'",
								title: "'.$data['txt'].'",
								name: "'.$data['id'].'",
								pk: "'.$data['pk'].'",
								params: { type: "'.$data['type'].'" },
								ajaxOptions: { type: "post" }
							});
						</script>
					</div>';
		return $return;
	}

	function list_senha($data){
		$return = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<a href="#" id="senha_'.$data['id'].'">Alterar</a>
						<script>
							$("#senha_'.$data['id'].'").editable({';
		if($data['somenteLeitura']){
			$return .= '		disabled: true,';
		}
		$return .= '			type: "password",
								mode: "inline",
								url: "'.base_url('admin/'.$data['module'].'/update').'",
								title: "'.$data['txt'].'",
								name: "'.$data['id'].'",
								pk: "'.$data['pk'].'",
								params: { type: "'.$data['type'].'" },
								ajaxOptions: { type: "post" }
							});
						</script>
					</div>';
		return $return;
	}

	function list_tags($data){
		$tag_list = str_replace(',', ', ', $data['value']);
		$return = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<a href="#" id="tags_'.$data['id'].'" >'.$tag_list.'</a>
						<script>
							$("#tags_'.$data['id'].'").editable({';
		if($data['somenteLeitura']){
			$return .= '		disabled: true,';
		}
		$return .= '			type: "select2",
								select2: { tags: [], width: "515px", formatNoMatches: "", containerCssClass: "form-control"},
								mode: "inline",
								url: "'.base_url('admin/'.$data['module'].'/update').'",
								title: "'.$data['txt'].'",
								name: "'.$data['id'].'",
								pk: "'.$data['pk'].'",
								params: { type: "'.$data['type'].'" },
								ajaxOptions: { type: "post" }
							});
						</script>
					</div>';
		return $return;
	}

	function list_wys($data){
		$return = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<div class="wys" id="wys_'.$data['id'].'">'.$data['value'].'</div>
						<script>
							var '.$data['id'].'_html = "'.str_replace('"','\"',preg_replace('/\s/',' ',$data['value'])).'"; 

							$("#wys_'.$data['id'].'").editable({';
		if($data['somenteLeitura']){
			$return .= '		disabled: true,';
		}
		$return .= '			type: "wysihtml5",
								mode: "inline",
								onblur: "ignore",
								url: "'.base_url('admin/'.$data['module'].'/update').'",
								title: "'.$data['txt'].'",
								name: "'.$data['id'].'",
								pk: "'.$data['pk'].'",
								params: { type: "'.$data['type'].'" },
								ajaxOptions: { type: "post" }
							});

							$("#wys_'.$data['id'].'").on("shown", function(e, editable){
								$("#wys_'.$data['id'].'").focus();
								$(".editable-input textarea").val('.$data['id'].'_html);
								tinymce.init({ 
									selector: ".editable-input textarea",
									theme: "modern", 
									width: 515, 
									height: 300, 
									plugins: [ 
										"advlist autolink link image lists charmap print preview hr anchor pagebreak save code",
										"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking", 
										"table contextmenu directionality emoticons paste textcolor responsivefilemanager" 
									],
									menubar: "format",
									toolbar1: "formatselect undo redo | bold italic underline  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager | link unlink | removeformat | preview | code",
									image_advtab: true,
									external_filemanager_path: "../assets/js/filemanager/",
									style_formats: [
										{title: "Sub-título", selector: "h3",  classes:"faixa-verde"},
										{title: "pre-tag", selector: "p", classes: "pre-tag"}
									], 
									filemanager_title: "Responsive Filemanager",
									external_plugins: { "filemanager" : "../filemanager/plugin.min.js"} 
								});
							});
							
							$("#wys_'.$data['id'].'").on("save", function(e, params){
								'.$data['id'].'_html = params.newValue;
								$("#wys_'.$data['id'].'").html("");
							});
							
							$("#wys_'.$data['id'].'").on("hidden", function(e, reason){
								if(reason === "save"){
									$("#wys_'.$data['id'].'").html('.$data['id'].'_html);
								}
							});
						</script>
					</div>';
		return $return;
	}

	function list_image($data, $n_images){
		$image_path = ($data['value'] == '') ? base_url('assets/img/bootstrap/noimage.gif') : base_url('uploads/'.$data['module'].'/'.$data['value']);

		$return = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<div id="list_images_'.$data['id'].'" class="list_images">

							<div id="image_thumb_'.$data['id'].'" class="thumbnail">
								<img id="thumb_'.$data['id'].'" style="max-width:135px; max-height: 100px;" src="'.$image_path.'" />
							</div>';

		if($data['somenteLeitura']){
			$return .= '</div>';
		}
		else{
			$return .= '	<div id="image_actions_'.$data['id'].'" class="hide">
								<button id="image_btn_alterar_'.$data['id'].'" class="btn btn-success alterar_image" type="button"> Alterar Imagem </button>
								<button id="image_btn_remover_'.$data['id'].'" class="btn btn-danger remover_image" type="button"> Remover </button>
							</div>
						</div>
						<div id="image_upload_'.$data['id'].'" class="upload_image hide">
							<input id="images_'.$data['id'].'" type="hidden" value="" />
						    <div id="image_upload_area_'.$data['id'].'" class="upimage">
								<span id="message_'.$data['id'].'" class="message">Arraste as imagens para esta área</span>
						    </div>
						    <div id="arquivos_'.$data['id'].'"></div>
							<button id="image_upload_btn_cancelar_'.$data['id'].'" class="btn btn-warning cancelar_upload_image" type="button"> Cancelar </button>
						</div>
						<script>
							var message_'.$data['id'].' = $("#message_'.$data['id'].'");
							var template_'.$data['id'].' = "<div class=\"preview\">"+
																"<span class=\"imageHolder\">"+
																	"<img />"+
																	"<span class=\"uploaded\"></span>"+
																"</span>"+
																"<div class=\"progressHolder\">"+
																	"<div class=\"progress\"></div>"+
																"</div>"+
															"</div>";

							var filedrop_'.$data['id'].' = $("#image_upload_area_'.$data['id'].'");

							filedrop_'.$data['id'].'.filedrop({
								url: "'. base_url('admin/'.$data['module'].'/upload').'",
								paramname: "pic",
								allowedfiletypes: ["image/jpeg", "image/png", "image/gif"],
								allowedfileextensions: [".jpg", ".jpeg", ".png", ".gif"],
								maxfiles: '.$n_images.',
								maxfilesize: 20, //MB
								error: function(err, file) {
									switch(err) {
										case "BrowserNotSupported":
											alert("browser does not support HTML5 drag and drop");
											break;
										case "TooManyFiles":
											alert("Numero de imagens excedido. Enviar somente " + this.maxfiles + " por vez.");
											break;
										case "FileTooLarge":
											alert(file.name+" é muito grande. Enviar arquivos menores que " + this.maxfilesize + "MB.");
											break;
										case "FileTypeNotAllowed":
											alert("O tipo de arquivo de \""+ file.name +"\" não é aceito.");
											break;
										case "FileExtensionNotAllowed":
											alert("A extensão do arquivo \""+ file.name +"\" não é aceita.");
											break;
										default:
											break;
								    }
								},
								beforeEach: function(file){
									if(!file.type.match(/^image\//)){
										alert("É permitido somente o envio de imagens!");
										return false;
									}
								},

								uploadStarted: function(i, file, len){
									var preview = $(template_'.$data['id'].');
									var image = $("img", preview);
										
									var reader = new FileReader();
									
									image.width = 100;
									image.height = 100;
									
									reader.onload = function(e){
										image.attr("src",e.target.result);
									};
									
									reader.readAsDataURL(file);
									
									message_'.$data['id'].'.hide();
									preview.appendTo(filedrop_'.$data['id'].');
									
									$.data(file,preview);
				
								},

								progressUpdated: function(i, file, progress){
									$.data(file).find(".progress").width(progress+"%");
								},
								
								uploadFinished: function(i, file, response, time){
									var file_uploaded = response.file;

									if($("#image_upload_'.$data['id'].' #images_'.$data['id'].'").val() == ""){
										$("#image_upload_'.$data['id'].' #images_'.$data['id'].'").val(file_uploaded);
									}
									else{
										$("#image_upload_'.$data['id'].' #images_'.$data['id'].'").val($("#image_upload_'.$data['id'].' #images_'.$data['id'].'").val() + ";" + file_uploaded);
									}
								},

								afterAll: function(){
									var images = $("#image_upload_'.$data['id'].' #images_'.$data['id'].'").val();

		    						$("#image_upload_area_'.$data['id'].' .preview").remove();
								    $("#image_upload_area_'.$data['id'].' #message_'.$data['id'].'").removeAttr("style");
								    $("#image_upload_area_'.$data['id'].'").removeAttr("style");

									$.ajax({
								        url: "'.base_url('admin/'.$data['module'].'/update').'",
								        type: "POST",
								        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
								        data: { name: "'.$data['id'].'", pk: "'.$data['pk'].'", value: images, type: "'.$data['type'].'"},
								        dataType: "html",
								        success: function(data){
								        	if(data == "true"){
									           	console.log(images + " gravado com sucesso.");
										        $("#list_images_'.$data['id'].'").removeClass("hide");
									    		$("#image_upload_'.$data['id'].'").addClass("hide");
									    		$("#thumb_'.$data['id'].'").attr("src", "'.base_url('uploads/'.$data['module']).'/" + images);
									        }
									        else{
									           console.log("Erro ao gravar a imagem");
									        }
								        }
								    });
								}
							});

							$(".modal-bloco").delegate("#image_thumb_'.$data['id'].'", "click", function(e){
								if($("#image_actions_'.$data['id'].'").hasClass("hide")){
									$("#image_actions_'.$data['id'].'").removeClass("hide");
								}
								else{
									$("#image_actions_'.$data['id'].'").addClass("hide");
								}
							});
							
							$(".modal-bloco").delegate("#image_btn_alterar_'.$data['id'].'", "click", function(e){
								$("#images_'.$data['id'].'").val("");

								$("#list_images_'.$data['id'].'").addClass("hide");
								$("#image_actions_'.$data['id'].'").addClass("hide");
								$("#image_upload_'.$data['id'].'").removeClass("hide");
							});

							$(".modal-bloco").delegate("#image_upload_btn_cancelar_'.$data['id'].'", "click", function(e){
								$("#list_images_'.$data['id'].'").removeClass("hide");
								$("#image_upload_'.$data['id'].'").addClass("hide");
							});

							$(".modal-bloco").delegate("#image_btn_remover_'.$data['id'].'","click", function(e){
								$("#images_'.$data['id'].'").val("");

								$.ajax({
							        url: "'.base_url('admin/'.$data['module'].'/update').'",
							        type: "POST",
							        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
							        data: { name: "'.$data['id'].'", pk: "'.$data['pk'].'", value: "", type: "'.$data['type'].'"},
							        dataType: "html",
							        success: function(data){
							            $("#thumb_'.$data['id'].'").attr("src", "'.base_url('assets/img/bootstrap/noimage.gif').'");
							            $("#list_images_'.$data['id'].'").removeClass("hide");
										$("#image_upload_'.$data['id'].'").addClass("hide");
										$("#image_actions_'.$data['id'].'").addClass("hide");
							        }
							    });
							});
							
						</script>';
		}
		$return .= '</div>';
		return $return;
	}

	function list_galeria($data){
		$return = '<h3>'.$data['txt'].'</h3>';

		if($data['somenteLeitura']){
			$return .= '<div id="lista_imagens_'.$data['id'].'"></div>
						<script>
							$(".modal-bloco").delegate("#galeria", "click", function(e){
								e.preventDefault();
								$.ajax({
									url: "'.base_url('galeria/listar_somente_leitura').'",
									type: "POST",
									contentType: "application/x-www-form-urlencoded; charset=UTF-8",
									data: { module: "'.$data['module'].'", id: "'.$data['pk'].'" },
									dataType: "html",
									success: function(data) {
										if(data != "false"){
											$("#lista_imagens_'.$data['id'].'").html(data);
										}
									}
								});
							});
						</script>';
		}
		else{
			$return .=	'<div class="panel panel-default">
							<div class="well">
						    	<form id="form_'.$data['id'].'" method="post" action="'.base_url('galeria/upload').'" enctype="multipart/form-data">
									<input type="hidden" name="module" value="'.$data['module'].'"/>
									<input type="hidden" name="id" value="'.$data['pk'].'"/>
									<table>
										<tr>
										 	<td>
												<span class="btn btn-success fileinput-button">
		 											<i class="glyphicon glyphicon-plus"></i>
		    										<span>Adicionar imagens...</span>
		    										<input id="images_'.$data['id'].'" type="file" name="images_'.$data['id'].'[]" multiple/>
												</span>
											</td>
											<td>
												<button id="btn_enviar_'.$data['id'].'" class="btn btn-success btn-mini" type="button">
													<i class="icon-ok-sign icon-white"></i>Enviar
												</button>
												<label id="tot_files_'.$data['id'].'"></label>
											</td>
										</tr>
									</table>
								</form>
								<div id="progess-bar_area_'.$data['id'].'" class="progress hide">
									<div id="progress-bar_'.$data['id'].'" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"> 0% </div>
								</div>
							</div>
							<div id="lista_imagens_'.$data['id'].'"></div>
							<script>
								$("#btn_enviar_'.$data['id'].'").click(function(){
									if($("#images_'.$data['id'].'").val() == ""){
										alert("Escolha um arquivo antes de enviar");
									}
									else{
										$("#form_'.$data['id'].'").submit();
									}
								});

								$("#images_'.$data['id'].'").on("change", function(){
									var length = $("#images_'.$data['id'].'")[0].files.length;
									
									if(length == 0){
										$("#tot_files_'.$data['id'].'").html("");
									}
									else if(length == 1){
										$("#tot_files_'.$data['id'].'").html("1 imagem selecionada");
									}
									else if(length > 1 && length < 20){
										$("#tot_files_'.$data['id'].'").html(length+" imagens selecionadas");
									}
									else{
										$("#tot_files_'.$data['id'].'").html("20 imagens selecionadas");
									}
								});

								$("#form_'.$data['id'].'").ajaxForm({
									beforeSend: function() {
										$("#tot_files_'.$data['id'].'").html("");
										$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", 0);
										$("#progress-bar_'.$data['id'].'").css("width", 0+"%");
										$("#progress-bar_'.$data['id'].'").html("0%");
										$("#progess-bar_area_'.$data['id'].'").removeClass("hide");
									},
									uploadProgress: function(event, position, total, percentComplete) {
										$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", percentComplete);
										$("#progress-bar_'.$data['id'].'").css("width", percentComplete+"%");
										$("#progress-bar_'.$data['id'].'").html(percentComplete+"%")
									},
									success: function() {
										$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", 100);
										$("#progress-bar_'.$data['id'].'").css("width", 100+"%");
										$("#progress-bar_'.$data['id'].'").html("100%");
									},
									complete: function(xhr) {
										$("#progess-bar_area_'.$data['id'].'").addClass("hide");
										$("#images_'.$data['id'].'").val("");
										$("#galeria").trigger("click");
									}
								});

								$(".modal-bloco").delegate("#galeria", "click", function(e){
									e.preventDefault();
									$.ajax({
										url: "'.base_url('galeria/listar').'",
										type: "POST",
										contentType: "application/x-www-form-urlencoded; charset=UTF-8",
										data: { module: "'.$data['module'].'", id: "'.$data['pk'].'" },
										dataType: "html",
										success: function(data) {
											if(data != "false"){
												$("#lista_imagens_'.$data['id'].'").html(data);
											}
										}
									});
								});
								
								$(".modal-bloco").delegate(".delete_galeria", "click", function(e){
								    e.preventDefault();
								    var id = $(this).data("id");
								    
								    $.ajax({
								        url: "'.base_url('galeria/delete').'",
								        type: "POST",
								        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
								        data: { id: id },
								        dataType: "html",
								        success: function(data){
								            $("#galeria").trigger("click");
								        }
								    });
								});
							</script>

						</div>';
		}
		return $return;
	}

	function list_repositorio($data){
		$return = ' <div>
						<h3>'.$data['txt'].'</h3>
					</div>';


		if($data['somenteLeitura']){
			$return .= '<div id="lista_arquivos_'.$data['id'].'"></div>
						<script>
							$(".modal-bloco").delegate("#repositorio", "click", function(e){
								e.preventDefault();
								$.ajax({
									url: "'.base_url('upload/listar_repositorio_somente_leitura').'",
									type: "POST",
									contentType: "application/x-www-form-urlencoded; charset=UTF-8",
									data: { module: "'.$data['module'].'", id: "'.$data['pk'].'" },
									dataType: "html",
									success: function(data) {
										if(data != "false"){
											$("#lista_arquivos_'.$data['id'].'").html(data);
										}
									}
								});
							});
						</script>';
		}
		else{
			$return .=	'<div class="panel panel-default">
							<div class="well">
						    	<form id="form_'.$data['id'].'" method="post" action="'.base_url('/upload/upload_repositorio').'" enctype="multipart/form-data">
									<input type="hidden" name="module" value="'.$data['module'].'"/>
									<input type="hidden" name="id" value="'.$data['pk'].'"/>
									<table>
										<tr>
										 	<td>
												<span class="btn btn-success fileinput-button">
		 											<i class="glyphicon glyphicon-plus"></i>
		    										<span>Adicionar imagens...</span>
		    										<input id="files_'.$data['id'].'" type="file" name="files_'.$data['id'].'[]" multiple/>
												</span>
											</td>
											<td>
												<button id="btn_enviar_'.$data['id'].'" class="btn btn-success btn-mini" type="button">
													<i class="icon-ok-sign icon-white"></i>Enviar
												</button>
												<label id="tot_files_'.$data['id'].'"></label>
											</td>
										</tr>
									</table>
								</form>
								<div id="progess-bar_area_'.$data['id'].'" class="progress hide">
									<div id="progress-bar_'.$data['id'].'" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"> 0% </div>
								</div>
							</div>
							<div id="lista_arquivos_'.$data['id'].'"></div>
						</div>
						<script>
							$("#btn_enviar_'.$data['id'].'").click(function(){
								if($("#files_'.$data['id'].'").val() == ""){
									alert("Escolha um arquivo antes de enviar");
								}
								else{
									$("#form_'.$data['id'].'").submit();
								}
							});

							$("#form_'.$data['id'].'").ajaxForm({
								beforeSend: function(){
									$("#tot_files_'.$data['id'].'").html("");
									$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", 0);
									$("#progress-bar_'.$data['id'].'").css("width", 0+"%");
									$("#progress-bar_'.$data['id'].'").html("0%");
									$("#progess-bar_area_'.$data['id'].'").removeClass("hide");
								},
								uploadProgress: function(event, position, total, percentComplete) {
									$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", percentComplete);
									$("#progress-bar_'.$data['id'].'").css("width", percentComplete+"%");
									$("#progress-bar_'.$data['id'].'").html(percentComplete+"%")
								},
								success: function() {
									$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", 100);
									$("#progress-bar_'.$data['id'].'").css("width", 100+"%");
									$("#progress-bar_'.$data['id'].'").html("100%");
								},
								complete: function(xhr){
									$("#files_'.$data['id'].'").val("");
									$("#progess-bar_area_'.$data['id'].'").addClass("hide");
									$("#repositorio").trigger("click");
								}
							});

							$("#files_'.$data['id'].'").on("change", function(){
								var length = $("#files_'.$data['id'].'")[0].files.length;
								
								if(length == 0){
									$("#tot_files_'.$data['id'].'").html("");
								}
								else if(length == 1){
									$("#tot_files_'.$data['id'].'").html("1 arquivo selecionado");
								}
								else if(length > 1 && length < 20){
									$("#tot_files_'.$data['id'].'").html(length+" arquivos selecionados");
								}
								else{
									$("#tot_files_'.$data['id'].'").html("20 arquivos selecionados");
								}
							});

	 						$(".modal-bloco").delegate("#repositorio", "click", function(e){
								e.preventDefault();
								$.ajax({
									url: "'.base_url('upload/listar_repositorio').'",
									type: "POST",
									contentType: "application/x-www-form-urlencoded; charset=UTF-8",
									data: { module: "'.$data['module'].'", id: "'.$data['pk'].'" },
									dataType: "html",
									success: function(data) {
										if(data != "false"){
											$("#lista_arquivos_'.$data['id'].'").html(data);
										}
									}
								});
							});

							$(".modal-bloco").delegate(".deleteFile_repositorio", "click", function(e){
								e.preventDefault();

								var id = $(this).data("id");

								$.ajax({
									url: "'.base_url('upload/delete_repositorio').'",
									type: "POST",
									contentType: "application/x-www-form-urlencoded; charset=UTF-8",
									data: { id: id },
									dataType: "html",
									success: function(data) {
										$("#repositorio").trigger("click");
									}
								});
							});
						</script>';
		}
		return $return;
	}

	function list_upload($data, $n_files){
		$qtdeAtual = ($data['value'] == '') ? 0 : sizeof(explode(';', $data['value']));
		$qtdeDisponivel = $n_files - $qtdeAtual;

		$return = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<div class="panel panel-default">';

		if($data['somenteLeitura']){
			$return .= '	<div id="lista_arquivos_upload_'.$data['id'].'"></div>
						</div>
						<script>
							$("#lista_arquivos_upload_'.$data['id'].'").ready(function(){
								$(".modal-bloco").delegate("#lista_arquivos_upload_'.$data['id'].'", "listar", function(e){
									$.ajax({
										url: "'.base_url('upload/listar_somente_leitura').'",
										type: "POST",
										contentType: "application/x-www-form-urlencoded; charset=UTF-8",
										data: { id: "'.$data['pk'].'", field: "'.$data['id'].'", module: "'.$data['module'].'" },
										dataType: "html",
										success: function(data) {
											$("#lista_arquivos_upload_'.$data['id'].'").html(data);
										}
									});
								});
							   	$("#lista_arquivos_upload_'.$data['id'].'").trigger("listar");
							});
						</script>';
		}
		else{
			$return .= '	<div class="well" style="margin: 0px;"> 						
								<form id="form_upload_'.$data['id'].'" action="'.base_url('upload').'" method="post" enctype="multipart/form-data">
									<input type="hidden" name="id" value="'.$data['pk'].'">
									<input type="hidden" name="field" value="'.$data['id'].'"/>
									<input type="hidden" name="module" value="'.$data['module'].'"/>
									<table>
										<tr>
											<td>
												<span id="btn_file_'.$data['id'].'" class="btn btn-success fileinput-button" data-nfiles="'.$n_files.'" data-qtdeatual="'.$qtdeAtual.'" data-qtdedisponivel="'.$qtdeDisponivel.'">
		 											<i class="glyphicon glyphicon-plus"></i>
		    										<span>Adicionar imagens...</span>
		    										<input id="files_upload_'.$data['id'].'" type="file" name="files_upload_'.$data['id'].'[]" multiple/>
												</span>
											</td>
											<td>
												<button id="btn_enviar_'.$data['id'].'" class="btn btn-success btn-mini" type="button">
													<i class="icon-ok-sign icon-white"></i>Enviar
												</button>
												<label id="tot_files_'.$data['id'].'"></label>
											</td>
										</tr>
									</table>
								</form>
								<div id="progess-bar_area_'.$data['id'].'" class="progress hide">
									<div id="progress-bar_'.$data['id'].'" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"> 0% </div>
								</div>
							</div>
							<div id="lista_arquivos_upload_'.$data['id'].'">
								
							</div>
					   </div>
					   <script>
					   		$("#lista_arquivos_upload_'.$data['id'].'").ready(function(){
					   			checarUpload($("#btn_file_'.$data['id'].'"), $("#btn_enviar_'.$data['id'].'"));

					   			console.log("Maximo: "+parseInt($("#btn_file_'.$data['id'].'").data("nfiles")));
					   			console.log("Atual: "+parseInt($("#btn_file_'.$data['id'].'").data("qtdeatual")));
					   			console.log("Disponível: "+parseInt($("#btn_file_'.$data['id'].'").data("qtdedisponivel")));

								$(".modal-bloco").delegate("#form_upload_'.$data['id'].'", "listar", function(e){
									$.ajax({
										url: "'.base_url('upload/listar').'",
										type: "POST",
										contentType: "application/x-www-form-urlencoded; charset=UTF-8",
										data: { id: "'.$data['pk'].'", field: "'.$data['id'].'", module: "'.$data['module'].'" },
										dataType: "html",
										success: function(data) {
											$("#lista_arquivos_upload_'.$data['id'].'").html(data);
										}
									});
								});
		
						   		$("#form_upload_'.$data['id'].'").trigger("listar");

								$(".modal-bloco").delegate(".deleteFile_upload_'.$data['id'].'", "click", function(e) {
									var file = $(this).data("file");
									
									$.ajax({
										url: "'.base_url('upload/delete').'",
										type: "POST",
										contentType: "application/x-www-form-urlencoded; charset=UTF-8",
										data: { id: "'.$data['pk'].'", field: "'.$data['id'].'", module: "'.$data['module'].'", file: file },
										dataType: "html",
										success: function(data) {
											$("#form_upload_'.$data['id'].'").trigger("listar");

											var qtdeAtual = parseInt($("#btn_file_'.$data['id'].'").data("qtdeatual")) - 1;
											var qtdeDisponivel = parseInt($("#btn_file_'.$data['id'].'").data("qtdedisponivel")) + 1;
											
											$("#btn_file_'.$data['id'].'").data("qtdeatual", qtdeAtual);
											$("#btn_file_'.$data['id'].'").data("qtdedisponivel", qtdeDisponivel);

											checarUpload($("#btn_file_'.$data['id'].'"), $("#btn_enviar_'.$data['id'].'"));

								   			console.log("Maximo: "+parseInt($("#btn_file_'.$data['id'].'").data("nfiles")));
								   			console.log("Atual: "+parseInt($("#btn_file_'.$data['id'].'").data("qtdeatual")));
								   			console.log("Disponível: "+parseInt($("#btn_file_'.$data['id'].'").data("qtdedisponivel")));
										}
									});
								});

								$("#files_upload_'.$data['id'].'").on("change", function(){
									var length = $("#files_upload_'.$data['id'].'")[0].files.length;
									
									if(length == 0){
										$("#tot_files_'.$data['id'].'").html("");
									}
									else if(length == 1){
										$("#tot_files_'.$data['id'].'").html("1 arquivo selecionado");
									}
									else if(length > 1 && length < 20){
										$("#tot_files_'.$data['id'].'").html(length+" arquivos selecionados");
									}
									else{
										$("#tot_files_'.$data['id'].'").html("20 arquivos selecionados");
									}
								});

								$("#btn_enviar_'.$data['id'].'").click(function(){
									if($("#files_upload_'.$data['id'].'").val() == ""){
										alert("Escolha um arquivo antes de enviar");
									}
									else{
										var length = $("#files_upload_'.$data['id'].'")[0].files.length;
										var qtdeDisponivel = parseInt($("#btn_file_'.$data['id'].'").data("qtdedisponivel"));

										if(length > qtdeDisponivel){
											alert("O total selecionado excede o maximo permitido.");
										}
										else{
											var qtdeAtual = parseInt($("#btn_file_'.$data['id'].'").data("qtdeatual")) + length;
											var qtdeDisponivel = parseInt($("#btn_file_'.$data['id'].'").data("qtdedisponivel")) - length;

											$("#btn_file_'.$data['id'].'").data("qtdeatual", qtdeAtual);
											$("#btn_file_'.$data['id'].'").data("qtdedisponivel", qtdeDisponivel);
											
											$("#form_upload_'.$data['id'].'").submit();
										}	
									}
								});

								$("#form_upload_'.$data['id'].'").ajaxForm({
									beforeSend: function(){
										$("#tot_files_'.$data['id'].'").html("");
										$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", 0);
										$("#progress-bar_'.$data['id'].'").css("width", "0%");
										$("#progress-bar_'.$data['id'].'").html("0%");
										$("#progess-bar_area_'.$data['id'].'").removeClass("hide");
									},
									uploadProgress: function(event, position, total, percentComplete) {
										$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", percentComplete);
										$("#progress-bar_'.$data['id'].'").css("width", percentComplete+"%");
										$("#progress-bar_'.$data['id'].'").html(percentComplete+"%");
									},
									success: function() {
										$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", 100);
										$("#progress-bar_'.$data['id'].'").css("width", "100%");
										$("#progress-bar_'.$data['id'].'").html("100%");
									},
									complete: function(xhr) {
										$("#progess-bar_area_'.$data['id'].'").addClass("hide");
										$("#files_upload_'.$data['id'].'").val("");
										$("#form_upload_'.$data['id'].'").trigger("listar");

										checarUpload($("#btn_file_'.$data['id'].'"), $("#btn_enviar_'.$data['id'].'"));

							   			console.log("Maximo: "+parseInt($("#btn_file_'.$data['id'].'").data("nfiles")));
							   			console.log("Atual: "+parseInt($("#btn_file_'.$data['id'].'").data("qtdeatual")));
							   			console.log("Disponível: "+parseInt($("#btn_file_'.$data['id'].'").data("qtdedisponivel")));
									}
								});
							});
						</script>';
		}
		$return .= '</div>';
		return $return;
	}

	function list_onoff($data){
		$checked = ($data['value'] == '1') ? 'checked' : '';
		$return  = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<input type="checkbox" id="onoff_'.$data['id'].'" '.$checked.'/>
						<script>
							$("#onoff_'.$data['id'].'").bootstrapSwitch({';
		if($data['somenteLeitura']){
			$return .= '		disabled: true,';
		}
		$return .= '			onColor: "success",
								offColor: "danger",
								onText: "Sim",
								offText: "Não"
							});';
		
		if(!$data['somenteLeitura']){
			$return .= '	$("#onoff_'.$data['id'].'").on("switchChange.bootstrapSwitch", function (e, data) {
								var value = $("#onoff_'.$data['id'].'").bootstrapSwitch("state");
								value = (value == true) ? "1" : "0";
								
								$.ajax({
									url: "'.base_url('admin/'.$data['module'].'/update').'",
									type: "POST",
									contentType: "application/x-www-form-urlencoded; charset=UTF-8",
									data: { name: "'.$data['id'].'", value: value, pk: "'.$data['pk'].'", type: "'.$data['type'].'" },
									dataType: "html",
									success: function(data) {
										if(data != "true"){
											console.log("Erro: " + data);
										}
									}
								});
							});';
		}
							
		$return .= '	</script>
					</div>';
		return $return;	
	}

	function list_sexo($data){
		$checked = ($data['value'] == 'M') ? 'checked' : '';
		$return  = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<input type="checkbox" id="sexo_'.$data['id'].'" '.$checked.'/>
						<script>
							$("#sexo_'.$data['id'].'").bootstrapSwitch({';
		if($data['somenteLeitura']){
			$return .= '		disabled: true,';
		}
		$return .= '			onColor: "info",
								offColor: "warning",
								onText: "M",
								offText: "F"
							});';
		
		if(!$data['somenteLeitura']){
			$return .= '	$("#sexo_'.$data['id'].'").on("switchChange.bootstrapSwitch", function (e, data) {
								var value = $("#sexo_'.$data['id'].'").bootstrapSwitch("state");
								value = (value == true) ? "M" : "F";

								$.ajax({
									url: "'.base_url('admin/'.$data['module'].'/update').'",
									type: "POST",
									contentType: "application/x-www-form-urlencoded; charset=UTF-8",
									data: { name: "'.$data['id'].'", value: value, pk: "'.$data['pk'].'", type: "'.$data['type'].'" },
									dataType: "html",
									success: function(data) {
										if(data != "true"){
											console.log("Erro: " + data);
										}
									}
								});
							});';
		}
							
		$return .= '	</script>
					</div>';
		return $return;
	}

	function list_date($data){
		$return = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<a id="date_'.$data['id'].'">'.$data['value'].'</a>
					   	<script>';

	    if($data['somenteLeitura']){
	    	$return .= '	$("#date_'.$data['id'].'").editable({
	    						disabled: true
							});';
	    }
	    else{
	    	$return .= '   	var date_'.$data['id'].'_newValue;

							$("#date_'.$data['id'].'").editable({
								type: "text",
								mode: "inline",
								url: "'.base_url('admin/'.$data['module'].'/update').'",
								title: "'.$data['txt'].'",
								name: "'.$data['id'].'",
								pk: "'.$data['pk'].'",
								params: { type: "'.$data['type'].'" },
								ajaxOptions: { type: "post" }
							});

							$("#date_'.$data['id'].'").on("shown", function(e, editable){
								$("#date_'.$data['id'].'").focus();
								$(".editable-input input[type=text]").val("'.$data['value'].'");

								$(".editable-input input[type=text]").datepicker({
								    format: "yyyy/mm/dd",
								    weekStart: 0,
								    todayBtn: "linked",
								    language: "pt-BR",
								    keyboardNavigation: false,
								    forceParse: false,
								    autoclose: true,
								    todayHighlight: true
								});
								
							});
							
							$("#date_'.$data['id'].'").on("save", function(e, params){
								date_'.$data['id'].'_newValue = params.newValue;
								$("#date_'.$data['id'].'").html("");
							});
							
							$("#date_'.$data['id'].'").on("hidden", function(e, reason){
								if(reason === "save"){
									$("#date_'.$data['id'].'").html(date_'.$data['id'].'_newValue);
								}
							});';
	    }

		$return .= '	</script>
	        	   </div>';
		return $return;
	}

	function list_time($data){
		$return = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<a id="time_'.$data['id'].'">'.$data['value'].'</a>
	        		   	<script>';

	    if($data['somenteLeitura']){
	    	$return .= '	$("#time_'.$data['id'].'").editable({
	    						disabled: true
							});';
	    }
	    else{
	    	$return .= '   	var time_'.$data['id'].'_newValue;

							$("#time_'.$data['id'].'").editable({
								type: "text",
								mode: "inline",
								url: "'.base_url('admin/'.$data['module'].'/update').'",
								title: "'.$data['txt'].'",
								name: "'.$data['id'].'",
								pk: "'.$data['pk'].'",
								params: { type: "'.$data['type'].'" },
								ajaxOptions: { type: "post" }
							});
							
							$("#time_'.$data['id'].'").on("shown", function(e, editable){
								$("#time_'.$data['id'].'").focus();
								
								$(".editable-input").addClass("bootstrap-timepicker");
								$(".editable-input input[type=text]").addClass("input-small");
								$(".editable-input input[type=text]").val("'.$data['value'].'");
								$(".editable-input input[type=text]").timepicker({
					                minuteStep: 5,
					                showInputs: false,
					                showMeridian: false,
					                disableFocus: true
					            });
								
							});
							
							$("#time_'.$data['id'].'").on("save", function(e, params){
								time_'.$data['id'].'_newValue = params.newValue;
								$("#time_'.$data['id'].'").html("");
							});
							
							$("#time_'.$data['id'].'").on("hidden", function(e, reason){
								if(reason === "save"){
									$("#time_'.$data['id'].'").html(time_'.$data['id'].'_newValue);
								}
							});';
	    }

		$return .= '	</script>
	        	   </div>';
		return $return;
	}

	function list_video($data, $origem){
		$return = '	<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>';

		switch($origem){
			case 'youtube':
				$id_video = ($data['value'] != '') ? array_pop(explode('v=', $data['value'])) : '';

				if($data['somenteLeitura']){
					$return .= '<div id="video_embed_'.$data['id'].'">';

					if($id_video != ''){
						$return .= '<iframe width="600" height="336" src="http://www.youtube.com/embed/'.$id_video.'" frameborder="0" allowfullscreen></iframe>';
					}
					else{
						$return .= '<p>Nenhum vídeo cadastrado</p>';
					}

					$return .= '</div>';	
				}
				else{
					$return .= '<div id="video_link_div_'.$data['id'].'" class="hide">
									<a href="#" id="video_link_'.$data['id'].'">'.$data['value'].'</a>
								</div>
								<div id="video_embed_'.$data['id'].'">';

					if($id_video != ''){
						$return .= '<iframe width="600" height="336" src="http://www.youtube.com/embed/'.$id_video.'" frameborder="0" allowfullscreen></iframe>';
					}
					else{
						$return .= '<p>Nenhum vídeo cadastrado</p>';
					}

					$return .= '</div>
								<div id="video_actions_'.$data['id'].'">
									<button id="btn_alterar_'.$data['id'].'" class="btn btn-success btn-mini" type="button">
										<i class="icon-refresh icon-white"></i>Alterar
									</button>
								</div>
								<script>
									$("#video_link_'.$data['id'].'").editable({
										type: "text",
										mode: "inline",
										url: "'.base_url('admin/'.$data['module'].'/update').'",
										title: "'.$data['txt'].'",
										name: "'.$data['id'].'",
										pk: "'.$data['pk'].'",
										params: { type: "'.$data['type'].'" },
										ajaxOptions: { type: "post" },
										success: function(response, newValue){
											var id_video = newValue.split("v=").pop();
											var iframe;
											if(id_video == ""){
												iframe = "<p>Nenhum vídeo cadastrado</p>";
											}
											else{
												var link = "http://www.youtube.com/embed/" + id_video;
												iframe = "<iframe width=\"600\" height=\"336\" src=\"" + link + "\" frameborder=\"0\" allowfullscreen></iframe>";	
											}
											$("#video_embed_'.$data['id'].'").html(iframe);
										}
									});

									$("#video_link_'.$data['id'].'").on("hidden", function(e, reason){
										$("#video_link_div_'.$data['id'].'").addClass("hide");
								      	$("#video_embed_'.$data['id'].'").removeClass("hide");
								      	$("#video_actions_'.$data['id'].'").removeClass("hide");
									});

									$(".modal-bloco").delegate("#btn_alterar_'.$data['id'].'", "click", function(e) {
										$("#video_link_div_'.$data['id'].'").removeClass("hide");
										$("#video_embed_'.$data['id'].'").addClass("hide");
										$("#video_actions_'.$data['id'].'").addClass("hide");
									});
								</script>';
				}

				break;

			case 'vimeo':
				if($data['somenteLeitura']){
					$return .= '<div id="video_embed_'.$data['id'].'"></div>
								<script>
									var video_'.$data['id'].'_link = "'.$data['value'].'";

									if(video_'.$data['id'].'_link != ""){
										$.ajax({
											url: "http://vimeo.com/api/oembed.json",
											type: "GET",
											dataType: "json",
											data: {url: video_'.$data['id'].'_link, width: 600, height: 336}
										})
										.done(function(data) {
										    $("#video_embed_'.$data['id'].'").html(data.html);
										})
										.fail(function() {
											$("#video_embed_'.$data['id'].'").html("Não foi possível carregar o vídeo. Verifique se o link esta correto.");
										});
									}
									else{
										$("#video_embed_'.$data['id'].'").html("<p>Nenhum vídeo cadastrado</p>");
									}
								</script>';
				}
				else{
					$return .= '<div id="video_link_div_'.$data['id'].'" class="hide">
									<a href="#" id="video_link_'.$data['id'].'">'.$data['value'].'</a>
								</div>

								<div id="video_embed_'.$data['id'].'"></div>

								<div id="video_actions_'.$data['id'].'">
									<button id="btn_alterar_'.$data['id'].'" class="btn btn-success btn-mini" type="button">
										<i class="icon-refresh icon-white"></i>Alterar
									</button>
								</div>

								<script>
									var video_'.$data['id'].'_link = "'.$data['value'].'";
									if(video_'.$data['id'].'_link != ""){
										$.ajax({
											url: "http://vimeo.com/api/oembed.json",
											type: "GET",
											dataType: "json",
											data: {url: video_'.$data['id'].'_link, width: 600, height: 336}
										})
										.done(function(data) {
										    $("#video_embed_'.$data['id'].'").html(data.html);
										})
										.fail(function() {
											$("#video_embed_'.$data['id'].'").html("Não foi possível carregar o vídeo. Verifique se o link esta correto.");
										});
									}
									else{
										$("#video_embed_'.$data['id'].'").html("<p>Nenhum vídeo cadastrado</p>");
									}

									$("#video_link_'.$data['id'].'").editable({
										type: "text",
										mode: "inline",
										url: "'.base_url('admin/'.$data['module'].'/update').'",
										title: "'.$data['txt'].'",
										name: "'.$data['id'].'",
										pk: "'.$data['pk'].'",
										params: { type: "'.$data['type'].'" },
										ajaxOptions: { type: "post" },
										success: function(response, newValue){
											if(newValue != ""){
												$.ajax({
													url: "http://vimeo.com/api/oembed.json",
													type: "GET",
													dataType: "json",
													data: {url: newValue, width: 600, height: 336}
												})
												.done(function(data) {
												    $("#video_embed_'.$data['id'].'").html(data.html);
												})
												.fail(function() {
													$("#video_embed_'.$data['id'].'").html("Não foi possível carregar o vídeo. Verifique se o link esta correto.");
												});
											}
											else{
												$("#video_embed_'.$data['id'].'").html("<p>Nenhum vídeo cadastrado</p>");
											}
										}
									});

									$("#video_link_'.$data['id'].'").on("hidden", function(e, reason){
										$("#video_link_div_'.$data['id'].'").addClass("hide");
								      	$("#video_embed_'.$data['id'].'").removeClass("hide");
								      	$("#video_actions_'.$data['id'].'").removeClass("hide");
									});

									$(".modal-bloco").delegate("#btn_alterar_'.$data['id'].'", "click", function(e) {
										$("#video_link_div_'.$data['id'].'").removeClass("hide");
										$("#video_embed_'.$data['id'].'").addClass("hide");
										$("#video_actions_'.$data['id'].'").addClass("hide");
									});
								</script>';
				}

				break;

			case 'local':
				if($data['somenteLeitura']){
					$return .= '<div id="video_embed_'.$data['id'].'">';

					if($data['value'] != ''){
						$return .= '<video src="'.base_url('uploads/'.$data['module'].'/'.$data['value']).'" controls width="587" height="336" style="background-color: black !important;"> Your browser does not support the <code>video</code> element. </video>';
					}
					else{
						$return .= '<div>
				            			<p>Nenhum vídeo cadastrado</p>
				            		</div>';
					}

					$return .= '</div>';
				}
				else{	
					$return .= '<div class="panel panel-default">
									<div class="well" style="margin: 0px;"> 						
										<form id="form_upload_video_'.$data['id'].'" action="'.base_url('video/upload').'" method="post" enctype="multipart/form-data">
											<input type="hidden" name="id" value="'.$data['pk'].'">
											<input type="hidden" name="field" value="'.$data['id'].'"/>
											<input type="hidden" name="module" value="'.$data['module'].'"/>
											<table>
												<tr>
													<td>
														<span id="btn_upload_video_'.$data['id'].'" class="btn btn-success fileinput-button">
				 											<i class="glyphicon glyphicon-plus"></i>
				    										<span>Adicionar Vídeo</span>
				    										<input id="video_upload_'.$data['id'].'" type="file" name="video_upload_'.$data['id'].'"/>
														</span>
													</td>
													<td>
														<button id="btn_enviar_'.$data['id'].'" class="btn btn-success btn-mini" type="button">
															<i class="icon-ok-sign icon-white"></i>Enviar
														</button>
														<label id="info_video_'.$data['id'].'"></label>
													</td>
												</tr>
											</table>
										</form>
										<div id="progess-bar_area_'.$data['id'].'" class="progress hide">
											<div id="progress-bar_'.$data['id'].'" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"> 0% </div>
										</div>
									</div>
									<div id="video_embed_'.$data['id'].'">';

					if($data['value'] != ''){
						$return .= '	<video src="'.base_url('uploads/'.$data['module'].'/'.$data['value']).'" controls width="587" height="336" style="background-color: black !important;"> Your browser does not support the <code>video</code> element. </video>
										<button class="btn btn-mini btn-danger delete_video"><span class="glyphicon glyphicon-trash"></span></button>';
					}
					else{
						$return .= '	<div align="center">
				            				<p>Nenhum vídeo cadastrado</p>
				            			</div>';
					}

					$return .= '	</div>
								</div>
								<script>
			
									$("#video_upload_'.$data['id'].'").on("change", function(){
										if($(this)[0].files.length != 0){
											$("#info_video_'.$data['id'].'").html($(this)[0].files[0].name);
										}
									});

									$("#btn_enviar_'.$data['id'].'").click(function(){
										if($("#video_upload_'.$data['id'].'").val() == ""){
											alert("Escolha um vídeo antes de enviar");
										}
										else{
											$("#form_upload_video_'.$data['id'].'").submit();
										}
									});

									$("#form_upload_video_'.$data['id'].'").ajaxForm({
										beforeSend: function(){
											$("#info_video_'.$data['id'].'").html("");
											$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", 0);
											$("#progress-bar_'.$data['id'].'").css("width", "0%");
											$("#progress-bar_'.$data['id'].'").html("0%");
											$("#progess-bar_area_'.$data['id'].'").removeClass("hide");
										},
										uploadProgress: function(event, position, total, percentComplete) {
											$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", percentComplete);
											$("#progress-bar_'.$data['id'].'").css("width", percentComplete+"%");
											$("#progress-bar_'.$data['id'].'").html(percentComplete+"%");
										},
										success: function() {
											$("#progress-bar_'.$data['id'].'").attr("aria-valuenow", 100);
											$("#progress-bar_'.$data['id'].'").css("width", "100%");
											$("#progress-bar_'.$data['id'].'").html("100%");
										},
										complete: function(xhr) {
											$("#progess-bar_area_'.$data['id'].'").addClass("hide");
											$("#video_upload_'.$data['id'].'").val("");

											$("#video_embed_'.$data['id'].'").trigger("listar");
										}
									});

									$(".modal-bloco").on("listar", "#video_embed_'.$data['id'].'", function(){
										$.ajax({
											url: "'.base_url('video').'",
											type: "POST",
											dataType: "html",
											data: { module: "'.$data['module'].'", field: "'.$data['id'].'", id: "'.$data['pk'].'" }
										})
										.done(function(data) {
										 	$("#video_embed_'.$data['id'].'").html(data);   
										})
										.fail(function() {
											console.log("error");
										});
									})

									$(".modal-bloco").on("click", ".delete_video", function(){
										$.ajax({
											url: "'.base_url('video/delete').'",
											type: "POST",
											dataType: "html",
											data: { module: "'.$data['module'].'", field: "'.$data['id'].'", id: "'.$data['pk'].'" }
										})
										.done(function(data) {
										    if(data == "true"){
										    	$("#video_embed_'.$data['id'].'").trigger("listar");
										    }
										})
										.fail(function() {
											console.log("error");
										});
									})
								</script>';

					break;
				}

		}

		$return .= '</div>';
		return $return;
	}


	function list_select($data, $options, $multiple = false){
		$multiple = ($multiple) ? ' multiple="multiple"' : '';
		$required = ($data['required']) ? 'required' : '';
		$disable = ($data['somenteLeitura']) ? 'disabled' : '';

		$return = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<div class="input-group btn-group">
							<select id="select_'.$data['id'].'" class="multiselect" '.$multiple.' '.$disable.'>';

		$values = explode(',', $data['value']);
		
		foreach($options as $key => $value){
			$selected = (in_array($key, $values)) ? 'selected' : '';
			$return .= '		<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
		}

		$return .= '		</select>';
		
		if($data['somenteLeitura']){
			$return .= '</div>
						<script>
							$("#select_'.$data['id'].'").multiselect({
								disableIfEmpty: true,
								buttonWidth: "196px",
								buttonText: function(options, select){
									switch(options.length){
										case 0:
											return "Nenhum selecionado <span class=\"caret\"</span>";
										case 1:
										case 2:
											var text = [];
											options.each(function(){
												text.push($(this).text());
											});
											return text.toString() + "<span class=\"caret\"</span>";

										default:
											return options.length + " selecionados <span class=\"caret\"</span>";
									}
						      	}
							});
							
							$("#select_'.$data['id'].'").multiselect("disable");
						</script>';
		}
		else{
			$return .= '	<button type="submit" id="select_'.$data['id'].'_save" class="hide btn btn-primary editable-submit"><span class="glyphicon glyphicon-saved"></span></button>
						</div>
						<script>';

			if($multiple){
				$return .= '$("#select_'.$data['id'].'").multiselect({
								disableIfEmpty: true,
								includeSelectAllOption: true,
								selectAllText: "Selecionar todos",
								enableFiltering: true,
								enableCaseInsensitiveFiltering: true,
								filterPlaceholder: "Buscar",
								buttonWidth: "196px",
								onChange: function(event){
									$("#select_'.$data['id'].'_save").removeClass("hide");	
								},
								buttonText: function(options, select){
									switch(options.length){
										case 0:
											return "Nenhum selecionado <span class=\"caret\"</span>";
										case 1:
										case 2:
											var text = [];
											options.each(function(){
												text.push($(this).text());
											});
											return text.toString() + "<span class=\"caret\"</span>";

										default:
											return options.length + " selecionados <span class=\"caret\"</span>";
									}
						      	}
							});';
			}
			else{
				$return .= '$("#select_'.$data['id'].'").multiselect({
								disable: true,
								disableIfEmpty: true,
								enableFiltering: true,
								enableCaseInsensitiveFiltering: true,
								filterPlaceholder: "Buscar",
								buttonWidth: "196px",
								onChange: function(event){
									$("#select_'.$data['id'].'_save").removeClass("hide");	
								},
								buttonText: function(options, select){
						        	if(options.length == 0){
						        		return "Nenhum selecionado <span class=\"caret\"</span>";
						        	}
						        	else{
						        		var text = [];
										options.each(function(){
											text.push($(this).text());
										});
										return text.toString() + "<span class=\"caret\"</span>";
						        	}
						        }
							});';
			}

			$return .= '	$(".modal-bloco").delegate("#select_'.$data['id'].'_save", "click", function(e) {
								e.preventDefault();
								var sel = $("#select_'.$data['id'].'").val();
								
								$.ajax({

									url: "'.base_url('admin/'.$data['module'].'/update').'",
									type: "POST",
									contentType: "application/x-www-form-urlencoded; charset=UTF-8",
									data: { name: "'.$data['id'].'", pk: "'.$data['pk'].'", value: sel, type: "'.$data['type'].'"},
									dataType: "html",
									success: function(data) {
										$("#select_'.$data['id'].'_save").addClass("hide");
									}
								});
							});
						</script>';
		}
		$return .= '</div>';
		return $return;
	}

	function list_relate($data, $options, $condicional, $multiple){
		$multipleClass = ($multiple) ? ' multiple="multiple"' : '';
		$condicionalClass = ($condicional['condicional']) ? 'condicional' : '';
		$required = ($data['required']) ? 'required' : '';
		$disable = ($data['somenteLeitura']) ? 'disabled' : '';
		

		$values = explode(',', $data['value']);

		$return = '<div class="campo-interno">
						<h3>'.$data['txt'].'</h3>
						<div class="input-group btn-group">
							<select id="relate_'.$data['id'].'" class="relate multiselect '.$condicionalClass.'" '.$multipleClass.' '.$disable.'>';

		foreach($options as $key => $value){
			$selected = (in_array($key, $values)) ? 'selected' : '';
			$return .= '		<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
		}

		$return .=	'		</select>';

		if($data['somenteLeitura']){
			$return .= '</div>
						<script>
							$("#relate_'.$data['id'].'").multiselect({
								disableIfEmpty: true,
								buttonWidth: "196px",
								buttonText: function(options, select){
									switch(options.length){
										case 0:
											return "Nenhum selecionado <span class=\"caret\"</span>";
											break;
										case 1:
										case 2:
											var text = [];
											options.each(function(){
												text.push($(this).text());
											});
											return text.toString() + "<span class=\"caret\"</span>";
											break;

										default:
											return options.length + " selecionados <span class=\"caret\"</span>";
											break
									}
						      	}
							});
							
							$("#relate_'.$data['id'].'").multiselect("disable");';
		}
		else{

			$return .=	'	<button type="submit" id="relate_'.$data['id'].'_save" class="hide btn btn-primary editable-submit btn-save-relate">
								<span class="glyphicon glyphicon-saved"></span>
							</button>
						</div>
						<script>';

			if($multiple){
				$return .= '$("#relate_'.$data['id'].'").multiselect({
								disableIfEmpty: true,
								includeSelectAllOption: true,
								selectAllText: "Selecionar todos",
								enableFiltering: true,
								enableCaseInsensitiveFiltering: true,
								filterPlaceholder: "Buscar",
								buttonWidth: "196px",
								onChange: function(event){
									$("#relate_'.$data['id'].'_save").removeClass("hide");	
								},
								buttonText: function(options, select){
									switch(options.length){
										case 0:
											return "Nenhum selecionado <span class=\"caret\"</span>";
											break;
										case 1:
										case 2:
											var text = [];
											options.each(function(){
												text.push($(this).text());
											});
											return text.toString() + "<span class=\"caret\"</span>";
											break;

										default:
											return options.length + " selecionados <span class=\"caret\"</span>";
											break
									}
						      	}
							});';
			}
			else{
				$return .= '$("#relate_'.$data['id'].'").multiselect({
								disableIfEmpty: true,
								enableFiltering: true,
								enableCaseInsensitiveFiltering: true,
								filterPlaceholder: "Buscar",
								buttonWidth: "196px",
								onChange: function(event){
									$("#relate_'.$data['id'].'_save").removeClass("hide");	
								},
								buttonText: function(options, select){
						        	if(options.length == 0){
						        		return "Nenhum selecionado <span class=\"caret\"</span>";
						        	}
						        	else{
						        		var text = [];
										options.each(function(){
											text.push($(this).text());
										});
										return text.toString() + "<span class=\"caret\"</span>";
						        	}
						        }
							});';
			}

			$return .=	'	$(".modal-bloco").delegate("#relate_'.$data['id'].'_save", "click", function(e){
								e.preventDefault();
								var valorSelecionado = $("#relate_'.$data['id'].'").val();

								$.ajax({
									url: "'.base_url('admin/'.$data['module'].'/update').'",
									type: "POST",
									contentType: "application/x-www-form-urlencoded; charset=UTF-8",
									data: {name: "'.$data['id'].'", value: valorSelecionado, pk: "'.$data['pk'].'", type: "'.$data['type'].'"},
									dataType: "html",
									success: function(data){
										$("#relate_'.$data['id'].'_save").addClass("hide");
									}
								});
							});';
			
			if($condicional['condicional']){
				$null = ($data['required']) ? false : true;
				$return .= '	$(".modal-bloco").delegate("#relate_'.$condicional['condicional'].'", "change", function(e){
									e.preventDefault();

									$("#relate'.$data['id'].'").html("");

									$.ajax({
										url: "'.base_url('admin/'.$data['module'].'/condicional').'",
										type: "POST",
										contentType: "application/x-www-form-urlencoded; charset=UTF-8",
										data: {campo: "'.$condicional['campo'].'", field: "'.$condicional['condicional'].'", table: "'.$condicional['table'].'", id: $("#relate_'.$condicional['condicional'].'").val(), null: "'.$null.'" },
										dataType: "html",
										async: false,
										success: function(data) {
											$("#relate_'.$data['id'].'").html(data);
											$("#relate_'.$data['id'].'").multiselect("rebuild");
											$("#relate_'.$data['id'].'").trigger("change");
											$("#relate_'.$data['id'].'_save").removeClass("hide");
										}
									});
								});';
			}
		}

		$return .= '	</script>
					</div>';

		return $return;
	}

	function list_infoTime($data){
		$return =  '<div class="campo-interno">
						<h4>'.$data['txt'].'</h4>
						<a href="#" id="infotime_'.$data['id'].'">'.$data['value'].'</a>
						<script>
							$("#infotime_'.$data['id'].'").editable({
								disabled: true
							});
						</script>
					</div>';
		return $return;
	}
}