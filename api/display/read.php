<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


require_once("../classes/models/Display.php");

$selectedDisplayType = (new Display())->readAll();

$data="";

foreach($selectedDisplayType as $value) {
	$data .= '{';
            $data .= '"display_id":"'  . $value->displayId . '",';
            $data .= '"display_name":"'   . $value->displayName . '"';
    $data .= '},';
}

// json format output
echo '{"records":[' . rtrim($data,",") . ']}';