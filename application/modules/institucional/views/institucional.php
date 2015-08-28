<?php $this->load->view( PUBLIC_VIEW.'layouts/header-interna'); ?>
<div class="section section-primary">
    <div class="container">
        <div class="row">
        	<div class="col-md-12">
                <h1 class="text-center">Sobre a PEMAC Engenharia</h1>
            </div>
        </div>
    </div>
</div>
<div class="section" id="institucional">
    <div class="container">
        <div class="row">
        	<?php 
            	foreach($this->data->institucional as $institucional){
            		echo '
                    <div class="col-md-12">
                        <p class="text-center">'.$institucional['conteudo'].'</p>
                    </div>
                    ';
                }
            ?>
        </div>
    </div>
</div>

<?php $this->load->view( PUBLIC_VIEW.'layouts/footer-interna'); ?>