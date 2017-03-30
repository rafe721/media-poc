<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("../classes/models/Display.php");

$data = json_decode(file_get_contents("php://input"));

$selectedDisplayType = (new Display())->readLike($data->query);

$data="";
$message="";

if (0 == count($selectedDisplayType)) {
	$message="\"No Records Found\"";
} else {	
	$message="\"Records Found\"";
	foreach($selectedDisplayType as $value) {
		$data .= '{';
				$data .= '"display_id":"'  . $value->displayId . '",';
				$data .= '"display_name":"'   . $value->displayName . '"';
		$data .= '},';
	}
}

// json format output
echo '{"message":'.$message.',"records":[' . rtrim($data,",") . ']}';