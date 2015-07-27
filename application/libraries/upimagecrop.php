<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UpImageCrop {
 
    function upload($upload_dir){
       
        session_start();
        
        if (!isset($_SESSION['random_key']) || strlen($_SESSION['random_key'])==0){
            $_SESSION['random_key'] = strtotime(date('Y-m-d H:i:s')); //assign the timestamp to the session variable
                $_SESSION['user_file_ext']= "";
        }
        
        $upload_path = $upload_dir."/";				// The path to where the image will be saved
       // $image_handling_file = "image_handling.php"; // The location of the file that will handle the upload and resizing (RELATIVE PATH ONLY!)
        $large_image_prefix = "resize_"; 			// The prefix name to large image
        $thumb_image_prefix = "thumbnail_";			// The prefix name to the thumb image
        $large_image_name = $large_image_prefix.$_SESSION['random_key'];     // New name of the large image (append the timestamp to the filename)
        $thumb_image_name = $thumb_image_prefix.$_SESSION['random_key'];     // New name of the thumbnail image (append the timestamp to the filename)
        $max_file = "20";						// Maximum file size in MB
        $max_width = "500";							// Max width allowed for the large image
        $thumb_width = "150";						// Width of thumbnail image
        $thumb_height = "150";						// Height of thumbnail image
        // Only one of these image types should be allowed for upload
        $allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
        $allowed_image_ext = array_unique($allowed_image_types); // Do not change this
        $image_ext = "";
        
        foreach ($allowed_image_ext as $mime_type => $ext) {
            $image_ext.= strtoupper($ext)." ";
        }
        
        $large_image_location = $upload_path.$large_image_name;
        $thumb_image_location = $upload_path.$thumb_image_name;
        
        if(!is_dir($upload_dir)){
                mkdir($upload_dir, 0777);
                chmod($upload_dir, 0777);
        }
        
        if ($_POST["upload"]=="Upload") { 
	//Get the file information
	$userfile_name = $_FILES['image']['name'];
	$userfile_tmp = $_FILES['image']['tmp_name'];
	$userfile_size = $_FILES['image']['size'];
	$userfile_type = $_FILES['image']['type'];
	$filename = basename($_FILES['image']['name']);
	$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	
	//Only process if the file is a JPG and below the allowed limit
	if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
		
		foreach ($allowed_image_types as $mime_type => $ext) {
			//loop through the specified image types and if they match the extension then break out
			//everything is ok so go and check file size
			if($file_ext==$ext && $userfile_type==$mime_type){
				$error = "";
				break;
			}else{
				$error = "Only <strong>".$image_ext."</strong> images accepted for upload<br />";
			}
		}
		//check if the file size is above the allowed limit
		if ($userfile_size > ($max_file*1048576)) {
			$error.= "Images must be under ".$max_file."MB in size";
		}
		
	}else{
		$error= "Please select an image for upload";
	}
	//Everything is ok, so we can upload the image.
	if (strlen($error)==0){
		
		if (isset($_FILES['image']['name'])){
			//this file could now has an unknown file extension (we hope it's one of the ones set above!)
			$large_image_location = $large_image_location.".".$file_ext;
			$thumb_image_location = $thumb_image_location.".".$file_ext;
			
			//put the file ext in the session so we know what file to look for once its uploaded
			if($_SESSION['user_file_ext']!=$file_ext){
				$_SESSION['user_file_ext']="";
				$_SESSION['user_file_ext']=".".$file_ext;
			}
			
			move_uploaded_file($userfile_tmp, $large_image_location);
			chmod($large_image_location, 0777);
			
			$width = $this->getWidth($large_image_location);
			$height = $this->getHeight($large_image_location);
			//Scale the image if it is greater than the width set above
			if ($width > $max_width){
				$scale = $max_width/$width;
				$uploaded = $this->resizeImage($large_image_location,$width,$height,$scale);
			}else{
				$scale = 1;
				$uploaded = $this->resizeImage($large_image_location,$width,$height,$scale);
			}
			//Delete the thumbnail file so the user can create a new one
			if (file_exists($thumb_image_location)) {
				unlink($thumb_image_location);
			}
			echo "success|".$large_image_location."|".$this->getWidth($large_image_location)."|".$this->getHeight($large_image_location);
		}
	}else{
		echo "error|".$error;
	}
        }
        
        ########################################################
        #	CREATE THE THUMBNAIL							   #
        ########################################################
        if ($_POST["save_thumb"]=="Save Thumbnail") { 
                //Get the new coordinates to crop the image.
                $x1 = $_POST["x1"];
                $y1 = $_POST["y1"];
                $x2 = $_POST["x2"];
                $y2 = $_POST["y2"];
                $w = $_POST["w"];
                $h = $_POST["h"];
                //Scale the image to the thumb_width set above
                $large_image_location = $large_image_location.$_SESSION['user_file_ext'];
                $thumb_image_location = $thumb_image_location.$_SESSION['user_file_ext'];
                $scale = $thumb_width/$w;
                $cropped = $this->resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
                echo "success|".$large_image_location."|".$thumb_image_location;
                $_SESSION['random_key']= "";
                $_SESSION['user_file_ext']= "";
        }
        
        #####################################################
        #	DELETE BOTH IMAGES								#
        #####################################################
        if ($_POST['a']=="delete" && strlen($_POST['large_image'])>0 && strlen($_POST['thumbnail_image'])>0){
        //get the file locations 
                $large_image_location = $_POST['large_image'];
                $thumb_image_location = $_POST['thumbnail_image'];
                if (file_exists($large_image_location)) {
                        unlink($large_image_location);
                }
                if (file_exists($thumb_image_location)) {
                        unlink($thumb_image_location);
                }
                echo "success|Files have been deleted";
        }

        
        
       
    }
    
    function resizeImage($image,$width,$height,$scale) {
	$image_data = getimagesize($image);
	$imageType = image_type_to_mime_type($image_data[2]);
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$image); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
    }
	
	chmod($image, 0777);
	return $image;
    }
    
    function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
            list($imagewidth, $imageheight, $imageType) = getimagesize($image);
            $imageType = image_type_to_mime_type($imageType);
            
            $newImageWidth = ceil($width * $scale);
            $newImageHeight = ceil($height * $scale);
            $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
            switch($imageType) {
                    case "image/gif":
                            $source=imagecreatefromgif($image); 
                            break;
                case "image/pjpeg":
                    case "image/jpeg":
                    case "image/jpg":
                            $source=imagecreatefromjpeg($image); 
                            break;
                case "image/png":
                    case "image/x-png":
                            $source=imagecreatefrompng($image); 
                            break;
            }
            imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
            switch($imageType) {
                    case "image/gif":
                            imagegif($newImage,$thumb_image_name); 
                            break;
            case "image/pjpeg":
                    case "image/jpeg":
                    case "image/jpg":
                            imagejpeg($newImage,$thumb_image_name,90); 
                            break;
                    case "image/png":
                    case "image/x-png":
                            imagepng($newImage,$thumb_image_name);  
                            break;
        }
            chmod($thumb_image_name, 0777);
            return $thumb_image_name;
    }
    
    function getHeight($image) {
            $size = getimagesize($image);
            $height = $size[1];
            return $height;
    }
    
    function getWidth($image) {
            $size = getimagesize($image);
            $width = $size[0];
            return $width;
    }

    
}