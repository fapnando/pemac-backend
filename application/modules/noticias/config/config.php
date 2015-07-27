<?php
//######################| INICIO DO MÓDULO |####################################

    //######################| Config |####################################

    $config['module']           = 'noticias';
    $config['module_title']     = 'Notícias';
    $config['model']            = '';
    $config['table']            = 'noticias';
        
    $config['base']             = 'padrao';
    $config['index']            = 'padrao';
    $config['layout']           = 'table';

    $config['exportar']         = 'false';
    $config['module_type']      = 'normal'; // normal - submodulo
    $config['module_base']      = 'nenhum'; // nome do modulo base. 'nenhum' caso module_type = 'normal'
    
    //######################| Campos |####################################
    
    $config['campos'] = array();

    $config['campos']['ativo']['id']                          = 'ativo';
    $config['campos']['ativo']['type']                        = 'onoff';
    $config['campos']['ativo']['hidden']                      = false;
    $config['campos']['ativo']['txt']                         = 'Ativo';
    $config['campos']['ativo']['required']                    = true;
    $config['campos']['ativo']['listagem']                    = true;

    $config['campos']['titulo'] = array();
    $config['campos']['titulo']['id']                         = 'titulo';
    $config['campos']['titulo']['type']                       = 'text';
    $config['campos']['titulo']['hidden']                     = false;
    $config['campos']['titulo']['txt']                        = 'Título';
    $config['campos']['titulo']['required']                   = true;
    $config['campos']['titulo']['listagem']                   = true;

    $config['campos']['capa'] = array();
    $config['campos']['capa']['id']                         = 'capa';
    $config['campos']['capa']['type']                       = 'image'; 
    $config['campos']['capa']['hidden']                     = false;
    $config['campos']['capa']['txt']                        = 'Capa';
    $config['campos']['capa']['required']                   = true;
    $config['campos']['capa']['n_images']                   = '1';
    $config['campos']['capa']['listagem']                   = true;

    $config['campos']['images'] = array();
    $config['campos']['images']['id']                         = 'images';
    $config['campos']['images']['type']                       = 'image'; 
    $config['campos']['images']['hidden']                     = false;
    $config['campos']['images']['txt']                        = 'Imagem';
    $config['campos']['images']['required']                   = true;
    $config['campos']['images']['n_images']                   = '1';
    $config['campos']['images']['listagem']                   = true;

    $config['campos']['data'] = array();
    $config['campos']['data']['id']                           = 'data';
    $config['campos']['data']['type']                         = 'date';
    $config['campos']['data']['hidden']                       = false;
    $config['campos']['data']['txt']                          = 'Data';
    $config['campos']['data']['required']                     = true;
    $config['campos']['data']['listagem']                     = true;

    $config['campos']['categoria'] = array();
    $config['campos']['categoria']['id']                         = 'categoria';
    $config['campos']['categoria']['type']                       = 'relate';
    $config['campos']['categoria']['hidden']                     = false;
    $config['campos']['categoria']['relate']['tabela']           = 'categorias';
    $config['campos']['categoria']['relate']['campo']            = 'titulo';
    $config['campos']['categoria']['txt']                        = 'relate';
    $config['campos']['categoria']['required']                   = true;
    $config['campos']['categoria']['fk']                         = false;
    $config['campos']['categoria']['multiple']                   = false;
    $config['campos']['categoria']['listagem']                   = true;
    $config['campos']['categoria']['condicional']                = false;

    $config['campos']['conteudo'] = array();
    $config['campos']['conteudo']['id']                       = 'conteudo';
    $config['campos']['conteudo']['type']                     = 'wys';
    $config['campos']['conteudo']['hidden']                   = false;
    $config['campos']['conteudo']['txt']                      = 'Conteúdo';
    $config['campos']['conteudo']['required']                 = false;

    $config['campos']['id_route'] = array();
    $config['campos']['id_route']['id']                       = 'id_route';
    $config['campos']['id_route']['type']                     = 'rota';
    $config['campos']['id_route']['hidden']                   = false;
    $config['campos']['id_route']['txt']                      = 'Rota';
    $config['campos']['id_route']['required']                 = true;
    $config['campos']['id_route']['rota']                     = 'noticias/ver/';
    $config['campos']['id_route']['campo']                    = 'titulo';
    $config['campos']['id_route']['prefix']                   = false;
    $config['campos']['id_route']['listagem']                 = true;


    
    //######################| FILTROS |####################################
    
    $config['filtro'] = array();
        
    //######################| Instalação |####################################

    $config['install'] = array();
    
        
    $config['install'][0] = "CREATE TABLE IF NOT EXISTS `".$config['table']."` (
    
    `id`    int(255) NOT NULL AUTO_INCREMENT,
    `ativo` int(255) DEFAULT NULL,
    `order` int(255) DEFAULT NULL,
    
    `titulo` 			  varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `capa`                varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `images`              varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `data`                date COLLATE latin1_general_ci DEFAULT NULL,
    `categoria`           varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `conteudo`            longtext COLLATE latin1_general_ci DEFAULT NULL,
    `id_route`            varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=0;";
	
    $config['install'][1] = "INSERT INTO `modulos` (`id`, `modulo`, `titulo`, `ordem`, `tipo`, `modulo_base`)
                             VALUES (NULL,
                                     '".$config['module']."',
                                     '".$config['module_title']."',
                                     NULL,
                                     '".$config['module_type']."',
                                     '".$config['module_base']."'
                                    );";
    
//######################| FIM DO MÓDULO |####################################

?>