<?php $this->load->view( PUBLIC_VIEW.'layouts/header'); ?>

			<div id="conteudo1">
				<form method="POST" class="v-align-wrapper">
					<input type="text" id="login_txt" placeholder="Login" class="left">
					<div class="v-align">
						<div id="ok" class="right">Enviar</div>
					</div>
				</form>	
			</div>			
			<div id="conteudo2" style="display:none;">
				<p></p>
			</div>
		
<?php $this->load->view( PUBLIC_VIEW.'layouts/footer'); ?>

<script>

	jQuery(document).ready(function($) {
		var ok = $('#ok');
		var login = $('#login_txt');
		ok.on('click', function(){
			if(login.val()){
		    	$.ajax({
				    url: "<?php echo ci_site_url('usuarios/reset_senha'); ?>",
				    type: "POST",
				    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				    data: "login="+login.val(),
				    dataType: "html",
				    success: function(data) {
				    	if(data != 'false'){
							$('#conteudo1').fadeOut(400, function(){
								$('#conteudo2 p').html(data);
								$('#conteudo2').fadeIn(400);
							});
				    	}else{
				    		alert('Usuário não cadastrado.');
				    	};
				    }
				});
			}else{
				alert('Preencha o seu login.');
			};
		});
	});
</script>