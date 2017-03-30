 <?php 

?>
<form id="addMedia" method="POST" action="index.php?action=add_info&type=media">
	<!-- there will be a file as well.. later -->
	<div class="dialog">
	<img src="popup_close.png" id="close" onclick="div_hide()"> <!-- Close button -->
	<form id="upload" action="" method="POST" enctype="multipart/form-data">

	<fieldset>
		<legend id="SampleDiv">Add a Media</legend>
		<div>or drop files here</div>

		<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />
		<input type="text" id="Selected_FileName" name="Selected_FileName"/>

		<div>
			<label for="fileselect">Files to upload:</label>
			<input type="file" id="fileselect" name="fileselect" />
		</div>

		<div id="submitbutton">
			<button id="file_upload">Upload a Files</button>
		</div>

	</fieldset>
	<div id="filedrag" >or drop files here</div>
	<div id="messages">
		<p>Status Messages</p>
	</div>
	</div>
</form> 

