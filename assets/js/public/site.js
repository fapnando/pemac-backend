var destino_conteudo = $('#content');

function check_href(){
	window.onpopstate = function(event) {
		getContent(location.href, destino_conteudo);
    };

    var pathname = location.pathname; 
    pathname = pathname.split(LOCAL_SITE_NAME);
    pathname = (pathname.length == 1) ? pathname[0] : pathname.pop();
    
    if(pathname.split('/').length == 2){
    	if(pathname.split('/').pop() != ''){
    		getContent(location.href, destino_conteudo);
    	}
    }
    else if(pathname.split('/').length > 2){
		getContent(location.href, destino_conteudo);
    }
    
}

function getContent($url, $destino, $data){
	$url_ajax = $url.split(LOCAL_SITE_NAME);
	$url_ajax = ($url_ajax.length == 1) ? $url_ajax[0] : $url_ajax.pop();
	$url_ajax = BASE_URL + 'ajax' + $url_ajax;
	$.ajax({
		url: $url_ajax,
		type: 'POST',
		dataType: 'html',
		assync: false,
		data: $data,
		success: function(data){
			$destino.html(data);
			history.pushState('', $url, $url);
		},
		error: function(){
			console.log('Houve um erro ao carregar o conteudo solicitado');
		}
	})
}