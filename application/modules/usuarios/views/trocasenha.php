<?php $this->load->view( PUBLIC_VIEW.'layouts/header'); ?>

			<div id="conteudo1">
				<form method="POST" id="form_trocar_senha" class="block">
					<input type="hidden" name="token" placeholder="token" value="<?php echo $this->data->token; ?>"/>
					<div class="row width100"><label for="">Nova senha:</label><input id="trocar_senha_senha" name="senha" type="password"></div>
					<div class="row width100"><label for="">Repetir senha:</label><input id="trocar_senha_repetir_senha" type="password"></div>
					<input type="button" value="trocar" id="trocar" />
				</form>
			</div>			
			<div id="conteudo2" style="display:none;">
				<p></p>
			</div>
		

<?php $this->load->view( PUBLIC_VIEW.'layouts/footer'); ?>

<script>

	$('body').delegate("#trocar", "click", function(e) {
		
    	e.preventDefault();
    	var senha1 = $('#trocar_senha_senha').val();
    	var senha2 = $('#trocar_senha_repetir_senha').val();
    	if(senha1 === senha2){
	    	$.ajax({
			    url: "<?php echo ci_site_url('usuarios/novasenha'); ?>",
			    type: "POST",
			    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			    data: $('#form_trocar_senha').serialize(),
			    dataType: "html",
			    success: function(data) {
			    	alert('Sua senha foi alterada com sucesso');
			    	window.location.href = "<?php echo ci_site_url(); ?>";
			    }
			});
    	}else{
    		alert('Senhas diferentes digitadas.');
    	};

			
	});

</script>