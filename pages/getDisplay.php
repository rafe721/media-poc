<?php
require_once("config/db.php");
require_once("classes/models/Display.php");
require_once("classes/dataSources/DBManager.php");

$usersManager = new DBManager();
$display_id = "";
if (isset($_GET["display_id"])) {
	$display_id = $_GET["display_id"];
}
$display = new Display;
$display->setDisplayId($display_id);
$display = $usersManager->getRecord($display);
?>

<b>Display Name: </b>
<a href="#" onclick="showUpdateDisplayForm( <?php echo $display_id; ?> ,'#popupContact')"> Change Details </a>
<a href="#" onclick="showDeleteDisplayConfirmation( <?php echo $display_id; ?> ,'#popupContact')"> remove </a>
<P><?php echo $display->getDisplayName(); ?> </p>
<b>Status: </b>
<P><?php echo $display->getStatus(); ?> </p>
<b>Reg Code: </b>
<P><?php echo $display->getRegCode(); ?> </p>
<b>Number of Slots: </b>
<P><?php echo $display->getSlotCount(); ?> </p>

<a href="#" class="load_display">Done</a>
