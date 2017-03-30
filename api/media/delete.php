<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("../classes/models/Media.php");

$data = json_decode(file_get_contents("php://input"));

$media = new Media();
$media->mediaId = $data->media_id;


$status = "Success";
$message = $media->remove();

// create array
$media_arr[] = array(
	"status" =>  $status,
	"message" => $message
);

// json format output
// make it json format
print_r(json_encode($media_arr));
