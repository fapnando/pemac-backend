<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<title>Login | Administração</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="description" content="">
    	<meta name="author" content="">

	    <script src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.1.min.js"></script><!--REVISADO-->
	    <script src="<?php echo base_url(); ?>/assets/js/marty/md5.js"></script>

	    <link href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.min.css" rel="stylesheet"><!--REVISADO-->
	    <link href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet"><!--REVISADO-->
	    <script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script><!--REVISADO-->
    	<link href="<?php echo base_url(); ?>/assets/css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">

	    <style type="text/css">
			body{
				padding-top: 40px;
				padding-bottom: 40px;
				background-color: #f5f5f5;
			}

			.form-signin {
				max-width: 300px;
				padding: 19px 29px 29px;
				margin: 0 auto 20px;
				background-color: #fff;
				border: 1px solid #e5e5e5;
				-webkit-border-radius: 5px;
				   -moz-border-radius: 5px;
				        border-radius: 5px;
				-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
				   -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
				        box-shadow: 0 1px 2px rgba(0,0,0,.05);
			}

			.form-signin .form-signin-heading,
			.form-signin .checkbox {
				margin-bottom: 10px;
			}
			
			.form-signin input[type="text"],
			.form-signin input[type="password"] {
				font-size: 16px;
				height: auto;
				margin-bottom: 15px;
				padding: 7px 9px;
			}

	    </style>

	    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	    <!--[if lt IE 9]>
	      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->

	</head>

	<body>
    	<div class="container">
      		<form method="POST" class="form-signin" id="login">
	        	<div align="center">
	          		<img style="width: 140px;" src="<?php echo base_url(); ?>assets/img/public/logo_pemac.png" />
	        	</div>
	        	<h2 class="form-signin-heading">Login</h2>
		        <input type="text" class="input-block-level" id="user_email" placeholder="Email">
		        <input type="password" class="input-block-level" id="user_senha" placeholder="Senha">
	        	<button class="btn btn-large btn-primary" type="submit">Entrar</button>
      		</form>
    	</div>
    
	    <script>	
			$("#login").submit(function(event) {
				path = '<?php echo ci_site_url(); ?>';
				
				e = $('#user_email').val();
				var strVal = $('#user_senha').val();
				var strMD5 = $().crypt({
					method: "md5",
					source: strVal
				});
			

				$.post(path+"admin/administradores/get_salt", { email: e, senha: strMD5 })
				.done(function(data) {
					if(data == 'true'){
					      window.location.href = path+'admin/administradores';
					}
					else{
					      alert('login ou senha inválidos');
					}
				});
				
				event.preventDefault();
			});
		</script>
	</body>
</html>
