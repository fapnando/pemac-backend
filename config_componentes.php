<?php

/*****************************************
******** FILTROS *************
*****************************************/

    $config['filtro']['titulo'] = array();
    $config['filtro']['titulo']['id']     = 'titulo';
    $config['filtro']['titulo']['type']   = 'like';
    $config['filtro']['titulo']['field']  = 'titulo';
    $config['filtro']['titulo']['titulo'] = 'Título';

    $config['filtro']['relate'] = array();
    $config['filtro']['relate']['id']     = 'relate';
    $config['filtro']['relate']['type']   = 'select';
    $config['filtro']['relate']['field']  = 'relate';
    $config['filtro']['relate']['titulo'] = 'Relate';

/*****************************************
**************** CAMPOS ******************
*****************************************/

    /******** Itens de config comuns entre componentes ********
        
        
        String      id          =   Identificação do campo no codeigniter e no banco de dados
        String      type        =   Tipo de campo do componente
        Boolean     hidden      =   caso TRUE, oculta o campo tanto la listagem quanto no modal
        String      txt         =   label do campo. Aparecera como título do campo ao cadastrar e editar
        Boolean     required    =   caso TRUE, fica obrigatório o preenchimento ao inserir ou editar um registro
        Boolean     listagem    =   se FALSE, o campo aparece apenas no modal.

    */

//============================================================================================================



    /***** tags *******/ 
    $config['campos']['id_campo'] = array();
    $config['campos']['id_campo']['id']                           = 'id_campo';
    $config['campos']['id_campo']['type']                         = 'tags';
    $config['campos']['id_campo']['hidden']                       = false;
    $config['campos']['id_campo']['txt']                          = 'texto';
    $config['campos']['id_campo']['required']                     = true;
    $config['campos']['id_campo']['listagem']                     = true;

//============================================================================================================

    /***** Textarea *******/
    $config['campos']['texto'] = array();
    $config['campos']['texto']['id']                           = 'texto';
    $config['campos']['texto']['type']                         = 'textarea';
    $config['campos']['texto']['hidden']                       = false;
    $config['campos']['texto']['txt']                          = 'texto';
    $config['campos']['texto']['required']                     = true;
    $config['campos']['texto']['listagem']                     = true;

//============================================================================================================

	/***** Ativo *******/ 
	$config['campos']['ativo']['id']                          = 'ativo';
    $config['campos']['ativo']['type']                        = 'onoff';
    $config['campos']['ativo']['hidden']                      = false;
    $config['campos']['ativo']['txt']                         = 'Ativo';
    $config['campos']['ativo']['required']                    = true;
    $config['campos']['ativo']['listagem']                    = true;
    
//============================================================================================================

	/***** Sexo *******/ 
    $config['campos']['sexo']['id']                           = 'sexo';
    $config['campos']['sexo']['type']                         = 'sexo';
    $config['campos']['sexo']['hidden']                       = false;
    $config['campos']['sexo']['txt']                          = 'Sexo';
    $config['campos']['sexo']['required']                     = true;
    $config['campos']['sexo']['listagem']                     = true;

//============================================================================================================

	/***** Text *******/ 
    $config['campos']['nome'] = array();
    $config['campos']['nome']['id']                           = 'nome';
    $config['campos']['nome']['type']                         = 'text';
    $config['campos']['nome']['hidden']                       = false;
    $config['campos']['nome']['txt']                          = 'Nome';
    $config['campos']['nome']['required']                     = true;
    $config['campos']['nome']['listagem']                     = true;
    
//============================================================================================================

    /******** Rota ********

        String      rota          =   URL padrão que será associada ao slug. Será acrescentado o id do registro no final da URL
        String      campo         =   Campo que sera utilizado para montar o slug
        String      prefix        =   Prefixo que virá antes do slug na URL. FALSE caso não use prefix

            http://localhost:8888/site/PREFIXO/slug
    */
    $config['campos']['id_route'] = array();
    $config['campos']['id_route']['id']                       = 'id_route';
    $config['campos']['id_route']['type']                     = 'rota';
    $config['campos']['id_route']['hidden']                   = false;
    $config['campos']['id_route']['txt']                      = 'Rota';
    $config['campos']['id_route']['required']                 = true;
    $config['campos']['id_route']['rota']                     = 'nomeDoModulo/nomeDoMetodo/';
    $config['campos']['id_route']['campo']                    = 'nomeDoCampo';
    $config['campos']['id_route']['prefix']                   = false;
    $config['campos']['id_route']['listagem']                 = true;

