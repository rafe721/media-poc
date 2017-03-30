<?php
	require_once("config/db.php");
	require_once("classes/models/Media.php");
	require_once("classes/dataSources/DBManager.php");

$usersManager = new DBManager();
$media = new Media;

if(isset($_FILES['upload'])){
	// only first file considered
	$file = $_FILES['upload']['name'][0];
    $file_loc = $_FILES['upload']['tmp_name'][0];
	$file_size = $_FILES['upload']['size'][0];
	$file_type = $_FILES['upload']['type'][0];
	echo "File Name: ". $file . "\n";
	echo "File Loc : ". $file_loc . "\n";
	echo "File Size: ". $file_size . "\n";
	echo "File Type: ". $file_type . "\n";
	echo "Selected File name: ". $_POST['filename'] . "\n";
	$folder="uploads/";
	
	if (!file_exists($folder)) {
		mkdir($folder, 0777, true);
	}
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
 
	// make file name in lower case
	$new_file_name = strtolower($_POST['filename']);
	// make file name in lower case
 
	$final_file=str_replace('_','-',$new_file_name);
	
	/*$media->setMediaName($final_file);
	$media->setTypeId(0);
	$media->setLocationId(0);
	$usersManager->addRecord($media);
 
	move_uploaded_file($file_loc,$folder.$final_file); */
		
	echo "I find your lack of awesomeness disturbing. \n";
	
}

// echo $usersManager->deleteRecord($media);
echo "Media with ID: Created Removed";
?>