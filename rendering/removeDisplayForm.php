<?php 
require_once("config/db.php");
require_once("classes/models/Display.php");
require_once("classes/dataSources/DBManager.php");

$usersManager = new DBManager();
$display = new Display;

if ("" != $id){
	$display->setDisplayId($id);
	$display = $usersManager->getRecord($display);
	$hidden = "<input type=\"hidden\" name=\"id\" value=\"".$id."\">";
	$button = "<button type=\"button\" onclick=\"updateDisplay('#operation_container')\" class=\"next action-button\">Update Display</button>";
	$selectedSlot = $display->getSlotCount();
}

?>
<form action="" id="msform">
	<fieldset class="dialog">
		<img src="popup_close.png" id="close" onclick="div_hide()"> <!-- Close button -->
		Display Name: 
		Registration Code: 
		This device will no longer be able to do stuff
		<button type="button" onclick="removeDisplay( <?php echo $id;?>,'#operation_container')" class="next action-button">Remove Display</button>
	</fieldset>
</form> 
