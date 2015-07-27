<?php

class Upload extends CI_Controller {

	function __construct()
	{
	    parent::__construct();
	}

    function listar(){
        $module = $this->input->post('module');
        $field = $this->input->post('field');
        $id    = $this->input->post('id');

        $files = $this->crud->select_by_array($module, array('id' => $id), array($field));
        $files = $files[0][$field];
        
        $html = '';
        if($files == ''){
            $html .= '<div align="center">
                        <p>Nenhum arquivo enviado</p>
                    </div>';
        }
        else{
            $html .= '<table id="lista_arquivos_upload_'.$field.'_table" class="table" style="margin: 0px;">';
            $files = explode(';', $files);
            foreach($files as $file){
                $html .= '  <tr>
                                <td>'.$file.'</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-mini deleteFile_upload_'.$field.'" data-id="'.$id.'" data-file="'.$file.'">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </td>
                            </tr>';
            }
            
            $html .= '</table>';
        }
        echo $html;
    }

    function listar_somente_leitura(){
        $module = $this->input->post('module');
        $field = $this->input->post('field');
        $id    = $this->input->post('id');

        $files = $this->crud->select_by_array($module, array('id' => $id), array($field));
        $files = $files[0][$field];
        
        $html = '';
        if($files == ''){
            $html .= '<div align="center">
                        <p>Nenhum arquivo enviado</p>
                    </div>';
        }
        else{
            $html .= '<table id="lista_arquivos_upload_'.$field.'_table" class="table" style="margin: 0px;">';
            $files = explode(';', $files);
            foreach($files as $file){
                $html .= '  <tr>
                                <td>'.$file.'</td>
                            </tr>';
            }
            
            $html .= '</table>';
        }
        echo $html;
    }
    
    function index(){
        $arrayArquivos = Array();

        $id = $_POST['id'];
        $field = $_POST['field'];
        $module = $_POST['module'];
        
        $upload_path = 'uploads';
        $module_path = 'uploads/'.$module.'/';

        $arquivosAtuais = $this->crud->select_by_array($module, array('id' => $id), array($field));
        $arquivosAtuais = explode(';', $arquivosAtuais[0][$field]);

        if(!file_exists($upload_path)){
            mkdir($upload_path);    
        }
        if(!file_exists($module_path)){
            mkdir($module_path);
        }

        foreach($_FILES as $array){
            $totalArquivos = sizeof($array['name']);

            for($i = 0; $i < $totalArquivos; $i++){
                $temp['name'] = $array['name'][$i];
                $temp['type'] = $array['type'][$i];
                $temp['tmp_name'] = $array['tmp_name'][$i];
                $temp['error'] = $array['error'][$i];
                $temp['size'] = $array['size'][$i];

                array_push($arrayArquivos, $temp);
            }
        }

        foreach($arrayArquivos as &$arquivo){

            $name = $arquivo['name'];
       
            $e = explode('.', $name);
            $t = sizeof($e);

            $ext = $e[$t-1];
            $newName = md5($name.time()).'.'.$ext;

            $file_new_path = $module_path.$newName;

            if(move_uploaded_file($arquivo['tmp_name'], $file_new_path)){
               array_push($arquivosAtuais, $newName);
            }
            $arquivo['new_name'] = $newName;
            $arquivo['id'] = $id;
        }
        
        $arquivosString = '';
        foreach($arquivosAtuais as $a){
            $arquivosString .= $a.';';
        }

        
        $data['id'] = $id;
        $data[$field] = trim($arquivosString, ';');

        $this->crud->update($module, $data);

        echo json_encode($arrayArquivos);

    }

    function delete(){
        $id = $_POST['id'];
        $file = $_POST['file'];
        $module = $_POST['module'];
        $field = $_POST['field'];

        $arquivos = $this->crud->select_by_array($module, array('id' => $id), array($field));
        $arquivos = explode(';', $arquivos[0][$field]);

        $stringNova = '';
        foreach($arquivos as $arquivo){
            if($arquivo != $file){
                $stringNova .= $arquivo.';';
            }
        }

        $file_path = 'uploads/'.$module.'/'.$file;

        if(file_exists($file_path)){
            unlink($file_path);
        }

        $data['id'] = $id;
        $data[$field] = trim($stringNova, ';');

        $this->crud->update($module, $data);

        echo 'true';
    }

