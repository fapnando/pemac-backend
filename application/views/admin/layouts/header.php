<?php $menu = $this->geral->getMenuAdmin(); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Administrador</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8;" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
          
        <script src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.1.min.js"></script>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>

        <link href="<?php echo base_url(); ?>assets/css/admin/admin.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/js/marty/modernizr.custom.js"></script>
        
        <link type="text/css" href="<?php echo base_url(); ?>assets/css/admin/normalize.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>assets/css/admin/icons.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>assets/css/admin/component.css" rel="stylesheet">
        
        <link href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-editable.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap-editable.min.js"></script>
        
        <link href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-timepicker.min.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap-timepicker.min.js"></script>
        
        <link  href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-switch.min.css" rel="stylesheet" >
        <script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap-switch.min.js"></script>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-multiselect.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap-multiselect.js"></script>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap/datepicker.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap-datepicker.js"></script>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap/select2.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/js/bootstrap/select2.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap/select2-bootstrap.css" rel="stylesheet">

        <script src="<?php echo base_url(); ?>assets/js/marty/bootbox.min.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/js/marty/md5.js"></script>    

        <script src="<?php echo base_url(); ?>assets/js/jquery/jquery.mask.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery/jquery.filedrop.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery/jquery.form.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery/jquery-sortable.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/tinymce/tinymce.min.js"></script>
    	<script src="<?php echo base_url(); ?>assets/js/marty/moment.js"></script>

        <style>
            .mce-menu{
                z-index: 9999999999 !important;
            } 
        </style>
    </head>

    <body>
        <div class="loading hide">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div>
        
        <div class="container2" style="height:100%;">
       
        
        <!-- Push Wrapper -->
        <div class="mp-pusher" style="z-index: 2000;" id="mp-pusher">

            <!-- Menu lateral -->
    	    <nav id="mp-menu" class="mp-menu">
    		    <div class="mp-level"> 
                    <div class="left" style="margin-top: 50px; margin-left: 30px;">
                        <img style="width: 140px;" src="<?php echo base_url(); ?>assets/img/admin/logo.png" />
                    </div>
                    <ul class="clear">
                        <h2 class="left icon icon-world" style="font-size: 14px;  margin-left: 20px;">Administração</h2>
                        <ul class="clear"  style="margin-top: 50px;">
    			    
                            <?php
                            foreach($menu as $m){
                                if($m['submodulos'] == 'nenhum'){
                                  echo '<li><a class="icon icon-user" href="'.ci_site_url("admin").'/'.$m["modulo"].'">'.$m['titulo'].'</a></li>';
                                }

                                else{
                                    echo '<li class="icon icon-arrow-left">
                                                <a class="icon icon-news" href="#">'.$m["modulo"].'</a>
                                                <div class="mp-level">
                                                    <a href="'.ci_site_url("admin").'/'.$m["modulo"].'">
                                                      <h2>'.$m["titulo"].'</h2>
                                                    </a>
                                                    <a class="mp-back" href="#">voltar</a>
                                                    <ul>';
                                    foreach($m['submodulos'] as $sub){
                                    echo '              <li><a href="'.ci_site_url('admin').'/'.$sub["modulo"].'">'.$sub["titulo"].'</a></li>';
                                }

                                echo '              </ul>
                                                </div>
                                            </li>';

                                }
                            }
                            ?>
    				  
    				        <li style="background: #d9534f;"><a class="icon icon-user" href="<?php echo ci_site_url('admin/logout'); ?>"> Sair</a></li>
                        </ul>
    				</ul>
                </div>
            </nav>
            <!-- Fim do menu lateral -->

            <div class="scroller">
                <div class="scroller-inner">
                    <div class="wrap clearfix">
                        <div class="left">
                            <a href="#" id="trigger" class="menu-trigger">MENU</a>
                        </div>


