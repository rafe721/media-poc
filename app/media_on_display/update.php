<?php

require_once("config/db.php");
require_once("classes/models/MediaOnDisplay.php");
require_once("classes/dataSources/DBManager.php");

/* Get Media_id from request if available */
$media_id = 0; // represents what is in the UI at the time of request
if (isset($_GET["media_id"])) {
	$media_id = $_GET["media_id"]; // populate from POST
} elseif (isset($_POST["media_id"])) {
	$media_id = $_POST["media_id"]; // populate from GET
}

/* Get display_id from _GET if available */
$display_id = 0; // display @ the UI
if (isset($_GET["display_id"])) {
	$display_id = $_GET["display_id"]; // populate from POST
} elseif (isset($_POST["display_id"])) {
	$display_id = $_POST["display_id"]; // populate from GET
}

/* Get Media_id from _GET if available */
$slot_no = 0; // slot no at the User 
if (isset($_GET["slot_no"])) {
	$slot_no = $_GET["slot_no"]; // populate from POST
} elseif (isset($_POST["slot_no"])) {
	$slot_no = $_POST["slot_no"]; // populate from GET
}

$currentSlot = new MediaOnDisplay( $media_id, $display_id, $slot_no);
$currentSlot->readMedia();
$actionMessage = "";
if (0 == $currentSlot->mediaId && 0 !=$media_id) {
	$actionMessage = "Media was added to the slot Successfully";
} elseif (0 != $currentSlot->mediaId && 0==$media_id) {
	$actionMessage = "The Slot was cleared";
} else {
	$actionMessage = "the Slot was replaced with new media";
}
?>

<form action="" id="msform">
	<fieldset class="dialog">
		<img src="popup_close.png" id="close" onclick="div_hide()"> <!-- Close button -->
		<?php 
			echo "Media No: ".$media_id. "<br/>";
			echo "Slot No: ".$slot_no. "<br/>";
			echo "Display Id: ".$display_id. "<br/>";

			$status = (new MediaOnDisplay( $media_id, $display_id, $slot_no))->update();
			
			echo $actionMessage;
		?>
		<button type="button" onclick="div_hide()" class="next action-button">Thanks</button>
	</fieldset>
</form> 
