<?php
$action="";
if(isset($_GET['action']))
{
	$action = $_GET['action'];
	
	echo "GET Received \n";
}

if(isset($_FILES['upload']))
{	
	$file = rand(1000,100000)."-".$_FILES['upload']['name'][0];
    $file_loc = $_FILES['upload']['tmp_name'][0];
	$file_size = $_FILES['upload']['size'][0];
	$file_type = $_FILES['upload']['type'][0];
	echo "File Name: ". $file . "\n";
	echo "File Loc : ". $file_loc . "\n";
	echo "File Size: ". $file_size . "\n";
	echo "File Type: ". $file_type . "\n";
	$folder="uploads/";
	
	if (!file_exists($folder)) {
		mkdir($folder, 0777, true);
	}
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
 
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
 
	$final_file=str_replace('_','-',$new_file_name);
 
	move_uploaded_file($file_loc,$folder.$final_file);
		
	echo "I find your lack of awesomeness disturbing. \n";
}

if(isset($_POST['reg_code']))
{	
	echo "POST Received \n";
}

echo "HERE";
?>