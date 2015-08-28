<?php $this->load->view( PUBLIC_VIEW.'layouts/header-interna'); ?>
<div class="section section-primary">
    <div class="container">
        <div class="row">
        	<div class="col-md-12">
                <h1 class="text-center">Nossos clientes</h1>
            </div>
        </div>
    </div>
</div>
<div class="section" id="clientes">
    <div class="container">
        <div class="row margin-depoimentos">
            <?php 
            foreach($this->data->clientes as $cliente){
                echo '
                    <div class="col-md-2 openProjectsClients" data-titulo="'.$cliente['titulo'].'" data-id="'.$cliente['id'].'">
                        <img src="'.base_url().'uploads/clientes/'.$cliente['images'].'"
                        class="img-responsive">
                    </div>
                ';
            }
             ?>
        </div>
    </div>
</div>

<?php $this->load->view( PUBLIC_VIEW.'layouts/footer-interna'); ?>