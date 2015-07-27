<?php
//######################| INICIO DO MÓDULO |####################################

    //######################| Config |####################################

    $config['module']           = 'usuarios';
    $config['module_title']     = 'Usuários';
    $config['model']            = '';
    $config['table']            = 'usuarios';
        
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
    $config['campos']['nome']['id']                           = 'nome';
    $config['campos']['nome']['type']                         = 'text';
    $config['campos']['nome']['hidden']                       = false;
    $config['campos']['nome']['txt']                          = 'Nome';
    $config['campos']['nome']['required']                     = true;
    $config['campos']['nome']['listagem']                     = true;

    $config['campos']['sobrenome'] = array();
    $config['campos']['sobrenome']['id']                      = 'sobrenome';
    $config['campos']['sobrenome']['type']                    = 'text';
    $config['campos']['sobrenome']['hidden']                  = false;
    $config['campos']['sobrenome']['txt']                     = 'sobrenome';
    $config['campos']['sobrenome']['required']                = true;
    $config['campos']['sobrenome']['listagem']                = true;

    $config['campos']['email'] = array();
    $config['campos']['email']['id']                          = 'email';
    $config['campos']['email']['type']                        = 'text';
    $config['campos']['email']['hidden']                      = false;
    $config['campos']['email']['txt']                         = 'E-mail';
    $config['campos']['email']['required']                    = true;
    $config['campos']['email']['listagem']                    = true;

    $config['campos']['senha'] = array();
    $config['campos']['senha']['id']                          = 'senha';
    $config['campos']['senha']['type']                        = 'senha';
    $config['campos']['senha']['hidden']                      = false;
    $config['campos']['senha']['txt']                         = 'Senha';
    $config['campos']['senha']['required']                    = true;
    
    //######################| FILTROS |####################################
    
    $config['filtro'] = array();
        
    //######################| Instalação |####################################

    $config['install'] = array();
    
        
    $config['install'][0] = "CREATE TABLE IF NOT EXISTS `".$config['table']."` (
    
    `id`    int(255) NOT NULL AUTO_INCREMENT,
    `ativo` int(255) DEFAULT NULL,
    `order` int(255) DEFAULT NULL,
    
    `nome` 				longtext COLLATE latin1_general_ci DEFAULT NULL,
    `email`             longtext COLLATE latin1_general_ci DEFAULT NULL,
    `senha`             longtext COLLATE latin1_general_ci DEFAULT NULL,
    `salt`              longtext COLLATE latin1_general_ci DEFAULT NULL,
    `ultimologin`       DATETIME COLLATE latin1_general_ci DEFAULT NULL,
    
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=0;";
	
    $config['install'][1] = "INSERT INTO `modulos` (`id`, `modulo`, `titulo`, `ordem`) VALUES
    (NULL, '".$config['module']."', '".$config['module']."', NULL);";
    
//######################| FIM DO MÓDULO |####################################

?>