    function upload_repositorio(){
        $arrayArquivos = Array();

        $id = $_POST['id'];
        $module = $_POST['module'];

        $upload_path = 'uploads';
        $module_path = 'uploads/'.$module.'/';

        if(!file_exists($upload_path)){
                mkdir($upload_path);    
        }
        if(!file_exists($module_path)){
            mkdir($module_path);
        }

        foreach($_FILES as $array){
            $totalArquivos = sizeof($array['name']);

            for($i = 0; $i < $totalArquivos; $i++){
                $arquivo['name'] = $array['name'][$i];
                $arquivo['type'] = $array['type'][$i];
                $arquivo['tmp_name'] = $array['tmp_name'][$i];
                $arquivo['error'] = $array['error'][$i];
                $arquivo['size'] = $array['size'][$i];

                array_push($arrayArquivos, $arquivo);
            }
        }

        foreach($arrayArquivos as &$arquivo){

            $name = $arquivo['name'];
       
            $e = explode('.', $name);
            $t = sizeof($e);

            $ext = $e[$t-1];
            $newName = md5($name.time()).'.'.$ext;

            $file_new_path = $module_path.$newName;

            if(move_uploaded_file($arquivo['tmp_name'], $file_new_path)){
                $data['module'] = $module;
                $data['pk'] = $id;
                $data['name'] = $name;
                $data['new_name'] = $newName;
                $data['size'] = $arquivo['size'];

                $arquivo['id'] = $this->crud->save('repositorio', $data);
            }
            $arquivo['new_name'] = $newName;
        }

        echo 'true';
    }
        
    function delete_repositorio(){
        $id = $_POST['id'];

        $file = $this->crud->select_by_array('repositorio', array('id' => $id));
        $file = $file[0];

        $file_path = 'uploads/'.$file['module'].'/'.$file['new_name'];

        if(file_exists($file_path)){
            unlink($file_path);
        }

        $this->crud->delete('repositorio', array('id' => $id));

        echo 'true';
    }

    function listar_repositorio(){
        $module = $this->input->post('module');
        $pk     = $this->input->post('id');

        $repositorio = $this->crud->select_by_array('repositorio', array('module' => $module, 'pk' => $pk));

        $html = '';
        if(sizeof($repositorio) == 0){
            $html .= '<div align="center">
                        <p>Nenhum arquivo enviado</p>
                    </div>';
        }
        else{

            $html = '<table class="table">
                        <tr>    
                            <td style="width: 20%;">Nome</td>
                            <td style="width: 60%;">Nome Original</td>
                            <td style="width: 10%;">Tamanho</td>
                            <td style="width: 10%;">-</td>
                        </tr>';

            foreach($repositorio as $arquivo){
                $html .= '<tr id="arquivo_'.$arquivo['id'].'">    
                                <td style="width: 20%;">'.$arquivo['new_name'].'</td>
                                <td style="width: 60%;">'.$arquivo['name'].'</td>
                                <td style="width: 10%;">~'.number_format(($arquivo['size']/1000000), 2).' MB</td>
                                <td style="width: 10%;">
                                    <button type="button" class="btn btn-danger btn-mini deleteFile_repositorio" data-id="'.$arquivo['id'].'"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>';
            }

            $html .= '</table>';
        }

        echo $html;
    }

    function listar_repositorio_somente_leitura(){
        $module = $this->input->post('module');
        $pk     = $this->input->post('id');

        $repositorio = $this->crud->select_by_array('repositorio', array('module' => $module, 'pk' => $pk));

        $html = '';
        if(sizeof($repositorio) == 0){
            $html .= '<div align="center">
                        <p>Nenhum arquivo enviado</p>
                    </div>';
        }
        else{

            $html = '<table class="table">
                        <tr>    
                            <td style="width: 20%;">Nome</td>
                            <td style="width: 70%;">Nome Original</td>
                            <td style="width: 10%;">Tamanho</td>
                        </tr>';

            foreach($repositorio as $arquivo){
                $html .= '<tr id="arquivo_'.$arquivo['id'].'">    
                                <td style="width: 20%;">'.$arquivo['new_name'].'</td>
                                <td style="width: 70%;">'.$arquivo['name'].'</td>
                                <td style="width: 10%;">~'.number_format(($arquivo['size']/1000000), 2).' MB</td>
                            </tr>';
            }
            $html .= '</table>';
        }
        echo $html;
    }
}
?>