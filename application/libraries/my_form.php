<?php
class my_form{
	function form_hidden($data, $value){
		$required = ($data['required']) ? 'required' : '';
		$return = '<input type="hidden" id="'.$data['id'].'" name="'.$data['id'].'" value="'.$value.'" '.$required.'/>';
		return $return;
	}

	function form_text($data){
		$required = ($data['required']) ? 'required' : '';
		$return = '<div class="campo-interno">
				   		<label for="'.$data['id'].'">'.$data['txt'].'</label>
				   		<input type="text" class="form-control" id="'.$data['id'].'" name="'.$data['id'].'" placeholder="'.$data['txt'].'" '.$required.'/>
				   	</div>';

		return $return;
	}

	function form_textarea($data){
		$required = ($data['required']) ? 'required' : '';
		$return = '<div class="campo-interno">
						<label for="'.$data['id'].'">'.$data['txt'].'</label>
						<textarea class="form-control" id="'.$data['id'].'" name="'.$data['id'].'" rows="10" style="width: 100%" placeholder="'.$data['txt'].'" '.$required.'></textarea>
					</div>';

		return $return;
	}

	function form_senha($data){
		$required = ($data['required']) ? 'required' : '';
		$return = '<div class="campo-interno">
						<label for="'.$data['id'].'">'.$data['txt'].'</label>
						<input type="password" class="form-control" id="senhaantiga_'.$data['id'].'" placeholder="'.$data['txt'].'" '.$required.'/>
						<input type="hidden" id="'.$data['id'].'" name="'.$data['id'].'"/>
						<script>
							$("#senhaantiga_'.$data['id'].'").blur(function(){
								var strVal = $(this).val();
								var strMD5 = $().crypt({
									method: "md5",
									source: strVal
								});
								
								$("#'.$data['id'].'").val(strMD5);
							});
						</script>
					</div>';

		return $return;
	}

	function form_onoff($data, $options){
		$required = ($data['required']) ? 'required' : '';
		$return = '<div class="campo-interno">
						<label for="'.$data['id'].'">'.$data['txt'].'</label>
						<select class="form-control" id="'.$data['id'].'" name="'.$data['id'].'" '.$required.'>';

		foreach($options as $key => $value){
			$return .= '	<option value="'.$key.'">'.$value.'</option>';
		}

		$return .= '	</select>
					</div>';

		return $return;
	}

	function form_time($data){
		$required = ($data['required']) ? 'required' : '';
		$return = '<div class="campo-interno">
						<label for="'.$data['id'].'">'.$data['txt'].'</label>
						<div class="bootstrap-timepicker">
							<input type="text" class="form-control" id="'.$data['id'].'" name="'.$data['id'].'" placeholder="'.$data['txt'].'" '.$required.'/>
						</div>
						<script>
							$("#'.$data['id'].'").timepicker({
								minuteStep: 1,
				                template: "dropdown",
				                showMeridian: false,
				                showInputs: false,
				                defaultTime: false,
				                disableFocus: true
							});
					    </script>
					</div>';
		return $return;	
	}

	function form_date($data){
		$required = ($data['required']) ? 'required' : '';
		$return = '<div class="campo-interno">
						<label for="'.$data['id'].'">'.$data['txt'].'</label>
						<input type="text" class="form-control" id="'.$data['id'].'" name="'.$data['id'].'" placeholder="'.$data['txt'].'" '.$required.'/>
						<script>
							$("#'.$data['id'].'").datepicker({
							    format: "yyyy/mm/dd",
							    weekStart: 0,
							    todayBtn: "linked",
							    language: "pt-BR",
							    keyboardNavigation: false,
							    forceParse: false,
							    autoclose: true,
							    todayHighlight: true
							});
						</script>
					</div>';
		return $return;
					
	}

	function form_wys($data){
		$required = ($data['required']) ? 'required' : '';
		$return = '<div class="campo-interno">
						<label for="'.$data['id'].'">'.$data['txt'].'</label>
						<textarea class="form_wys" id="'.$data['id'].'" name="'.$data['id'].'" style="width:100%" '.$required.'></textarea>
						<script>
							tinymce.init({
								selector: "#'.$data['id'].'",
								theme: "modern", 
								width: 645, 
								height: 300, 
								plugins: [ 
									"advlist autolink link image lists charmap print preview hr anchor pagebreak save", 
									"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking", 
									"table contextmenu directionality emoticons paste textcolor responsivefilemanager" 
								], 
								menubar: false, 
								toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager | link unlink | preview", 
								image_advtab: true, 
								external_filemanager_path:"../assets/js/filemanager/", 
								filemanager_title:"Responsive Filemanager", 
								save_enablewhendirty: true, 
								external_plugins: { "filemanager" : "../filemanager/plugin.min.js"}
							});
						</script>
					</div>';
		return $return;
	}

