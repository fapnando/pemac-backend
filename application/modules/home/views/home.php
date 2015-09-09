<?php $this->load->view( PUBLIC_VIEW.'layouts/header'); ?>

		<div class="section section-primary" id="servicos">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Serviços</h1>
                        <hr class="hr-color-white">
                    </div>
                </div>
                <div class="row">
                	<?php 
	                	foreach($this->data->servicos as $servico){
	                		echo '
		                    <div class="col-md-4 text-center">
		                        <h2>'.$servico['titulo'].'</h2>
		                        <p class="text-center">'.word_limiter($servico['conteudo'],30).'</p>
		                        <a href="'.$servico['link'].'"><i class="fa fa-2x fa-arrow-circle-o-right text-inverse"></i></a>
		                    </div>
		                    ';
	                    }
                    ?>
                </div>
            	
                <div class="col-md-12">
                    <hr class="hr-color-white">
                    <h1 class="text-center cursor-pointer gotoPage" data-link="servicos">ver todos os serviços</h1>
                </div>
            </div>
        </div>
        <div class="section" id="cases">
            <div class="container">
                <div class="col-md-12">
                    <h1 class="text-center">Cases de sucesso</h1>
                    <hr class="hr-color">
                </div>
                <div class="row">
                	<?php 
	                	foreach($this->data->cases as $case){
	                		echo '
			                    <div class="col-md-3">
			                        <img src="'.base_url().'uploads/cases/'.$case['images'].'"
			                        class="img-responsive">
			                        <h3>'.$case['titulo'].'</h3>
			                        '.$case['conteudo'].'
			                    </div>
		                    ';
	                    }
                    ?>
                </div>
                <div class="col-md-12">
                    <hr class="hr-color">
                    <h1 class="text-center cursor-pointer gotoPage" data-link="cases">ver todos os cases</h1>
                </div>
            </div>
        </div>
		
        <div class="section background-gray" id="depoimentos">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Depoimentos</h1>
                        <hr class="hr-color-white">
                    </div>
                </div>
                <div class="row margin-depoimentos">
     				<?php
	                	foreach($this->data->depoimentos as $depoimento){
	                		echo '
		                    <div class="col-md-2">';
		                    if($depoimento['foto'] != ''){
		                    	echo '
		                        <img src="'.base_url().'uploads/depoimentos/'.$depoimento['foto'].'"
		                        class="img-circle img-responsive">';
		                    }else{
		                    	
		                    }
		                    echo '    
		                    </div>
		                    <div class="col-md-4">
		                        <h3 class="text-left">'.$depoimento['empresa'].'</h3>
		                        <p class="text-left">'.$depoimento['conteudo'].'</p>
		                    </div>
		                    ';
	                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="section" id="noticias">
            <div class="container">
                <div class="col-md-12">
                    <h1 class="text-center">Notícias</h1>
                    <hr class="hr-color">
                </div>
                <div class="row">
                	<?php
	                	foreach($this->data->noticias as $noticia){
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
                    <h1 class="text-center cursor-pointer gotoPage" data-link="noticias">ver todas as notícias</h1>
                </div>
            </div>
        </div>
        <div class="section background-image-frase">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Lorem ipsum dolor sit amet</h2>
                        <h4>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Someone famous</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="clientes">
            <div class="container">
                <div class="col-md-12">
                    <h1 class="text-center">Clientes</h1>
                    <hr class="hr-color">
                </div>
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

<?php $this->load->view( PUBLIC_VIEW.'layouts/footer'); ?>