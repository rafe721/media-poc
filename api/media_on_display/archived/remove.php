<?php
require_once("config/db.php");
require_once("classes/models/Display.php");
require_once("classes/dataSources/DBManager.php");

$usersManager = new DBManager();
$display = new Display;
$display->setDisplayId($id);
$display->remove();

echo "Display with ID: ".$id." Removed";
?>