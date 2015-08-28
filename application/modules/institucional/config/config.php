<?php
//######################| INICIO DO MÓDULO |####################################

    //######################| Config |####################################

    $config['module']           = 'institucional';
    $config['module_title']     = 'Institucional';
    $config['model']            = '';
    $config['table']            = 'institucional';
        
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

    $config['campos']['conteudo'] = array();
    $config['campos']['conteudo']['id']                         = 'conteudo';
    $config['campos']['conteudo']['type']                       = 'wys';
    $config['campos']['conteudo']['hidden']                     = false;
    $config['campos']['conteudo']['txt']                        = 'Conteúdo';
    $config['campos']['conteudo']['required']                   = true;
    $config['campos']['conteudo']['listagem']                   = true;

    $config['campos']['images'] = array();
    $config['campos']['images']['id']                         = 'images';
    $config['campos']['images']['type']                       = 'image'; 
    $config['campos']['images']['hidden']                     = false;
    $config['campos']['images']['txt']                        = 'Imagem';
    $config['campos']['images']['required']                   = true;
    $config['campos']['images']['n_images']                   = '1';
    $config['campos']['images']['listagem']                   = true;
    
    //######################| FILTROS |####################################
    
    $config['filtro'] = array();
        
    //######################| Instalação |####################################

    $config['install'] = array();
    
        
    $config['install'][0] = "CREATE TABLE IF NOT EXISTS `".$config['table']."` (
    
    `id`    int(255) NOT NULL AUTO_INCREMENT,
    `ativo` int(255) DEFAULT NULL,
    `order` int(255) DEFAULT NULL,
    
    `images`                varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `conteudo` 				longtext COLLATE latin1_general_ci DEFAULT NULL,
    
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