	function form_tags($data){
		$required = ($data['required']) ? 'required' : '';
		$return = '<div class="campo-interno">
						<label for="'.$data['id'].'">'.$data['txt'].'</label><br>
						<input type="hidden" id="'.$data['id'].'" name="'.$data['id'].'" '.$required.'/>
						<script>
							$("#'.$data['id'].'").select2({
								tags: [],
								width: "90%",
								formatNoMatches: "",
								containerCssClass: "form-control"
							});

						</script>
					</div>';

		return $return;
	}

	function form_rota($data, $rota){
		$required = ($data['required']) ? 'required' : '';
		$prefix = ($rota['prefix']) ? $rota['prefix'].'/' : '';

		$return = '<div class="campo-interno">
						<label for="'.$data['id'].'">'.$data['txt'].'</label>
						<input type="text" class="form-control" id="'.$data['id'].'" name="'.$data['id'].'" placeholder="Preencha o campo '.$rota['campo'].'" '.$required.'/>
						<script>
							$("#'.$rota['campo'].'").blur(function(){
								var texto = "'.$prefix.'" + $("#'.$rota['campo'].'").val();
								var slug = makeSlug(texto);

								$.ajax({
									url: "'.base_url('rotas/check_slug').'",
									type: "POST",
									contentType: "application/x-www-form-urlencoded; charset=UTF-8",
									data: { slug: slug },
									dataType: "html",
									success: function(data) {
										$("#'.$data['id'].'").val(data);
									}
								});
							});
						</script>
					</div>';
		return $return;
	}

	function form_video($data, $origem){
		$required = ($data['required']) ? 'required' : '';
		$return = '<div class="campo-interno">';

		switch($origem){
			case 'youtube':
				$return .= '<label for="'.$data['id'].'">'.$data['txt'].'</label>
							<input type="text" class="form-control" id="'.$data['id'].'" name="'.$data['id'].'" placeholder="'.$data['txt'].' (https://www.youtube.com/watch?v=XXXXXXXXXXX)" '.$required.'/>
							<div id="video_'.$data['id'].'"></div>
							<script>
								$("#novo").on("blur, change", "#'.$data['id'].'", function(){
									var video_link = $("#'.$data['id'].'").val();
									if(video_link != ""){
										video = video_link.split("v=").pop();
										var iframe = "<iframe width=\"645\" height=\"363\" src=\"https://www.youtube.com/embed/"+video+"\" frameborder=\"0\" allowfullscreen></iframe>";
										$("#video_'.$data['id'].'").html(iframe);
									}
									else{
										$("#video_'.$data['id'].'").html("");	
									}
								});
							</script>';
				break;

			case 'vimeo':
				$return .= '<label for="'.$data['id'].'">'.$data['txt'].'</label>
							<input type="text" class="form-control" id="'.$data['id'].'" name="'.$data['id'].'" placeholder="'.$data['txt'].' (http://vimeo.com/XXXXXXXXX)" '.$required.'/>
							<div id="video_'.$data['id'].'"></div>
							<script>
								$("#novo").on("blur, change", "#'.$data['id'].'", function(){
									var video_link = $("#'.$data['id'].'").val();
									if(video_link != ""){
										$.ajax({
											url: "http://vimeo.com/api/oembed.json",
											type: "GET",
											dataType: "json",
											data: {url: $("#'.$data['id'].'").val(), width: 645, height: 363}
										})
										.done(function(data) {
										    $("#video_'.$data['id'].'").html(data.html);
										})
										.fail(function() {
											$("#video_'.$data['id'].'").html("Não foi possível carregar o vídeo. Verifique se o link esta correto.");
										});
									}
									else{
										$("#video_'.$data['id'].'").html("");
									}
								});
							</script>';
				break;
		}

		$return .= '</div>';
		return $return;
	}

