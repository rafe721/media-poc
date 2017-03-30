<?php
require_once("config/db.php");
require_once("classes/models/Display.php");
require_once("classes/dataSources/DBManager.php");

$usersManager = new DBManager();
$display = new Display;

$hidden = "";
$button = "<button type=\"button\" onclick=\"insertDisplay('#operation_container')\" class=\"next action-button\">Add Display</button>";
$selectedSlot = 2;
if ("" != $id){
	$display->setDisplayId($id);
	$display = $usersManager->getRecord($display);
	$hidden = "<input type=\"hidden\" name=\"id\" value=\"".$id."\">";
	$button = "<button type=\"button\" onclick=\"updateDisplay('#operation_container')\" class=\"next action-button\">Update Display</button>";
	$selectedSlot = $display->getSlotCount();
}
$allowedSlots = 6;

?>
<form action="" id="msform">
	<fieldset class="dialog">
		<img src="popup_close.png" id="close" onclick="div_hide()"> <!-- Close button -->
		<?php echo $hidden;?>
		<input type="text" name="reg_code" placeholder="Registration Code" value="<?php echo $display->getRegCode();?>"><br>
		<input type="text" name="display_name" placeholder="Display name" value="<?php echo $display->getDisplayName();?>"><br>
		<select name="slot_count">
			<option value="0">Number of Slots</option>
			<?php 
				$count = 1;
				while ($count <= $allowedSlots) {
					// $option = "<option value=\"1\" >1</option>";
					$option = "<option ";
					$option .= "value=\"".$count."\" ";
					($count==$selectedSlot)?$option .=" Selected" : $option.="";
					$option .= ">".$count."</option>";
					echo $option;
					$count++;
				}
			?>
			<!-- <option value="1" >1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="3">4</option>
			<option value="3">5</option>
			<option value="3">6</option> -->
		</select>
		<!-- <button type="button" onclick="insertDisplay('#operation_container')" class="next action-button">Add Display</button> -->
		<?php echo $button;?>
	</fieldset>
</form> 

