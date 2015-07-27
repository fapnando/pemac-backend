<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller {

	public function index($model='')
	{		
		$this->load->config(MODULES.$model.'/config/config');
		$querys = $this->config->item('install');
		
		foreach($querys as $query){
			$return = $this->crud->query($query);
		}
		
		redirect('admin/'.$model);
	}
	
	public function base(){
		$querys = array();
		$querys[0] = "CREATE TABLE IF NOT EXISTS `administradores` (
		`id` 		int(255) 	 NOT NULL AUTO_INCREMENT,
		`ativo`     int(255) 	 DEFAULT NULL,
		`order` 	int(255) 	 DEFAULT NULL,
		
		`nome`      varchar(255) DEFAULT NULL,
		`email`     varchar(255) DEFAULT NULL,
		`senha`     varchar(255) DEFAULT NULL,
		`salt`      varchar(255) DEFAULT NULL,
		`acesso`    varchar(255) DEFAULT NULL,
		
		
		PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	    
		$querys[1] = "INSERT INTO `administradores` (`id`, `ativo`, `nome`, `email`, `senha`, `salt`) VALUES
		(1, 1, 'Zebra', 'marty@zebradigital.com.br', '44b2b8afb6cf1fc40fa3e54aff7962f6', '85f970e45e');";
	    
		$querys[2] = "CREATE TABLE IF NOT EXISTS `routes` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `slug` varchar(255) NOT NULL,
		  `route` varchar(32) DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;";
	    
		$querys[3] = "CREATE TABLE IF NOT EXISTS `modulos` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `modulo` varchar(255) NOT NULL,
		  `titulo` varchar(255) DEFAULT NULL,
		  `ordem` varchar(32) DEFAULT NULL,
		  `tipo` varchar(32) DEFAULT NULL,
		  `modulo_base` varchar(255) DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;";
	    
		$querys[4] = "INSERT INTO `modulos` (`id`, `modulo`, `titulo`, `ordem`, `tipo`, `modulo_base`) VALUES
		(1, 'administradores', 'Administradores', NULL, 'normal', 'nenhum');";

		$querys[5] = "CREATE TABLE `galeria` (
		  `id` int(255) NOT NULL AUTO_INCREMENT,
		  `data` longtext,
		  `module` longtext,
		  `pk` longtext,
		  `file` longtext,
		  `legenda` longtext,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
		
		$querys[6] = "CREATE TABLE `repositorio` (
		  `id` int(255) NOT NULL AUTO_INCREMENT,
		  `module` longtext,
		  `pk` int(255),
		  `name` longtext,
		  `new_name` longtext,
		  `size` int(255),

		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

			
		foreach($querys as $query){
			
			$this->crud->query($query);
			
		}
		
		
		echo "MARTY | Base instalada.";
		echo "<br/><br/>";
		echo "<a href='".ci_site_url('admin')."'>Acesse o painel de Administração</a>";

		
	}
	
}
