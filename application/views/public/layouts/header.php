<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
        rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/public/site.css">
        
        <script>
            baseUrl = '<?php echo base_url(); ?>';
        </script>
    </head>
    
    <body>
    <div class="modal fade" id="modal-contato">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body contentContact">          
          </div>
          <div class="modal-footer">
            <a class="btn btn-default" data-dismiss="modal">OK</a>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-clientes">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title clientName"></h4>
          </div>
          <div class="modal-body contentProjects">          
          </div>
          <div class="modal-footer">
            <a class="btn btn-default" data-dismiss="modal">Fechar</a>
          </div>
        </div>
      </div>
    </div>
        <div class="navbar navbar-default navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="https://www.facebook.com/pages/PEMAC/317620364914923?fref=ts" target="_Blank"><i class="fa fa-2x fa-facebook text-inverse icon-fb-margin"></i></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="home" class="menu-item"><i class="fa fa-fw fa-home"></i>Home</a>
                        </li>
                        <li>
                            <a href="institucional"><i class="fa fa-fw fa-building"></i>Institucional</a>
                        </li>
                        <li>
                            <a href="servicos" class="menu-item"><i class="fa fa-fw fa-wrench"></i>Serviços</a>
                        </li>
                        <li>
                            <a href="cases" class="menu-item"><i class="fa fa-fw fa-suitcase"></i>Cases</a>
                        </li>
                        <li>
                            <a href="noticias" class="menu-item"><i class="fa fa-fw fa-newspaper-o"></i>Notícias</a>
                        </li>
                        <li>
                            <a href="clientes" class="menu-item"><i class="fa fa-fw fa-users"></i>Clientes</a>
                        </li>
                        <li>
                            <a href="contato" class="menu-item"><i class="fa fa-fw fa-mobile-phone"></i>Contato</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section" id="home">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-center"></div>
                    <div class="col-md-4 text-center">
                        <img src="<?php echo base_url();?>assets/img/public/logo_pemac.png"
                        class="img-responsive" style="margin-top:30px;">
                    </div>
                    <div class="col-md-4 text-center" style="margin-top: 80px;">
                        <p><i class="fa fa-envelope fa-fw fa-lg text-primary"></i>Email: teste@teste.com.br</p>
                        <p><i class="fa fa-lg fa-fw fa-phone text-primary"></i>Telefone: (11) 1111-1111</p>
                    </div>
                </div>
            </div>
        </div>
        <section class="block">
            <div id="myCarousel" class="carousel slide">
                <div class="carousel-inner">
                    <div class="active item">
                        <img src="https://ununsplash.imgix.net/photo-1423753623104-718aaace6772?w=1024&amp;q=50&amp;fm=jpg&amp;s=1ffa61419561b5c796bca3158e7c704c"
                        alt="Slide1">
                    </div>
                    <div class="item">
                        <img src="https://ununsplash.imgix.net/photo-1423753623104-718aaace6772?w=1024&amp;q=50&amp;fm=jpg&amp;s=1ffa61419561b5c796bca3158e7c704c"
                        alt="Slide2">
                    </div>
                    <div class="item">
                        <img src="https://ununsplash.imgix.net/photo-1423753623104-718aaace6772?w=1024&amp;q=50&amp;fm=jpg&amp;s=1ffa61419561b5c796bca3158e7c704c"
                        alt="Slide2">
                    </div>
                </div>
                <a class="carousel-control left" href="#myCarousel" data-slide="prev">‹</a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">›</a>
            </div>
        </section>