<?php
//######################| INICIO DO MÓDULO |####################################

    //######################| Config |####################################

    $config['module']           = 'servicos';
    $config['module_title']     = 'Serviços';
    $config['model']            = '';
    $config['table']            = 'servicos';
        
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
    $config['campos']['id_route']['rota']                     = 'servicos/ver/';
    $config['campos']['id_route']['campo']                    = 'titulo';
    $config['campos']['id_route']['prefix']                   = false;
    $config['campos']['id_route']['listagem']                 = true;

    $config['campos']['modelo'] = array();
    $config['campos']['modelo']['id']                         = 'modelo';
    $config['campos']['modelo']['type']                       = 'select';
    $config['campos']['modelo']['hidden']                     = false;
    $config['campos']['modelo']['txt']                        = 'Select';
    $config['campos']['modelo']['required']                   = true;
    $config['campos']['modelo']['fk']                         = false;
    $config['campos']['modelo']['multiple']                   = false;
    $config['campos']['modelo']['listagem']                   = true;
    $config['campos']['modelo']['options']                    = array();
    $config['campos']['modelo']['options']['0']               = '-';
    $config['campos']['modelo']['options']['1']               = 'Modelo 1';
    $config['campos']['modelo']['options']['2']               = 'Modelo 2';
    $config['campos']['modelo']['options']['3']               = 'Modelo 3';
    
    //######################| FILTROS |####################################
    
    $config['filtro'] = array();
        
    //######################| Instalação |####################################

    $config['install'] = array();
    
        
    $config['install'][0] = "CREATE TABLE IF NOT EXISTS `".$config['table']."` (
    
    `id`    int(255) NOT NULL AUTO_INCREMENT,
    `ativo` int(255) DEFAULT NULL,
    `order` int(255) DEFAULT NULL,
    
    `titulo` 				varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `conteudo`              longtext COLLATE latin1_general_ci DEFAULT NULL,
    `id_route`              varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `modelo`                varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    
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