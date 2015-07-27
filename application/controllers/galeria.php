<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class galeria extends CI_Controller{

	protected $allowed_ext = array('jpg','jpeg','png','gif');
	
	function __construct(){
	    parent::__construct();
	}

	function upload(){
		$data['module'] = $_POST['module'];
		$data['pk'] 	= $_POST['id'];
		$data['data'] 	= date('Y-m-d H:i:s');

		$upload_path = 'uploads';
        $galeria_path = 'uploads/galeria/';

        if(!file_exists($upload_path)){
            mkdir($upload_path, 0777, true);    
        }
        if(!file_exists($galeria_path)){
            mkdir($galeria_path, 0777, true);
        }

		$array_images = array();
		foreach($_FILES as $array){
            $totalArquivos = sizeof($array['name']);

            for($i = 0; $i < $totalArquivos; $i++){
                $temp['name'] = $array['name'][$i];
                $temp['type'] = $array['type'][$i];
                $temp['tmp_name'] = $array['tmp_name'][$i];
                $temp['error'] = $array['error'][$i];
                $temp['size'] = $array['size'][$i];

                $array_images[] = $temp;
            }
        }

        foreach($array_images as $image){
        	$ext = array_pop(explode('.', $image['name']));
        	if(in_array($ext, $this->allowed_ext)){
        		$data['file'] = md5($image['name'].time()).'.'.$ext;

				$file_path = $galeria_path.$data['file'];
				if(move_uploaded_file($image['tmp_name'], $file_path)){
					$this->crud->save('galeria', $data);
				}	
        	}
        }

        echo 'true';
	}
	
	function listar(){
		$module = $this->input->post('module');
		$pk 	= $this->input->post('id');
		
		$galeria = $this->crud->select_by_array('galeria', array('module' => $module, 'pk' => $pk), false, false, 'id', 'DESC');

		$html = '';
		if(sizeof($galeria) == 0){
			$html .= '<div align="center">
						<p>Nenhuma imagem cadastrada</p>
					</div>';
		}
		else{
			$col = 1;
			foreach($galeria as $image){
				if($col == 1){
					$html .= '<div class="row">';
				}
				$html .= '<div class="col-sm-6 col-md-4" style="">
							   	<div class="thumbnail">
							   		<div style="width: 242px; height: 200px; text-align: center;">
							    		<img width="190px" src="'.base_url('uploads/galeria/'.$image['file']).'">
							    	</div>
							      	<div class="caption" align="center">
							        	<a href="#" id="image_galeria_'.$image['id'].'" class="edit img_galeria" data-type="textarea" data-name="'.$image['file'].'" data-pk="'.$image['id'].'" data-url="'. base_url() .'galeria/alterar_legenda">'.$image['legenda'].'</a>
							        </div>
							        <button class="btn btn-mini btn-danger delete_galeria" data-id="'.$image['id'].'"><span class="glyphicon glyphicon-trash"></span></button>
							    </div>
							</div>';


				if($col == 3){
					$html .= '</div>';
					$col = 1;
				}else{
					$col++;
				}
			}
			$html .= '<script>
						$(".img_galeria").editable();
					</script>';
		}

		echo $html;
	}

	function listar_somente_leitura(){
		$module = $this->input->post('module');
		$pk 	= $this->input->post('id');
		
		$galeria = $this->crud->select_by_array('galeria', array('module' => $module, 'pk' => $pk));

		$html = '';
		if(sizeof($galeria) == 0){
			$html .= '<div align="center">
						<p>Nenhuma imagem cadastrada</p>
					</div>';
		}
		else{
			$col = 1;
			foreach($galeria as $image){
				if($col == 1){
					$html .= '<div class="row">';
				}
				$html .= '<div class="col-sm-6 col-md-4" style="">
							   	<div class="thumbnail">
							   		<div style="width: 242px; height: 200px; text-align: center;">
							    		<img width="190px" src="'.base_url('uploads/galeria/'.$image['file']).'">
							    	</div>
							      	<div class="caption" align="center">
							        	<a href="#" id="image_galeria_'.$image['id'].'" class="edit img_galeria" data-type="textarea">'.$image['legenda'].'</a>
							        </div>
							    </div>
							</div>';


				if($col == 3){
					$html .= '</div>';
					$col = 1;
				}else{
					$col++;
				}
			}
			$html .= '<script>
						$(".img_galeria").editable({
							disabled: true
						});
					</script>';
		}

		echo $html;
	}

	function alterar_legenda(){
		$data['id'] = $_POST['pk'];
		$data['legenda'] = $_POST['value'];

		$this->crud->update('galeria', $data);
		echo 'true';
	}
	
	function delete(){
		$id = $this->input->post('id');
		
		$file = $this->crud->select_by_array('galeria', array('id' => $id), array('file'));
		 
		$file_path =  'uploads/galeria/'.$file[0]['file'];
		$thumbnail_path =  'uploads/galeria/thumbnail/'.$file[0]['file'];
		
		if(file_exists($file_path)){
			unlink($file_path);
		}
		
		if(file_exists($thumbnail_path)){
			unlink($thumbnail_path);
		}

		$this->crud->delete('galeria', array('id' => $id));
		echo 'true';
	}
} 