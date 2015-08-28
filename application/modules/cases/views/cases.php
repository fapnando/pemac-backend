<?php $this->load->view( PUBLIC_VIEW.'layouts/header-interna'); ?>
<div class="section section-primary">
    <div class="container">
        <div class="row">
        	<div class="col-md-12">
                <h1 class="text-center">Nossos cases de sucesso</h1>
            </div>
        </div>
    </div>
</div>
<div class="section" id="cases">
    <div class="container">
            <?php 
                $validador = 0;
                $auxiliar = 0;
                foreach($this->data->cases as $case){
                    if($auxiliar == 0){
                         echo '<div class="row">';
                    }
                    echo '
                        <div class="col-md-4">
                            <img src="'.base_url().'uploads/cases/'.$case['images'].'"
                            class="img-responsive">
                            <h3>'.$case['titulo'].'</h3>
                            '.$case['conteudo'].'
                        </div>
                    ';
                    if($auxiliar == 2){
                         echo '</div>';
                         $auxiliar = 0;
                    }else{
                        $auxiliar++;
                    }
                }
            ?>
    </div>
</div>
<?php $this->load->view( PUBLIC_VIEW.'layouts/footer-interna'); ?>