//============================================================================================================

    /******** Image ********

        String      n_images          =   Número máximo de imagens permito para upload
    */
    $config['campos']['images'] = array();
    $config['campos']['images']['id']                         = 'images';
    $config['campos']['images']['type']                       = 'image'; 
    $config['campos']['images']['hidden']                     = false;
    $config['campos']['images']['txt']                        = 'Imagem';
    $config['campos']['images']['required']                   = true;
    $config['campos']['images']['n_images']                   = '1';
    $config['campos']['images']['listagem']                   = true;

//============================================================================================================

    /******** Upload ********

        String      n_files          =   Número máximo de arquivos permito para upload
    */
    $config['campos']['upload'] = array();
    $config['campos']['upload']['id']                         = 'upload';
    $config['campos']['upload']['type']                       = 'upload';
    $config['campos']['upload']['hidden']                     = false;
    $config['campos']['upload']['txt']                        = 'Upload';
    $config['campos']['upload']['required']                   = true;
    $config['campos']['upload']['n_files']                    = '1';
    $config['campos']['upload']['listagem']                   = true;
    
//============================================================================================================

    /******** Select ********

        Boolean      fk               =   Se TRUE, os dados podem ter relacionamento uns com os outros na mesma tabela
        Boolean      multiple         =   se TRUE, habilita a seleção de mais de um item na lista
        Array        options          =   Opções que aparecerão na lista

            ['options']['VALOR_A_SER_GRAVADO_NO BANCO']     = ['VALOR_MOSTRADO_NA_LISTA']
    */
    $config['campos']['id_campo'] = array();
    $config['campos']['id_campo']['id']                         = 'id_campo';
    $config['campos']['id_campo']['type']                       = 'select';
    $config['campos']['id_campo']['hidden']                     = false;
    $config['campos']['id_campo']['txt']                        = 'Select';
    $config['campos']['id_campo']['required']                   = true;
    $config['campos']['id_campo']['fk']                         = false;
    $config['campos']['id_campo']['multiple']                   = false;
    $config['campos']['id_campo']['listagem']                   = true;
    $config['campos']['id_campo']['options']                    = array();
    $config['campos']['id_campo']['options']['0']               = '-';
    $config['campos']['id_campo']['options']['1']               = '1';
    $config['campos']['id_campo']['options']['2']               = '2';
    
//============================================================================================================

    /******** Relate ********

        String          tabela          =   Tabela onde será buscado os dados para a lista
        String          campo           =   Campo utilizado para preencher a lista
        Boolean         fk              =   Se TRUE, os dados podem ter relacionamento uns com os outros na mesma tabela
        Boolean         multiple        =   se TRUE, habilita a seleção de mais de um item na lista
        Boolean/String  condicional     =   Nome do campo (relate) utilizado para filtrar os dados deste campo ou FALSE, caso não seja condicional
    */
    $config['campos']['id_campo'] = array();
    $config['campos']['id_campo']['id']                         = 'id_campo';
    $config['campos']['id_campo']['type']                       = 'relate';
    $config['campos']['id_campo']['hidden']                     = false;
    $config['campos']['id_campo']['relate']['tabela']           = 'tabela';
    $config['campos']['id_campo']['relate']['campo']            = 'campo';
    $config['campos']['id_campo']['txt']                        = 'relate';
    $config['campos']['id_campo']['required']                   = true;
    $config['campos']['id_campo']['fk']                         = false;
    $config['campos']['id_campo']['multiple']                   = false;
    $config['campos']['id_campo']['listagem']                   = true;
    $config['campos']['id_campo']['condicional']                = false;

//============================================================================================================

    /***** Galeria *******/ 
    $config['campos']['galeria'] = array();
    $config['campos']['galeria']['id']                        = 'galeria';
    $config['campos']['galeria']['type']                      = 'galeria';
    $config['campos']['galeria']['hidden']                    = false;
    $config['campos']['galeria']['txt']                       = 'Galeria';
    $config['campos']['galeria']['required']                  = true;
    $config['campos']['galeria']['listagem']                  = true;

//============================================================================================================

    /***** Repositorio *******/ 
    $config['campos']['repositorio'] = array();
    $config['campos']['repositorio']['id']                    = 'repositorio';
    $config['campos']['repositorio']['type']                  = 'repositorio';
    $config['campos']['repositorio']['hidden']                = false;
    $config['campos']['repositorio']['txt']                   = 'Repositorio';
    $config['campos']['repositorio']['required']              = true;
    $config['campos']['repositorio']['listagem']              = true;

