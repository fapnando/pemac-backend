<?php $this->load->view( PUBLIC_VIEW.'layouts/header-interna'); ?>
<div class="section section-primary">
    <div class="container">
        <div class="row">
        	<div class="col-md-12">
                <h1 class="text-center"><?php echo $this->data->noticia['titulo'];  ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
        	<?php 
        		echo '
        		<div class="col-md-12">
                    <img src="'.base_url().'uploads/noticias/'.$noticia['capa'].'"
                        class="img-responsive">
                </div>
                <div class="col-md-12">
                    '.$this->data->noticia['conteudo'].'
                </div>
                ';
            ?>
        </div>
    </div>
</div>
<div class="section" id="noticias">
    <div class="container">
        <div class="col-md-12">
            <h1 class="text-center">Outras notícias</h1>
            <hr class="hr-color">
        </div>
        <div class="row">
        	<?php
            	foreach($this->data->outrasNoticias as $noticia){
            		echo '
                    <div class="col-md-3">
                        <img src="'.base_url().'uploads/noticias/'.$noticia['capa'].'"
                        class="img-responsive">
                        <h3 class="content-news-h3">'.$noticia['titulo'].'</h3>
                        <p>
                            <i class="fa fa-calendar text-primary">'.$noticia['data'].'</i>
                        </p>
                        <p>
                            <i class="fa fa-tag text-primary"> '.$noticia['titulo_categoria'].'</i>
                        </p>
                        <div class="content-news">
                            '.$noticia['conteudo'].'
                        </div>
                        <a href="'.$noticia['link'].'" class="btn btn-block btn-primary btn-sm"><i class="fa fa-fw fa-plus-square"></i>Continue lendo</a>
                    </div>
                    ';
                }
            ?>
        </div>
        <div class="col-md-12">
            <hr class="hr-color">
            <h1 class="text-center cursor-pointer gotoPage" data-link="noticias">Voltar para todas as notícias</h1>
        </div>
    </div>
</div>
<?php $this->load->view( PUBLIC_VIEW.'layouts/footer-interna'); ?>