<?php
//######################| INICIO DO MÓDULO |####################################

    //######################| Config |####################################

    $config['module']           = 'contato';
    $config['module_title']     = 'Contato';
    $config['model']            = '';
    $config['table']            = 'contato';
        
    $config['base']             = 'padrao';
    $config['index']            = 'padrao';
    $config['layout']           = 'table';

    $config['exportar']         = 'false';
    $config['module_type']      = 'normal'; // normal - submodulo
    $config['module_base']      = 'nenhum'; // nome do modulo base. 'nenhum' caso module_type = 'normal'
    
    //######################| Campos |####################################
    
    $config['campos'] = array();

    $config['campos']['nome'] = array();
    $config['campos']['nome']['id']                         = 'nome';
    $config['campos']['nome']['type']                       = 'text';
    $config['campos']['nome']['hidden']                     = false;
    $config['campos']['nome']['txt']                        = 'Nome';
    $config['campos']['nome']['required']                   = true;
    $config['campos']['nome']['listagem']                   = true;

    $config['campos']['email'] = array();
    $config['campos']['email']['id']                         = 'email';
    $config['campos']['email']['type']                       = 'text';
    $config['campos']['email']['hidden']                     = false;
    $config['campos']['email']['txt']                        = 'Email';
    $config['campos']['email']['required']                   = true;
    $config['campos']['email']['listagem']                   = true;

    $config['campos']['telefone'] = array();
    $config['campos']['telefone']['id']                         = 'telefone';
    $config['campos']['telefone']['type']                       = 'text';
    $config['campos']['telefone']['hidden']                     = false;
    $config['campos']['telefone']['txt']                        = 'Telefone';
    $config['campos']['telefone']['required']                   = true;
    $config['campos']['telefone']['listagem']                   = true;

    $config['campos']['assunto'] = array();
    $config['campos']['assunto']['id']                         = 'assunto';
    $config['campos']['assunto']['type']                       = 'text';
    $config['campos']['assunto']['hidden']                     = false;
    $config['campos']['assunto']['txt']                        = 'Assunto';
    $config['campos']['assunto']['required']                   = true;
    $config['campos']['assunto']['listagem']                   = true;

    $config['campos']['empresa'] = array();
    $config['campos']['empresa']['id']                         = 'empresa';
    $config['campos']['empresa']['type']                       = 'text';
    $config['campos']['empresa']['hidden']                     = false;
    $config['campos']['empresa']['txt']                        = 'Empresa';
    $config['campos']['empresa']['required']                   = true;
    $config['campos']['empresa']['listagem']                   = true;

    $config['campos']['mensagem'] = array();
    $config['campos']['mensagem']['id']                       = 'mensagem';
    $config['campos']['mensagem']['type']                     = 'wys';
    $config['campos']['mensagem']['hidden']                   = false;
    $config['campos']['mensagem']['txt']                      = 'Mensagem';
    $config['campos']['mensagem']['required']                 = false;
    
    //######################| FILTROS |####################################
    
    $config['filtro'] = array();
        
    //######################| Instalação |####################################

    $config['install'] = array();
    
        
    $config['install'][0] = "CREATE TABLE IF NOT EXISTS `".$config['table']."` (
    
    `id`    int(255) NOT NULL AUTO_INCREMENT,
    `ativo` int(255) DEFAULT NULL,
    `order` int(255) DEFAULT NULL,
    
    `nome` 				varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `email`                varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `telefone`                varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `assunto`                varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `empresa`                varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
    `mensagem`              longtext COLLATE latin1_general_ci DEFAULT NULL,
    
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