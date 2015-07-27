<?php $this->load->view( PUBLIC_VIEW.'layouts/header'); ?>

<h1>Olá <?php echo $this->data->conteudo->nome; ?></h1>
<a href="<?php echo ci_site_url('logout'); ?>">[ Sair ]</a>

<?php $this->load->view( PUBLIC_VIEW.'layouts/footer'); ?>