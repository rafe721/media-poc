<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include_once '../config/database.php'; 
// include_once '../objects/product.php'; 

require_once("../classes/models/Media.php");
require_once('../../assets/getid3/getid3.php');
// require_once("../classes/models/MediaOnDisplay.php");

// get id of product to be edited
// $data = json_decode(file_get_contents("php://input"));

$media = new Media();

$media->mediaId = $_GET["id"];

// echo $display->display_id;

$media->read();

$filedir = "uploads/";
$mime = mime_content_type("../../".$filedir.$media->fileName);
$info = new SplFileInfo("../../".$filedir.$media->fileName);
$play_length = "undetermined";
$owner = "You";

if (strpos($mime, '/') !== false) {
	$mime = substr($mime, 0, strpos($mime, '/'));
}

if (strpos($mime, 'video') !== false) {
	$getID3 = new getID3;
	$file = $getID3->analyze("../../".$filedir.$media->fileName);
	if (array_key_exists ('playtime_string',$file)) {
		$play_length = $file['playtime_string'];
	}
} else if (strpos($mime, 'image') !== false) {
	$play_length = "User Defined";
}



// create array
$media_arr[] = array(
    "media_id" =>  $media->mediaId,
    "media_name" => $media->mediaName,
	"extension" => $info->getExtension(),
	"play_length" => $play_length,
	"mime" => $mime,
    "file_path" => "uploads/".$media->fileName,
	"owner" => $owner
);

// json format output
// make it json format
print_r(json_encode($media_arr));
