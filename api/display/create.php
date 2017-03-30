<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("../classes/models/Display.php");

$data = json_decode(file_get_contents("php://input"));

	$usersManager = new DBManager();

	$display = new Display;
	$display->regCode = $data->reg_code;
	$display->displayName = $data->display_name;
	$display->slotCount = $data->slot_count;
	
	//$display->create();
	
	// $display->updateSlots();
	
	$status = "Success";
	$message = $display->create();
	$display->updateSlots();
	// create array
	$display_arr[] = array(
		"status" =>  $status,
		"message" => $message
	);

	// json format output
	// make it json format
	print_r(json_encode($display_arr));
