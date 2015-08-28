<?php
//######################| INICIO DO MÓDULO |####################################

    //######################| Config |####################################

    $config['module']           = 'projetos';
    $config['module_title']     = 'Projetos';
    $config['model']            = '';
    $config['table']            = 'projetos';
        
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
    $config['campos']['conteudo']['txt']                      = 'Descrição';
    $config['campos']['conteudo']['required']                 = false;

    $config['campos']['cliente'] = array();
    $config['campos']['cliente']['id']                         = 'cliente';
    $config['campos']['cliente']['type']                       = 'relate';
    $config['campos']['cliente']['hidden']                     = false;
    $config['campos']['cliente']['relate']['tabela']           = 'clientes';
    $config['campos']['cliente']['relate']['campo']            = 'titulo';
    $config['campos']['cliente']['txt']                        = 'Cliente';
    $config['campos']['cliente']['required']                   = true;
    $config['campos']['cliente']['fk']                         = false;
    $config['campos']['cliente']['multiple']                   = false;
    $config['campos']['cliente']['listagem']                   = true;
    $config['campos']['cliente']['condicional']                = false;
    
    //######################| FILTROS |####################################
    
    $config['filtro'] = array();
        
    //######################| Instalação |####################################

    $config['install'] = array();
    
        
    $config['install'][0] = "CREATE TABLE IF NOT EXISTS `".$config['table']."` (
    
    `id`    int(255) NOT NULL AUTO_INCREMENT,
    `ativo` int(255) DEFAULT NULL,
    `order` int(255) DEFAULT NULL,
    
    `titulo` 				varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `conteudo`                varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `cliente`                int(255) COLLATE latin1_general_ci DEFAULT NULL,
    
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