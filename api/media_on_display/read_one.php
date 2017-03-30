<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include_once '../config/database.php'; 
// include_once '../objects/product.php'; 

require_once("../classes/models/Display.php");
// require_once("../classes/models/MediaOnDisplay.php");

// get id of product to be edited
// $data = json_decode(file_get_contents("php://input"));

$display = new Display();  

$display->displayId = $_GET["id"];

// echo $display->display_id;

$display->read();

$mediaList = $display->getMediaNames();
$count = 1;
$slotList = array();
while ($count <= $display->slotCount) {
	if (array_key_exists($count, $mediaList)) {
		$slot = array(
			"slot_no" => $count,
			"media_id" => $mediaList[$count]["media_id"],
			"media_name" => $mediaList[$count]["media_name"]
		);
	} else {
		$slot = array(
			"slot_no" => $count,
			"media_id" => "Empty",
			"media_name" => "Empty"
		);
	}
	array_push($slotList, $slot);
	$count++;
}

// create array
$display_arr[] = array(
    "display_id" =>  $display->displayId,
    "display_name" => $display->displayName,
    "slot_count" => $display->slotCount,
    "reg_code" => $display->regCode,
	"slots" => $slotList
);

// json format output
// make it json format
print_r(json_encode($display_arr));
