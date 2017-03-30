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

class Campaign implements CRUDable
{
	public $tableName = "campaign";
	
	private $dbManager;

    public $display_id = 0;
    public $day = '';
    public $start_time = ''; /* time */
	public $end_time = ''; /* time */
	public $last_modified = '';
	
	// pseudo-Constructor
    public function __construct()
    {
		$a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
		$this->dbManager = new DBManager();
    }
	
	    function create()
    {
		
		if( null === $this->mediaId || null === $this->displayId || null === $this->slotNo) {
			return null;
		}
		$sql = "Insert into ".$this->tableName." (media_id, display_id, slot_no) VALUES (".$this->mediaId .", ". $this->displayId .", ". $this->slotNo.")";
        return $this->dbManager->executeQuery($sql);
    }

    function read()
    {
        /* if( null == $this->mediaId) {
			return null
		}
        return $this->dbManager->getQueryResult(""); */
    }

    function update()
    {
        if(null === $this->displayId || null === $this->slotNo) { // media_id can be updated to null
			return null;
		}
		$sql = "UPDATE `".$this->tableName."` SET `media_id`=".$this->mediaId." WHERE `slot_no`=".$this->slotNo." AND `display_id`=".$this->displayId;
        return $this->dbManager->executeQuery($sql);
    }

    function remove()
    {
        if( null === $this->displayId) {
			return null;
		}
		$sql = "DELETE FROM `".$this->tableName."` WHERE display_id = ". $this->displayId;
        return $this->dbManager->executeQuery($sql);
    }
	
	/** CRUD Implementations #BEGIN */
    /* Map result of a Query to Object - another way of initialisation */
    public function mapFields($row)
    {
        $this->mediaId = isset($row["media_id"])? $row["media_id"]: $this->mediaId;
        $this->displayId = isset($row["display_id"])? $row["display_id"]: $this->displayId;
        $this->slotNo = isset($row["slot_no"])? $row["slot_no"]: $this->slotNo;
        $this->status = isset($row["status"])? $row["status"]: $this->status;
        $this->lastModified = isset($row["last_modified"])? $row["last_modified"]: $this->lastModified;
    }
	
}
