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
$display->displayId = $display_id;
$display->read();

$mediaList = $display->getMediaNames();
?>

<b>Display Name: </b>
<a href="#" onclick="showUpdateDisplayForm( <?php echo $display_id; ?> ,'#popupContact')"> Change Details </a>
<a href="#" onclick="showDeleteDisplayConfirmation( <?php echo $display_id; ?> ,'#popupContact')"> remove </a>
<P><?php echo $display->getDisplayName(); ?> </p>
<b>Status: </b>
<P><?php echo $display->status; ?> </p>
<b>Reg Code: </b>
<P><?php echo $display->regCode; ?> </p>
<b>Number of Slots: </b>
<P><?php echo $display->slotCount; ?> </p>

<div id="slot_container">
<h3> Available Slots </h3>
<?php 
$slot = 1;
while ($slot <= $display->slotCount) { ?>
<div class="slot">
	<?php if (array_key_exists($slot, $mediaList)) { ?>
		<a href="#" onclick="showSlotUpdate(0, <?php echo $display->displayId; ?>,<?php echo $slot;?>);">clear</a> |
		<a href="#" onclick="showSlotUpdate(<?php echo $mediaList[$slot]["media_id"] ?>, <?php echo $display->displayId; ?>,<?php echo $slot;?>)">change</a> | 
		<a href="#">preview</a><br/>
		<b><?php echo $mediaList[$slot]["media_name"] ?></b>
	<?php } else { ?>
		<a href="#" onclick="showSlotUpdate(0,<?php echo $display->displayId; ?>,<?php echo $slot;?>)">Add</a><br/>
		<b>Empty</b>
	<?php } ?>
<div>
<?php 
$slot++;;
}?>

</div>

<a href="#" class="load_display">Done</a>