<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller {

	public function index($model=''){
        $dir = 'application/modules/'.$model;
        if (!file_exists($dir)){    
			mkdir($dir, 0777, true);
			mkdir($dir.'/config', 0777, true);
			mkdir($dir.'/controllers', 0777, true);
			mkdir($dir.'/views', 0777, true);
		
			$file = 'application/controllers/marty/files/config.php';
			$newfile = $dir.'/config/config.php';

			if (!copy($file, $newfile)) {
			    echo "Erro ao copiar $file to $newfile\n";
			}

			$file = 'application/controllers/marty/files/admin.php';
			$newfile = $dir.'/controllers/admin.php';

			if (!copy($file, $newfile)) {
			    echo "Erro ao copiar $file to $newfile\n";
			}

			$file = 'application/controllers/marty/files/controller.php';
			$newfile = $dir.'/controllers/'.$model.'.php';

			if (!copy($file, $newfile)) {
			    echo "Erro ao copiar $file to $newfile\n";
			}

			echo "Modulo criado com sucesso | <a href='".ci_site_url('install/'.$model)."'>Instalar</a>";
		
		}
		else{
			echo "Modulo ja existe | <a href='".ci_site_url('admin/'.$model)."'>Acessar</a>";
		}
	}
}
