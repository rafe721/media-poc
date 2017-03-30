<?php
require("config/db.php");
require("classes/models/Media.php");
require("classes/dataSources/DBManager.php");

// simulating Insert User Section
$usersManager = new DBManager();
$media_id = "";
if (isset($_GET["media_id"])) {
	$media_id = $_GET["media_id"];
}
$media = new Media;
$media->setMediaId($media_id);
$media = $usersManager->getRecord($media);
?>
<b>Media Details: </b>
<a href="#" onclick="confirmRemoveMedia('<?php echo $media->getMediaId(); ?>' ,'#popupContact')"> remove </a> <br/>
<b>Media Name: </b>
<P><?php echo $media->getMediaName(); ?> </p>
<b>Media ID: </b>
<P><?php echo $media->getMediaId(); ?> </p>

<a href="#" class="load_media">Done</a>
