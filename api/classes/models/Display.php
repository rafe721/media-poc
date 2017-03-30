<?php 

require_once("CRUDable.php");
require_once("MediaOnDisplay.php");


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

class Display implements CRUDable
{
	public $tableName = "displays";
	
	private $dbManager;

	public $displayId = 0;
	public $regCode = '';
	public $firebase_id = '';
    public $displayName = '';
	public $status = '';
	public $slotCount = 0;
    public $locationId = 0;
    public $currentTemplate = 0;
    public $lastModified = ''; /* Time */
    
    public function __construct()
    {
		$this->dbManager = new DBManager();
    }
	
	function updateSlots() {
		if (null != $this->displayId) { // if displayId is present
			// get current slot Count
			$sql = "Select slot_count from ".$this->tableName." where display_id = '".$this->displayId."'";
			$result = $this->dbManager->getQueryResult($sql);
			while ($row = $result->fetch_assoc()) {
            	$this->mapFields($row);
				break;
        	}
			$availableSlots = 0;
			$sql = "SELECT count(*) FROM `media_on_display` WHERE Display_id =".$this->displayId;
			$result = $this->dbManager->getQueryResult($sql);
			while ($row = $result->fetch_assoc()) {
				if (isset($row["count(*)"])) {
					$availableSlots = $row["count(*)"] +1; 
				}
				break;
        	}
			// if there are lesser slots than what is assigned to this display, add them
			if ($availableSlots < $this->slotCount) {
				while ($availableSlots <= $this->slotCount) {
					$mediaArray = (new MediaOnDisplay( 0, $this->displayId, $availableSlots))->create(); // as no media is created yet
					$availableSlots++;
				}
			} else { //if($availableSlots > $this->slotCount) { // only if there are more; else leave unchanged
				// remove slots
				while ($availableSlots > $this->slotCount) {
					$mediaArray = (new MediaOnDisplay( 0, $this->displayId, $availableSlots))->remove(); // as no media is created yet
					$availableSlots--;
				}
				return "updated";
			}
			
			return "operation done";
		} else {
			return "";
		}
	}
	
	function readLike($paramLike, $paramUserId = 'nothing') { // this parameter will be used when users area added to the system.
		$sql = "SELECT * FROM `displays` WHERE upper(display_name) like UPPER('%".$paramLike."%') OR upper(reg_code) LIKE UPPER('%".$paramLike."%')";
		/*
			1. Ideally should return null if there is no user ID
			2. Should return displays where user has slots i.e. append the query likewise.
			3. if user is a super admin, or Sales_rep should return all displays i.e. continue without doing anything.
		*/
		
		$modelList = array();
		$result = $this->dbManager->getQueryResult($sql);
		while ($row = $result->fetch_assoc()) {
			$class = (get_class($this)); // get this class name
			$newObj = new $class; // for easier code replication
			$newObj->mapFields($row);
			array_push($modelList, $newObj);
		}
		return $modelList;
	}
	
	function readAll($paramUserId = 'nothing') { // this parameter will be used when users area added to the system.
		$sql = "SELECT * FROM `displays`";
		/*
			1. Ideally should return null if there is no user ID
			2. Should return displays where user has slots i.e. append the query likewise.
			3. if user is a super admin, or Sales_rep should return all displays i.e. continue without doing anything.
		*/
		
		$modelList = array();
		$result = $this->dbManager->getQueryResult($sql);
		while ($row = $result->fetch_assoc()) {
			$class = (get_class($this)); // get this class name
			$newObj = new $class; // for easier code replication
			$newObj->mapFields($row);
			array_push($modelList, $newObj);
		}
		return $modelList;
	}
	
	function getMediaName($paramSlotNo) { // this parameter will be used when users area added to the system.
		$sql = "select a.media_id, a.media_name, b.slot_no from media as a, media_on_display as b where b.Display_id='". $this->displayId."' AND a.media_id = b.media_id AND b.slot_no = ".$paramSlotNo;
		$result = $this->dbManager->getQueryResult($sql);
		$newObj = array("media_id" => "","media_name"=> "", "slot_no"=> $paramSlotNo); // initialise default response
		while ($row = $result->fetch_assoc()) {
			$media_id = isset($row["media_id"]) ? $row["media_id"] : "";
			$media_name = isset($row["media_name"]) ? $row["media_name"] : "";
			$slot_no = isset($row["slot_no"]) ? $row["slot_no"] : "";
			
			$newObj = array("media_id" => $media_id,"media_name"=> $media_name, "slot_no"=> $slot_no);
			// array_push($mediaList, $newObj);
		}
		return $newObj;
	}
	
	function getMediaNames() { // this parameter will be used when users area added to the system.
		$sql = "select a.media_id, a.media_name, b.slot_no from media as a, media_on_display as b where b.Display_id='". $this->displayId."' AND a.media_id = b.media_id";
		$mediaList = array();
		$result = $this->dbManager->getQueryResult($sql);
		while ($row = $result->fetch_assoc()) {
			$newObj = array("media_id" => $row["media_id"],"media_name"=> $row["media_name"], "slot_no"=> $row["slot_no"]); // for easier code replication
			// $newObj->mapFields($row);
			$mediaList[$row["slot_no"]] = $newObj;
			// array_push($mediaList, $newObj);
		}
		return $mediaList;
	}
	
