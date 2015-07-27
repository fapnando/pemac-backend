<?php

//######################| INICIO DO MÓDULO |####################################

    //######################| Config |####################################

    $config['module']       = 'administradores';
    $config['module_title'] = 'Administradores';
    $config['model']        = '';
    $config['table']        = 'administradores';
    
    $config['base']         = 'padrao';
    $config['index']        = 'padrao';
    $config['layout']       = 'table';
    
    $config['exportar']     = 'false';
    $config['module_type']  = 'normal'; // normal - submodulo
    $config['module_base']  = 'nenhum'; // nome do modulo base. 'nenhum' caso module_type = 'normal'

    //######################| Campos |####################################
    
    $config['campos'] = array();

    $config['campos']['ativo']['id']                           = 'ativo';
    $config['campos']['ativo']['type']                         = 'onoff';
    $config['campos']['ativo']['hidden']                       = false;
    $config['campos']['ativo']['txt']                          = 'Ativo';
    $config['campos']['ativo']['required']                     = true;
    $config['campos']['ativo']['listagem']                     = true;

    $config['campos']['nome'] = array();
    $config['campos']['nome']['id']                            = 'nome';
    $config['campos']['nome']['type']                          = 'text';
    $config['campos']['nome']['hidden']                        = false;
    $config['campos']['nome']['txt']                           = 'Nome';
    $config['campos']['nome']['required']                      = true;
    $config['campos']['nome']['listagem']                      = true;
    
    $config['campos']['email'] = array();
    $config['campos']['email']['id']                           = 'email';
    $config['campos']['email']['type']                         = 'text';
    $config['campos']['email']['hidden']                       = false;
    $config['campos']['email']['txt']                          = 'E-mail';
    $config['campos']['email']['required']                     = true;
    $config['campos']['email']['listagem']                     = true;
    
    $config['campos']['senha'] = array();
    $config['campos']['senha']['id']                           = 'senha';
    $config['campos']['senha']['type']                         = 'senha';
    $config['campos']['senha']['hidden']                       = false;
    $config['campos']['senha']['txt']                          = 'Senha';
    $config['campos']['senha']['required']                     = true;
    
    
    //######################| Filtros |####################################
    
    $config['filtro'] = array();
     
//######################| FIM DO MÓDULO |####################################
    
?>