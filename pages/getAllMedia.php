<?php
require_once("config/db.php");
require_once("classes/models/Media.php");
require_once("classes/dataSources/DBManager.php");

// simulating Insert User Section
$usersManager = new DBManager();

$SelectedMedia = $usersManager->getAllRecords(new Media);

?>
<div class="content_wrapper">
	<div class="content_options">
		<div class="content_title">
			<!-- Might not be necessary -->
		</div>
		<div class="content_search">
			<a href="#" onclick="showNewMediaForm('#operation_container')">Add Media</a>
		</div>
		<div class="content_list">
			<ul>
			<?php foreach($SelectedMedia as $key => $value) {
				$id = $value->getMediaId();
				$name = $value->getMediaName();
				?>
				<li><a href="#" onclick="getMedia('<?php echo $value->getMediaId(); ?>')"> <?php echo $value->getMediaName(); ?></a> </li>
			<?php } ?>
			</ul>
		</div>
	</div>
	<div class="content_data">
		<!-- more stuff will be loaded here -->
		<div id="operation_container">
		</div>
		<div id="context_content">
		</div>
	</div>
</div>

<ul>
