<?php $this->load->view( PUBLIC_VIEW.'layouts/header-interna'); ?>
<div class="section section-primary">
    <div class="container">
        <div class="row">
        	<div class="col-md-12">
                <h1 class="text-center"><?php echo $this->data->servico['titulo'];  ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="section" id="servicos">
    <div class="container">
        <div class="row">
        	<?php 
        		echo '
                <div class="col-md-12">
                    '.$this->data->servico['conteudo'].'
                </div>
                ';
            ?>
        </div>
    </div>
</div>
<?php $this->load->view( PUBLIC_VIEW.'layouts/footer-interna'); ?>