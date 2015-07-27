<?php
//######################| INICIO DO MÓDULO |####################################

    //######################| Config |####################################

    $config['module']           = 'depoimentos';
    $config['module_title']     = 'Depoimentos';
    $config['model']            = '';
    $config['table']            = 'depoimentos';
        
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

    $config['campos']['nome'] = array();
    $config['campos']['nome']['id']                         = 'nome';
    $config['campos']['nome']['type']                       = 'text';
    $config['campos']['nome']['hidden']                     = false;
    $config['campos']['nome']['txt']                        = 'Nome';
    $config['campos']['nome']['required']                   = true;
    $config['campos']['nome']['listagem']                   = true;

    $config['campos']['conteudo'] = array();
    $config['campos']['conteudo']['id']                         = 'conteudo';
    $config['campos']['conteudo']['type']                       = 'text';
    $config['campos']['conteudo']['hidden']                     = false;
    $config['campos']['conteudo']['txt']                        = 'Depoimento';
    $config['campos']['conteudo']['required']                   = true;
    $config['campos']['conteudo']['listagem']                   = true;

    $config['campos']['empresa'] = array();
    $config['campos']['empresa']['id']                         = 'empresa';
    $config['campos']['empresa']['type']                       = 'text';
    $config['campos']['empresa']['hidden']                     = false;
    $config['campos']['empresa']['txt']                        = 'Empresa';
    $config['campos']['empresa']['required']                   = true;
    $config['campos']['empresa']['listagem']                   = true;

    $config['campos']['foto'] = array();
    $config['campos']['foto']['id']                         = 'foto';
    $config['campos']['foto']['type']                       = 'image'; 
    $config['campos']['foto']['hidden']                     = false;
    $config['campos']['foto']['txt']                        = 'Foto';
    $config['campos']['foto']['required']                   = true;
    $config['campos']['foto']['n_images']                   = '1';
    $config['campos']['foto']['listagem']                   = true;
    
    //######################| FILTROS |####################################
    
    $config['filtro'] = array();
        
    //######################| Instalação |####################################

    $config['install'] = array();
    
        
    $config['install'][0] = "CREATE TABLE IF NOT EXISTS `".$config['table']."` (
    
    `id`    int(255) NOT NULL AUTO_INCREMENT,
    `ativo` int(255) DEFAULT NULL,
    `order` int(255) DEFAULT NULL,
    
    `nome` 				varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `conteudo`          longtext COLLATE latin1_general_ci DEFAULT NULL,
    `empresa`              varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `foto`              varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    
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