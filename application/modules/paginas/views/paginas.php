<?php $this->load->view( PUBLIC_VIEW.'layouts/header'); ?>

<h1><?php echo $this->data->conteudo[0]['titulo']; ?></h1>
<p> <?php echo $this->data->conteudo[0]['conteudo']; ?></p>

<?php $this->load->view( PUBLIC_VIEW.'layouts/footer'); ?>