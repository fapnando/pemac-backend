<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class upimage{

	protected $upload_dir = 'uploads/';
	protected $allowed_ext = array('jpg','jpeg','png','gif');

	public function __construct(){
        $this->CI =& get_instance();
    }

	public function upfile($image, $module){
		set_time_limit(0);
		
		if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
			$this->exit_status('Error! Wrong HTTP method!');
		}
		
		if(array_key_exists('pic',$image) && $image['pic']['error'] == 0 ){
			$image_name = $image['pic']['name'];
			
			if(!in_array($this->get_extension($image_name), $this->allowed_ext)){
				$this->exit_status('Only '.implode(',', $this->allowed_ext).' files are allowed!');
			}

			$this->upload_dir .= $module;
			
			if(!file_exists($this->upload_dir)) {
				mkdir($this->upload_dir, 0777, true);
			}
			
			$new_name = md5($image_name.time()).'.'.$this->get_extension($image_name);

			if(move_uploaded_file($image['pic']['tmp_name'], $this->upload_dir.'/'.$new_name)){
				$this->exit_status('File was uploaded successfuly!', $new_name);
			}
		}

		$this->exit_status('Something went wrong with your upload!','');
	}
	
	protected function exit_status($status, $file = false){
		echo json_encode(array('status' => $status,'file' => $file));
		exit;
	}
	
	protected  function get_extension($file_name){
		$ext = array_pop(explode('.', $file_name));
		return strtolower($ext);
	}
	
	protected function get_filename($file_name){
		$name = array_shift(explode('.', $file_name));
		return $name;
	}
}

?>