//============================================================================================================

    /***** Wys *******/ 
    $config['campos']['conteudo'] = array();
    $config['campos']['conteudo']['id']                       = 'conteudo';
    $config['campos']['conteudo']['type']                     = 'wys';
    $config['campos']['conteudo']['hidden']                   = false;
    $config['campos']['conteudo']['txt']                      = 'Conteúdo';
    $config['campos']['conteudo']['required']                 = false;

//============================================================================================================

    /***** Video *******

        String      origem               = Origem do video

            'youtube', 'vimeo', 'local'
    */
    $config['campos']['video'] = array();
    $config['campos']['video']['id']                          = 'video';
    $config['campos']['video']['type']                        = 'video';
    $config['campos']['video']['origem']                      = 'youtube';
    $config['campos']['video']['hidden']                      = false;
    $config['campos']['video']['txt']                         = 'Link do vídeo';
    $config['campos']['video']['required']                    = true;

//============================================================================================================

    /***** Date *******/ 
    $config['campos']['data'] = array();
    $config['campos']['data']['id']                           = 'data';
    $config['campos']['data']['type']                         = 'date';
    $config['campos']['data']['hidden']                       = false;
    $config['campos']['data']['txt']                          = 'Data';
    $config['campos']['data']['required']                     = true;
    $config['campos']['data']['listagem']                     = true;

//============================================================================================================

    /***** Time *******/ 
    $config['campos']['hora'] = array();
    $config['campos']['hora']['id']                           = 'hora';
    $config['campos']['hora']['type']                         = 'time';
    $config['campos']['hora']['hidden']                       = false;
    $config['campos']['hora']['txt']                          = 'Hora';
    $config['campos']['hora']['required']                     = true;
    $config['campos']['hora']['listagem']                     = true;

//============================================================================================================

    /***** Senha *******/
    $config['campos']['senha'] = array();
    $config['campos']['senha']['id']                           = 'senha';
    $config['campos']['senha']['type']                         = 'senha';
    $config['campos']['senha']['hidden']                       = false;
    $config['campos']['senha']['txt']                          = 'Senha';
    $config['campos']['senha']['required']                     = true;

    $config['campos']['salt'] = array();
    $config['campos']['salt']['id']                           = 'salt';
    $config['campos']['salt']['type']                         = 'hidden';
    $config['campos']['salt']['hidden']                       = true;
    $config['campos']['salt']['txt']                          = 'salt';
    $config['campos']['salt']['required']                     = true;

    //============================================================================================================

    /****** Button de Exportação ******

        String      color               = Cor do botão (opções disponíveis no bootstrap)

            cinza           =   'default'
            azul            =   'primary'
            verde           =   'success'
            azul claro      =   'info'
            amarelo         =   'warning'
            vermelho        =   'danger'

        String      icon                = Ícone que aparecerá no botão (Ver glyphicon do bootstrap)
        String      controller_link     = link do controller/metodo a ser chamado
        Array       controller_params   = Lista de parametros a ser passado para o controller

            campo_pk        = nome do campo que contem o id
            campo_pk_titulo = nome do campo usado para substituir o id no excel
            module_fk       = modulo onde será buscado os dados
            campo_fk        = nome do campo onde contém a correspondência do id
            campos_exibicao = nomes dos campos a serem exibido e exportados

        OBS: 

            Parâmetros recebidos atrés do método POST: $var = $this->input->post('campo_pk');
    */
    $config['campos']['botao'] = array();
    $config['campos']['botao']['id']                                  = 'botao';
    $config['campos']['botao']['type']                                = 'button';
    $config['campos']['botao']['button_type']                         = 'export';
    $config['campos']['botao']['hidden']                              = false;
    $config['campos']['botao']['txt']                                 = 'Ver Projetos';
    $config['campos']['botao']['config']['color']                     = 'primary';
    $config['campos']['botao']['config']['icon']                      = 'th';
    $config['campos']['botao']['controller_link']                     = 'button/index';
    $config['campos']['botao']['controller_param'] = array();
    $config['campos']['botao']['controller_param']['campo_pk']        = 'id';
    $config['campos']['botao']['controller_param']['campo_pk_titulo'] = 'nome';
    $config['campos']['botao']['controller_param']['module_fk']       = 'projetos';
    $config['campos']['botao']['controller_param']['campo_fk']        = 'adm_responsavel';
    $config['campos']['botao']['controller_param']['campos_exibicao'] = array('titulo, adm_responsavel');
    $config['campos']['botao']['required']                            = true;
    $config['campos']['botao']['listagem']                            = true;

