<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("../classes/models/MediaOnDisplay.php");

$aSlot = new MediaOnDisplay();

$data = json_decode(file_get_contents("php://input"));

$aSlot->displayId = $data->display_id;	
$aSlot->slotNo = $data->slot_no;
$aSlot->mediaId = $data->media_id;

$aSlot->update();

$slot_arr = $aSlot->getSlotDetails();
// get userId From Session

// get The Slot Details


// json format output
print_r(json_encode($slot_arr));
