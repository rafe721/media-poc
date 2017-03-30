<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


require_once("../classes/models/MediaOnDisplay.php");

$data = (new MediaOnDisplay())->getUserSlotList();

/* foreach($selectedDisplayType as $value) {
	$data .= '{';
            $data .= '"display_id":"'  . $value->displayId . '",';
            $data .= '"display_name":"'   . $value->displayName . '"';
    $data .= '},';
}
 */
 
$slot_arr[] = array(
	"records" => $data
);

// json format output
// make it json format
print_r(json_encode($slot_arr));