//============================================================================================================

    /******** Button de Edição ********

        String      color               = Cor do botão (opções disponíveis no bootstrap)

            cinza           =   'default'
            azul            =   'primary'
            verde           =   'success'
            azul claro      =   'info'
            amarelo         =   'warning'
            vermelho        =   'danger'

        String      icon                = Ícone que aparecerá no botão (Ver glyphicon do bootstrap)
        String      controller_link     = link do controller/metodo a ser chamado
        Array       controller_params   = Lista de parametros a ser passado para o controller

            module_fk = modulo onde será buscado os dados
            campo_fk  = nome do campo onde contém a correspondência do id
        
        OBS:
            module_fk PRECISA SER MX_Controller

            Parâmetros recebidos atrés do método POST: $var = $this->input->post('campo_pk');
    */
    $config['campos']['botao'] = array();
    $config['campos']['botao']['id']                                  = 'botao';
    $config['campos']['botao']['type']                                = 'button';
    $config['campos']['botao']['button_type']                         = 'edit';
    $config['campos']['botao']['hidden']                              = false;
    $config['campos']['botao']['txt']                                 = 'Editar Diretor';
    $config['campos']['botao']['config']['color']                     = 'primary';
    $config['campos']['botao']['config']['icon']                      = 'th';
    $config['campos']['botao']['controller_link']                     = 'button/edit';
    $config['campos']['botao']['controller_param'] = array();
    $config['campos']['botao']['controller_param']['module_fk']       = 'diretores';
    $config['campos']['botao']['controller_param']['campo_fk']        = 'diretor';
    $config['campos']['botao']['required']                            = true;
    $config['campos']['botao']['listagem']                            = true;

//============================================================================================================

    /******** Button de Associação ********

        String      color               = Cor do botão (opções disponíveis no bootstrap)

            cinza           =   'default'
            azul            =   'primary'
            verde           =   'success'
            azul claro      =   'info'
            amarelo         =   'warning'
            vermelho        =   'danger'

        String      icon                = Ícone que aparecerá no botão (Ver glyphicon do bootstrap)
        String      controller_link     = link do controller/metodo a ser chamado
        Array       controller_params   = Lista de parametros a ser passado para o controller

            module_fk           = modulo onde será buscado os dados
            campo_fk            = campo que será exibido no modal para o usuário
            tabela_associativa  = nome da tabela que relaciona os dois modulos
            campo_ass_pk        = chave estrangeira do modulo atual na tabela associativa
            campo_ass_fk        = chave estrangeira do module_fk na tabela associativa
        
        OBS:
            Necessário primeiramente criar a tabela associativa, contendo as respectivas chaves estrangeiras
            Parâmetros recebidos atrés do método POST: $var = $this->input->post('campo_pk');
    */
    $config['campos']['botao'] = array();
    $config['campos']['botao']['id']                                     = 'botao';
    $config['campos']['botao']['type']                                   = 'button';
    $config['campos']['botao']['button_type']                            = 'associar';
    $config['campos']['botao']['hidden']                                 = false;
    $config['campos']['botao']['txt']                                    = 'Des/associar Breja';
    $config['campos']['botao']['config']['color']                        = 'success';
    $config['campos']['botao']['config']['icon']                         = 'th';
    $config['campos']['botao']['controller_link']                        = 'button/monta_modal_associacao';
    $config['campos']['botao']['controller_param'] = array();
    $config['campos']['botao']['controller_param']['module_fk']          = 'brejas';
    $config['campos']['botao']['controller_param']['campo_fk']           = 'titulo';
    $config['campos']['botao']['controller_param']['tabela_associativa'] = 'ass_pack_brejas';
    $config['campos']['botao']['controller_param']['campo_ass_pk']       = 'id_pack';
    $config['campos']['botao']['controller_param']['campo_ass_fk']       = 'id_breja';
    $config['campos']['botao']['required']                               = true;
    $config['campos']['botao']['listagem']                               = true;

//============================================================================================================

    /******** Createtime *********/
    $config['campos']['createtime'] = array();
    $config['campos']['createtime']['id']                               = 'createtime';
    $config['campos']['createtime']['type']                             = 'createtime';
    $config['campos']['createtime']['txt']                              = 'Data de Criação';
    $config['campos']['createtime']['hidden']                           = false;
    $config['campos']['createtime']['listagem']                         = true;

//============================================================================================================

    /******** Updatetime *********/
    $config['campos']['updatetime'] = array();
    $config['campos']['updatetime']['id']                               = 'updatetime';
    $config['campos']['updatetime']['type']                             = 'updatetime';
    $config['campos']['updatetime']['txt']                              = 'Ultima Atualização';
    $config['campos']['updatetime']['hidden']                           = false;
    $config['campos']['updatetime']['listagem']                         = true;

?>