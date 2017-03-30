<?php
 require("config/db.php");
require("classes/models/Media.php");
require("classes/dataSources/DBManager.php");

$usersManager = new DBManager();
$media = new Media;
$media->setMediaId($id);

echo $usersManager->deleteRecord($media);
echo "Media with ID: ".$id." Removed";
?>