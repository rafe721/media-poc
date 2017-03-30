<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


require_once("../classes/models/Media.php");

$selectedMedia = (new Media())->readAll();

$data="";

foreach($selectedMedia as $value) {
	$data .= '{';
            $data .= '"Media_id":"'  . $value->mediaId . '",';
            $data .= '"media_name":"'   . $value->mediaName . '"';
    $data .= '},';
}

// json format output
echo '{"media":[' . rtrim($data,",") . ']}';