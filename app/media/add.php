<?php

require_once("api/classes/models/Media.php");

if(isset($_FILES['upload'])){
	$media = new Media;
	
	$file = $_FILES['upload']['name'][0];
    $file_loc = $_FILES['upload']['tmp_name'][0];
	$file_size = $_FILES['upload']['size'][0];
	$file_type = $_FILES['upload']['type'][0];
	$media_name = strtolower($_POST['filename']);
	
	$folder="uploads/";
	
	if (!file_exists($folder)) {
		mkdir($folder, 0777, true); // create folder if it doesnot exist.
	}
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
 
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
 
	$final_file=str_replace('_','-',$new_file_name);
	
	$media->mediaName = $media_name;
	$media->fileName = $final_file;
	$status = $media->create();
	
	move_uploaded_file($file_loc,$folder.$final_file);
	
	$media_arr[] = array(
		"file_name" => $file,
		"file_loc" => $file_loc,
		"file_size" => $file_size,
		"file_type" => $final_file,
		"status" => $status
	);
	print_r(json_encode($media_arr));
} else {
	$media_arr[] = array(
		"file_name" =>  "none",
		"file_loc" =>  "none",
		"file_size" => "none",
		"file_type" => "none"
	);
	print_r(json_encode($media_arr));
}
