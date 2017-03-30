<?php 
require_once("config/db.php");
require_once("classes/models/Media.php");
require_once("classes/dataSources/DBManager.php");

$usersManager = new DBManager();
$media = new Media;
$mediaId = "Undefined";
if ("" != $id){
	$mediaId = $id;
	$media->setMediaId($id);
	$media = $usersManager->getRecord($media);
	$hidden = "<input type=\"hidden\" name=\"id\" value=\"".$id."\">";
	$button = "<button type=\"button\" onclick=\"updateDisplay('#operation_container')\" class=\"next action-button\">Update Media</button>";
}

?>
<form action="" id="msform">
	<fieldset class="dialog">
		<img src="popup_close.png" id="close" onclick="div_hide()"> <!-- Close button -->
		Media Name: <?php echo $id; ?> <br/>
		Registration Code: <br/>
		This device will no longer be able to do stuff <br/>
		<button type="button" onclick="removeMedia('<?php echo $id;?>', '#operation_container')" class="next action-button">Remove media</button>
	</fieldset>
</form> 