	function form_select($data, $options, $multiple=false){
		$multiple = ($multiple) ? ' multiple="multiple"' : '';
		$required = ($data['required']) ? 'required' : '';

		$return = '<div class="campo-interno">
						<label for="'.$data['id'].'" class="">'.$data['txt'].'</label>
						<div class="campo-interno">
							<select class="multiselect form-control" id="'.$data['id'].'" '.$multiple.'>';

		foreach($options as $k => $v){
			$return .= '		<option value="'.$k.'">'.$v."</option>";	
		}
		
		$return .= '		</select>
					  		<input type="hidden" id="'.$data['id'].'_hidden" name="'.$data['id'].'" '.$required.' />
						</div>
						<script>';

		if($multiple){
			$return .= '	$("#'.$data['id'].'").multiselect({
								checkboxName: "'.$data['id'].'[]",
								disableIfEmpty: true,
								includeSelectAllOption: true,
								selectAllText: "Selecionar todos",
								enableFiltering: true,
								enableCaseInsensitiveFiltering: true,
								filterPlaceholder: "Buscar",
					    		buttonWidth: "95%",
					    		onChange: function(event) {
						            var valores = $("#'.$data['id'].'").val();
						            var valor = "";
						            for(var v in valores){
										valor += valores[v]+",";
						            }

						            $("#'.$data['id'].'_hidden").val(valor);
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
			$return .= '	$("#'.$data['id'].'").multiselect({
								checkboxName: "'.$data['id'].'",
								disableIfEmpty: true,
								enableFiltering: true,
								enableCaseInsensitiveFiltering: true,
								filterPlaceholder: "Buscar",
					    		buttonWidth: "95%",
					    		onChange: function(event){
						            $("#'.$data['id'].'_hidden").val($("#'.$data['id'].'").val());
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
					    	});
						
							$("#'.$data['id'].'_hidden").val($("#'.$data['id'].'").val());
					';
		}

		$return .= '	</script>
					</div>';

		return $return;
	}

	function form_relate($data, $options, $condicional, $multiple=false){
		$multiple = ($multiple) ? ' multiple="multiple"' : '';
		$required = ($data['required']) ? 'required' : '';

		$return = '<div class="campo-interno">
						<label for="'.$data['id'].'" class="">'.$data['txt'].'</label>
						<div class="campo-interno">
							<select class="relate multiselect form-control" id="'.$data['id'].'" '.$multiple.'>';

		foreach($options as $k => $v){
			$return .= '		<option value="'.$k.'">'.$v."</option>";	
		}
		
		$return .= '		</select>
					  		<input type="hidden" id="'.$data['id'].'_hidden" name="'.$data['id'].'" '.$required.'/>
						</div>
						<script>';

		if($multiple){
			$return .= '	$("#'.$data['id'].'").multiselect({
								checkboxName: "'.$data['id'].'[]",
								disableIfEmpty: true,
								includeSelectAllOption: true,
								selectAllText: "Selecionar todos",
								enableFiltering: true,
								enableCaseInsensitiveFiltering: true,
								filterPlaceholder: "Buscar",
					    		buttonWidth: "95%",
					    		onChange: function(event) {
						            var valores = $("#'.$data['id'].'").val();
						            var valor = "";
						            for(var v in valores){
										valor += valores[v]+",";
						            }

						            $("#'.$data['id'].'_hidden").val(valor);
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
			$return .= '	$("#'.$data['id'].'").multiselect({
								checkboxName: "'.$data['id'].'",
								disableIfEmpty: true,
								enableFiltering: true,
								enableCaseInsensitiveFiltering: true,
								filterPlaceholder: "Buscar",
					    		buttonWidth: "95%",
					    		onChange: function(event){
						            $("#'.$data['id'].'_hidden").val($("#'.$data['id'].'").val());
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
					    	});
						
							$("#'.$data['id'].'_hidden").val($("#'.$data['id'].'").val());
					';
		}


		if($condicional['condicional']){
			$null = ($data['required']) ? false : true;
		
			$return .= '	$("body").delegate("#'.$condicional['condicional'].'", "change", function(e) {
							
								e.preventDefault();
								var valor = $("#'.$condicional['condicional'].'").val();
								$("#'.$data['id'].'").html();

								if(valor == null){
									$("#'.$data['id'].'").html("");
									$("#'.$data['id'].'").multiselect("rebuild");
									$("#'.$data['id'].'_hidden").val($("#'.$data['id'].'").val());
									$("#'.$data['id'].'").trigger("change");
									
								}
								$.ajax({
									url: "'.ci_site_url('admin/'.$data['module'].'/condicional').'",
									type: "POST",
									contentType: "application/x-www-form-urlencoded; charset=UTF-8",
									data: {campo: "'.$condicional['campo'].'", field: "'.$condicional['condicional'].'", table: "'.$condicional['table'].'", id: $("#'.$condicional['condicional'].'").val(), null: "'.$null.'" },
									dataType: "html",
									async: false,
									success: function(data) {
										$("#'.$data['id'].'").html(data);
										$("#'.$data['id'].'").multiselect("rebuild");
										$("#'.$data['id'].'_hidden").val($("#'.$data['id'].'").val());
										$("#'.$data['id'].'").trigger("change");
									}
								});
							});';
		}

		$return .= '	</script>
					</div>';

		return $return;
	}
}