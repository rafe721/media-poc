<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


require_once("../classes/models/Media.php");

$selectedDisplayType = (new Media())->readAll();

$data="";

foreach($selectedDisplayType as $value) {
	$data .= '{';
            $data .= '"media_id":"'  . IntVal($value->mediaId) . '",';
            $data .= '"media_name":"'   . $value->mediaName . '"';
    $data .= '},';
}

// json format output
echo '{"records":[' . rtrim($data,",") . ']}';