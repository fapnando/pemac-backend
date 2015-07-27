<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class video extends CI_Controller{

	function __construct(){
	    parent::__construct();
	}

	function index(){
		$module = $this->input->post('module');
        $field = $this->input->post('field');
        $id    = $this->input->post('id');

        $video = $this->crud->select_by_id($module, $id, array($field));
       
        $html = '';
        if($video[$field] == ''){
            $html .= '<div align="center">
            			<p>Nenhum vídeo cadastrado</p>
            		</div>';
        }
        else{
        	$html .= '<video src="'.base_url('uploads/'.$module.'/'.$video[$field]).'" controls width="587" height="336" style="background-color: black !important;"> Your browser does not support the <code>video</code> element. </video>
        			<button class="btn btn-mini btn-danger delete_video"><span class="glyphicon glyphicon-trash"></span></button>';
        }

        echo $html;
	}

	function upload(){
		$id = $_POST['id'];
        $field = $_POST['field'];
        $module = $_POST['module'];
        
        $upload_path = 'uploads';
        $module_path = 'uploads/'.$module.'/';

        if(!file_exists($upload_path)){
            mkdir($upload_path);    
        }
        if(!file_exists($module_path)){
            mkdir($module_path);
        }

        $video_ant = $this->crud->select_by_id($module, $id, array($field));
        if($video_ant[$field] != ''){
        	$file_path = 'uploads/'.$module.'/'.$video_ant[$field];

        	if(file_exists($file_path)){
            	unlink($file_path);
            }
        }
        
        foreach($_FILES as $video){
        	if($video['error'] == 0){
        		$ext = array_pop(explode('.', $video['name']));
        		$newName = md5($video['name'].time()).'.'.$ext;

        		$file_new_path = $module_path.$newName;

        		if(move_uploaded_file($video['tmp_name'], $file_new_path)){
	              	$data['id'] 	= $id;
			        $data[$field] 	= $newName;

					$this->crud->update($module, $data);

					echo json_encode(array('newVideoPath' => $file_new_path));
	            }
        	}
        }
	}

	function delete(){
		$id = $_POST['id'];
        $field = $_POST['field'];
        $module = $_POST['module'];

        $video = $this->crud->select_by_id($module, $id, array($field));

        $file_path = 'uploads/'.$module.'/'.$video[$field];

        if(file_exists($file_path)){
            unlink($file_path);
        }

        $data['id'] 	= $id;
        $data[$field] 	= '';

        $this->crud->update($module, $data);

        echo 'true';
	}
}
?>