	function create()
    {
		
		if( null === $this->regCode || null === $this->displayName || null == $this->slotCount) {
			return "Incomplete Data";
		}
		
		$sql = "Insert into displays (reg_code, display_name, slot_count) VALUES ('".$this->regCode ."', '". $this->displayName ."', ". $this->slotCount.")";
		
		$response = $this->dbManager->executeQuery($sql);
		
        if ("Operation Successful" == $response) {
			$sql = "Select display_id from displays where reg_code = '".$this->regCode."'";
			$result = $this->dbManager->getQueryResult($sql);
			while ($row = $result->fetch_assoc()) {
            	$this->mapFields($row);
				break;
        	}
		}
			
		return "DisplayId: " . $response;
    }
	
	function read()
    {
		$sql = "";
        if( null == $this->displayId && null == $this->regCode) {
			return null;
		} elseif (null == $this->regCode) {
			// display_id is not null
			$sql = "SELECT * FROM `displays` where display_id='".$this->displayId."'";
		} else {
			// if reg_code is available
			$sql = "SELECT * FROM `displays` where reg_code='".$this->regCode."'";
		}
		$result = $this->dbManager->getQueryResult($sql);
		while ($row = $result->fetch_assoc()) {
			$this->mapFields($row);
			break;
		}
		return "Operation Completed";
    }

    function update()
    {
        if( null == $this->displayId) {
			return null;
		}
		/*
		 * Original working
		 * $sql = "UPDATE `displays` SET `reg_code`='".$this->regCode."', `display_name`='".$this->displayName."',`slot_count`=".$this->slotCount." WHERE `display_id`=".$this->displayId."";
		 */
		// regcode is updatable again
		$sql = "UPDATE `displays` SET ";
		if (null != $this->regCode) {
			$sql .= "`reg_code`='".$this->regCode."', ";
		}
		if (null != $this->firebase_id) {
			$sql .= "`reg_code`='".$this->regCode."', ";
		}
		if (null != $this->displayName) {
			$sql .= "`firebase_id`='".$this->firebase_id."', ";
		}
		if (null != $this->slotCount) {
			$sql .= "`slot_count`='".$this->slotCount."', ";
		}
		if (null != $this->status) {
			$sql .= "`status`='".$this->status."', ";
		}
		if (null != $this->lastModified) {
			if ("now()" == $this->lastModified) {
				$sql .= "`last_modified`=".$this->lastModified.", ";
			} else {
				$sql .= "`last_modified`='".$this->lastModified."', ";
			}
		}
		$sql = rtrim($sql, ", ");
		$sql .= " WHERE `display_id`=".$this->displayId."";
		// echo $sql;
        $this->dbManager->executeQuery($sql);
		// update the slots when done
		$this->updateSlots();
		return "Operation completed";
    }

    function remove()
    {
        if( null === $this->displayId) {
			return null;
		}
		$sql = "DELETE FROM `displays` WHERE display_id='". $this->displayId."'";
		(new MediaOnDisplay( 0, $this->displayId, 0))->removeAll();
        return $this->dbManager->executeQuery($sql);
    }
    
    function getDisplayId()
    {
        return $this->displayId;
    }

    function setDisplayId($displayId)
    {
        $this->displayId = $displayId;
    }
	
	function getRegCode()
    {
        return $this->regCode;
    }

    function setRegCode($regCode)
    {
        $this->regCode = $regCode;
    }

    function getDisplayName()
    {
        return $this->displayName;
    }

    function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    function getLocationId()
    {
        return $this->locationId;
    }

    function setLocationId($locationId)
    {
        $this->locationId = $locationId;
    }
	
	function getStatus()
    {
        return $this->status;
    }

    function setStatus($status)
    {
        $this->status = $status;
    }
	
	function getSlotCount()
    {
        return $this->slotCount;
    }

    function setSlotCount($slotCount)
    {
        $this->slotCount = $slotCount;
    }

    function getCurrentTemplate()
    {
        return $this->currentTemplate;
    }

    function setCurrentTemplate($currentTemplate)
    {
        $this->currentTemplate = $currentTemplate;
    }

    function getLastModified()
    {
        return $this->lastModified;
    }

    function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }

    /** CRUD Implementations #BEGIN */
    /* Map result of a Query to Object - another way of initialisation */
    public function mapFields($row)
    {
        $this->displayId = isset($row["display_id"])? $row["display_id"]: $this->displayId;
		$this->regCode = isset($row["reg_code"])? $row["reg_code"]: $this->regCode;
		$this->firebase_id = isset($row["firebase_id"])? $row["firebase_id"]: $this->firebase_id;
        $this->displayName = isset($row["display_name"])? $row["display_name"]: $this->displayName;
		$this->status = isset($row["status"])? $row["status"]: $this->status;
		$this->slotCount = isset($row["slot_count"])? $row["slot_count"]: $this->slotCount;
        $this->locationId = isset($row["location_id"])? $row["location_id"]: $this->locationId;
        $this->currentTemplate = isset($row["current_campaign"])? $row["current_template"]: $this->currentTemplate;
        $this->lastModified = isset($row["last_modified"])? $row["last_modified"]: $this->lastModified;
    }

    /** CRUD Implementations #END */

} 

?> 