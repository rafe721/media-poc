<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("../classes/models/Display.php");

$data = json_decode(file_get_contents("php://input"));

	$usersManager = new DBManager();

	$display = new Display;
	$display->displayId = $data->display_id;
	
	// $display->update();
	
	$status = "Success";
	// $message = "removing Display";
	$message = $display->remove();
	
	// create array
	$display_arr[] = array(
		"status" =>  $status,
		"message" => $message
	);

	// json format output
	// make it json format
	print_r(json_encode($display_arr));
