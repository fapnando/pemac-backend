<?php $this->load->view( PUBLIC_VIEW.'layouts/header-interna'); ?>
<div class="section section-primary">
    <div class="container">
        <div class="row">
        	<div class="col-md-12">
                <h1 class="text-center">Nossos serviços</h1>
            </div>
        </div>
    </div>
</div>
<div class="section" id="servicos">
    <div class="container">
        <div class="row">
        	<?php 
            	foreach($this->data->servicos as $servico){
            		echo '
                    <div class="col-md-4">
                        <h2 style="color:#337cbb;">'.$servico['titulo'].'</h2>
                        <p>'.$servico['conteudo'].'</p>
                        <a href="'.$servico['link'].'"><i class="fa fa-2x fa-arrow-circle-o-right"></i></a>
                    </div>
                    ';
                }
            ?>
        </div>
    </div>
</div>
<?php $this->load->view( PUBLIC_VIEW.'layouts/footer-interna'); ?>