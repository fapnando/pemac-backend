var page = 1;
var id_pk = 0;
var modal_opened = false;

//############################################
//##########| Controle de Registros /############
//############################################
    
//Gravar um novo registro
$('body').delegate("#novo #submit", "click", function(){
    tinymce.triggerSave();

    $.post(path + "add", $('#novo').serialize() )
    .done(function(data) {

        if(data == 'true'){
            $('#novo').modal('hide');
            //$('#novo')[0].reset();
            $('#novo').each(function(){
              this.reset();
            });
            listarDados($(this));
        }else{
            alert('Erro: ' + data);
        }
    });
});

//Apagar um registro do modulo
$('body').delegate(".confirm-delete", "click", function(e) {
    var id = $(this).data('id');
    
    bootbox.dialog({
        message: "Tem certeza que deseja excluir este item?",
        title: "Excluir item",
        buttons: {
            success: {
                label: "Cancelar",
                className: "btn",
                callback: function() {
                    //Example.show("great success");
                }
            },
            danger: {
            label: "Excluir",
            className: "btn-danger",
            callback: function() {    
                $.post(path + "delete", { id: id })
                .done(function(data) {
                    if(data == 'true'){
                        listarDados($(this));
                    }
                    else{
                        alert('Ocorreu um erro!');
                    }
                });
            }
          }
        }
    }); 
});

//trigger de paginação
$('body').delegate(".pag_teste", "click", function(e){
    listarDados($(this));
});

//Atualiza a lista de dados 
function listarDados(elem){
    $(".loading").removeClass('hide');
    var id = elem.attr('id');
    if(id != 'botao_voltar'){
        if(elem.data('page') != 'undefined'){
            page = elem.data('page');
        }else{
            page = 1;
        }
    }

    $.each( info, function( key, value ) {  
        if(info[key][2] == 'like'){
            info[key][0] = $('#filter_'+info[key][3]).val();
        }
        if(info[key][2] == 'select'){
            info[key][0] = $('#filter_'+info[key][3]).val();
        }
        if(info[key][2] == 'date'){
            info[key][0] = $('#filter_data').val();
        }
    });

    $.ajax({
        url: path_module + "/admin/listar",
        type: "POST",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: { fields: info, page: page, perpage: $('#perpage').val(), order: $('#order').val(), order_side: $('#order_side').val(), layout: $('#layout').val() },
        dataType: "html",
        success: function(data){
            $('#indices').off();
            $('#indices').html('');
            $('#indices').html(data);
            $(".loading").addClass('hide');
            $('#div_layout').removeClass();
            $('#div_layout').addClass($('#layout').val());
        }
    });
}

$(document).on('click', '.botao-bloco.editar', function(e){
    e.preventDefault();

    $('.loading').removeClass('hide');
    id_pk = $(this).data('id');

    $.ajax({
        url: path_module + "/admin/detalhamento",
        type: "POST",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: {id: id_pk },
        dataType: "html",
        success: function(data){
            
            
            $('.modal-bloco').html(data);
            $('.modal-bloco .relate').each(function(){
                $(this).attr('data-valor_atual', $(this).val());
            });

            $('.modal-bloco .relate').each(function(){
                var id = $(this).attr('id');
                if($(this).hasClass('condicional')){
                    var valor_atual = ($('#'+id).data('valor_atual') != undefined) ? $('#'+id).data('valor_atual').toString() : "0";
                    
                    var novo_valor = valor_atual.split(',');
                    for(var v in novo_valor){
                        $('#'+id+' option[value='+novo_valor[v]+']').attr('selected', true);
                    }

                    $('#'+id).multiselect('refresh');
                    $('#'+id).trigger('change');
                }
                else{
                    $('#'+id).trigger('change');
                }
            });
            
            $('.loading').addClass('hide');
            $('#item'+id_pk).removeClass('unflipped').addClass('flipped');
            open_close_modalDetalhamento($(this));
            $('.btn-save-relate').addClass('hide');
        }
    });
});

$(document).on('click', '.modal-bloco .voltar', function(e){
    e.preventDefault();
    open_close_modalDetalhamento($(this));
});

function open_close_modalDetalhamento(elem){
    if(!modal_opened){
        $('.modal-bloco').removeClass('flipped').addClass('unflipped');
        modal_opened = true;
    }
    else{
        listarDados(elem);
        $('.modal-bloco').html('');
        $('.bloco').removeClass('flipped').addClass('unflipped');
        $('.modal-bloco').removeClass('unflipped').addClass('flipped');
        modal_opened = false;
    }
}

    
//############################################
//##########| Controle de Rotas /############
//############################################

function makeSlug(slug){
    if(slug == ''){
        return '';
    }
    else{
        var new_slug = slug.toLowerCase();
        var lista = {
            a: ['á', 'à', 'ã', 'â', 'å'],
            e: ['é', 'è', 'ê'],
            i: ['í', 'ì', 'î'],
            o: ['ó', 'ò', 'õ', 'ô'],
            u: ['ú', 'ù', 'û'],
            c: ['ç']
        };

        for(var key in lista){
            for(var letra of lista[key]){
                new_slug = new_slug.replace(letra, key);
            }
        }

        new_slug = new_slug.replace(/\s/g,'-');

        var n = [];
        for(var l in new_slug){
            if(new_slug[l] == '-'){
                if(new_slug[parseInt(l)+1] != '-'){
                    n.push(new_slug[l]);
                }
            }
            else{
                n.push(new_slug[l]);
            }
        }
        
        if(n[0] == '-'){n.shift()};
        if(n[n.length - 1] == '-'){n.pop()};

        new_slug = n.toString('');
        new_slug = new_slug.replace(/,/g,'');
        return new_slug;
    }
}

//############################################
//##########| Listagem /############
//############################################

//Função do botão ativo na listagem
$('body').delegate(".ativar", "click", function(e){
    e.preventDefault();
    v = 1;
    if($(this).hasClass('butativo')){
        v = 0;
    }

    $.post(path+"update", { name: "ativo", value: v, pk : $(this).data('pk'), type: 'onoff' } )
        .done(function(data) {
    
        if(data == "true"){
            
        }else{
            alert("Erro: " + data);
        }
    });

    $(this).toggleClass('butativo');

});

$('body').delegate("#exportar", "click", function(e) {
    e.preventDefault();
    $('.loading').removeClass('hide');
    //page = $(this).data('page');
    $.ajax({
        url: path_module+"/admin/listar/exportar",
        type: "POST",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: { fields: info, page: false, perpage: $('#perpage').val(), order: $('#order').val(), order_side: $('#order_side').val() },
        dataType: "html",
        success: function(data) {
            $('.loading').addClass('hide');
            $('#modalDownload .modal-body').html('<p>Arquivo gerado com sucesso. Faça o download do arquivo clicando no botão abaixo.</p><a href="'+basepath+data+'"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-download"></span> Download</button></a>');
            $('#modalDownload').modal('show');
        }
    });
});

$('body').delegate('#btn_fechar_modalButton', 'click', function(e){
    e.preventDefault;
    $('#modalButton .modal-body').off();
    $('#modalButton .modal-body').html('');


})

//############################################
//##########| Controle de Upload /############
//############################################

function checarUpload(btnFile, btnEnviar){
    var total = parseInt(btnFile.data('nfiles'));
    var qtdeAtual = parseInt(btnFile.data('qtdeatual'));
    
    if(qtdeAtual == total){
        btnFile.attr('disabled', true);
        btnEnviar.attr('disabled', true);
    }
    else{
        btnFile.attr('disabled', false);
        btnEnviar.attr('disabled', false);   
    }
}

    