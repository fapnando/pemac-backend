<?php $this->load->view( ADMIN_VIEW.'layouts/header'); ?>

<script> 
	var id_galeria = '';
	var info = {};
	var path = '<?php echo $path_module; ?>/';
	var path_module = "<?php echo ci_site_url($module); ?>";
	var basepath = '<?php echo base_url(); ?>';
	var module = '<?php echo $module; ?>';
</script>

<button class="btn btn-success right right20 left20 top20 " data-toggle="modal" data-target="#novo">
	<span class="glyphicon glyphicon-plus-sign"></span> Novo
</button>
<h2 class="right"><?php echo $module_title; ?></h2>

<?php     
	if(isset($novo)){
		$this->load->view( MODULES.$module.'/views/novo');
	}
	else{
		$this->load->view( ADMIN_VIEW.'layouts/novo'); 
	}     
?>

<div id="lista">	 
	<?php	 
	if(isset($lista)){
		$this->load->view( MODULES.$module.'/views/lista');
 	}
 	else{
		$this->load->view( ADMIN_VIEW.'layouts/lista'); 
 	}	 
 	?>	 
</div>
<script>
	<?php
	foreach($filtro as $item){
	 	if($item['type'] == 'like'){
			echo "info['".$item['id']."'] = new Array($('#filter_".$item['id']."').val(),'".$item['field']."','".$item['type']."','".$item['id']."'); \n";
		}
		if($item['type'] == 'select'){
			echo "info['".$item['id']."'] = $('#filter_".$item['id']."').val(); \n";   
		}
		if($item['type'] == 'date'){
			echo "info['data'] = new Array($('#filter_data').val(),'".$item['field']."','".$item['type']."','".$item['id']."'); \n";
		}
	}
	?>
</script>

<?php $this->load->view( ADMIN_VIEW.'layouts/footer'); ?>