<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("../classes/models/Display.php");

$data = json_decode(file_get_contents("php://input"));

$currentSlot = new MediaOnDisplay( $data->media_id, $data->display_id, $data->slot_no);
$op_status = $currentSlot->update();

$slot[] = array();
if ("Operation Successful" == $op_status) {
	$display = new Display();
	$display->displayId = $data->display_id;
	$slot = $display->getMediaName($data->slot_no);
}

$status = "Success";
$message = $op_status;

// create array
$response_arr[] = array(
	"status" =>  $status,
	"message" => $slot["media_name"],
	"slot" => $slot
);

// json format output
// make it json format
print_r(json_encode($response_arr));
