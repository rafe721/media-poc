<?php

include_once("CRUDable.php");
//include_once("../classes/dataSources/DBManager.php");
// include conditions for DBManager
$dbManager_subfolder = "classes/dataSources/DBManager.php";
if (file_exists("../".$dbManager_subfolder)) {
	include_once("../".$dbManager_subfolder);
} elseif (file_exists("../api/".$dbManager_subfolder)) {
	// Accessing from /actions folder
	include_once("../api/".$dbManager_subfolder);
} else {
	// accessing from index.php
	include_once("api/".$dbManager_subfolder);
}

class CampaignSlot implements CRUDable
{
	public $tableName = "template_slots";
	
	private $dbManager;

    public $campaign_id = 0;
    public $display_id = 0;
    public $file_name = '';
    public $last_modified = ''; /* time */
	
	
}

