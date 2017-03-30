<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("../classes/models/Media.php");

$data = json_decode(file_get_contents("php://input"));

$selectedMedia = (new Media())->readLike($data->query);

$data="";
$message="";

if (0 == count($selectedMedia)) {
	$message="\"No Records Found\"";
} else {	
	$message="\"Records Found\"";
	foreach($selectedMedia as $value) {
		$data .= '{';
				$data .= '"media_id":"'  . $value->mediaId . '",';
				$data .= '"media_name":"'   . $value->mediaName . '"';
		$data .= '},';
	}
}

// json format output
echo '{"message":'.$message.',"records":[' . rtrim($data,",") . ']}';