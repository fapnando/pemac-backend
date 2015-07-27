<h1>pagina geral de servicos</h1>

<?php	
	foreach($this->data->servicos as $servico){
		echo '<a href="'.$servico['link'].'">'.$servico['titulo'].'</a>';
	}
?>