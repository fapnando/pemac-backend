<style>
	.atual{
		background: #7e7e7e !important;
    	color: #fff !important;
	} 
</style>

<div class="right wrap top20 bottom20">
  	<ul class="right pagination pagination-small">
	<?php 
	if($page != '1'){
		echo '<li id="pagina_anterior" class="pag_teste" data-page="'.($page-1).'"><a  href="#"> < </a></li>';
	} 

	for($i = ($page-5); $i<$page; $i++){
	    if($i > 0){
			echo '<li id="pagina_'.$i.'" class="pag_teste" data-page="'.$i.'"><a href="#">'.$i.'</a></li>';
	    }
	}

	echo '<li id="pagina_'.$page.'" class="pag_teste" data-page="'.$page.'"><a class="atual" href="#">'.$page.'</a></li>';

	for($i=($page+1);$i<($page+6);$i++){
		if($i <= $pages){
	    	echo '<li id="pagina_'.$i.'" class="pag_teste" data-page="'.$i.'"><a href="#">'.$i.'</a></li>';
	  	}
	}

	if($page != $pages){
		echo '<li id="proxima_pagina" class="pag_teste" data-page="'.($page+1).'"><a style="margin-top: 0px;" class="pagination" href="#">></a></li>';
	  
	} 
	?>
   	</ul>
  	<p class="left left20 top20" style="font-size: 10px;">Total de itens encontrados: <?php echo $total; ?>. Mostrando página <?php echo $page; ?> de <?php echo $pages; ?></p>
</div>