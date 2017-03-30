<?php 

require_once("CRUDable.php");

// require_once("../classes/dataSources/DBManager.php");
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

class Media implements CRUDable
{
	public $tableName = "media_on_display";
	
	private $dbManager;

    public $mediaId = 0;
    public $mediaName = '';
	public $fileName = '';
    public $typeId = 0;
    public $locationId = 0;
    public $lastModified = '';
    
    public function __construct()
    {

		$this->dbManager = new DBManager();
    }
    
    function getMediaId()
    {
        return $this->mediaId;
    }

    function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
    }

    function getMediaName()
    {
        return $this->mediaName;
    }

    function setMediaName($mediaName)
    {
        $this->mediaName = $mediaName;
    }

    function getTypeId()
    {
        return $this->typeId;
    }

    function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    function getLocationId()
    {
        return $this->locationId;
    }

    function setLocationId($locationId)
    {
        $this->locationId = $locationId;
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
	
	function create()
    {
		if( null == $this->mediaName || null == $this->fileName ) {
			return null;
		}
		$sql = "INSERT INTO `media`(`media_name`, `file_name`, `type_id`, `location_id`) VALUES ('".$this->mediaName."', '".$this->fileName."',".$this->typeId.",".$this->locationId.")";
		// $sql = "UPDATE `media` SET `media_name`='".$this->mediaName."' WHERE `media_id`='".$this->mediaId."'";
		// echo $sql;
        $this->dbManager->executeQuery($sql);
		
		return "Operation completed";
	}
	
	function read()
    {
		$sql = "";
        if( null == $this->mediaId) {
			return null;
		} else {
			$sql = "SELECT * FROM `media` where media_id='".$this->mediaId."'";
		}
		$result = $this->dbManager->getQueryResult($sql);
		while ($row = $result->fetch_assoc()) {
			$this->mapFields($row);
			break;
		}
		return "Operation Completed";
    }
	
	function readAll($paramUserId = 'nothing') { // this parameter will be used when users area added to the system.
		$sql = "SELECT * FROM `media`";
		/*
			1. Should return media uploaded by a user if successful.
			2. should return null if there are no media against a user.
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
	
	function readLike($paramLike, $paramUserId = 'nothing') { // this parameter will be used when users area added to the system.
		$sql = "SELECT * FROM `media` WHERE upper(media_name) like UPPER('%".$paramLike."%')";//  OR upper(reg_code) LIKE UPPER('%".$paramLike."%')";
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
	
	function update()
    {
        if( null == $this->mediaId || null == $this->mediaName ) {
			return null;
		}
		
		$sql = "UPDATE `media` SET `media_name`='".$this->mediaName."' WHERE `media_id`='".$this->mediaId."'";
		// echo $sql;
        $this->dbManager->executeQuery($sql);
		
		return "Operation completed";
    }
	
	function remove()
    {
        if( null === $this->mediaId) {
			return null;
		}
		$sql = "DELETE FROM `media` WHERE media_id='". $this->mediaId."'";
		$deleteStatus = $this->dbManager->executeQuery($sql);
		// delete all occurances of this media on Media_on_display
		$sql = "update media_on_display set media_id='0' where media_id='".$this->mediaId."'";
		$this->dbManager->executeQuery($sql);
		// return status of the delete media
        return $deleteStatus;
    }
	
    /* Map result of a Query to Object - another way of initialisation */
    public function mapFields($row)
    {
        $this->mediaId = isset($row["media_id"])? $row["media_id"]: $this->mediaId;
        $this->mediaName = isset($row["media_name"])? $row["media_name"]: $this->mediaName;
		$this->fileName = isset($row["file_name"])? $row["file_name"]: $this->fileName;
        $this->typeId = isset($row["type_id"])? $row["type_id"]: $this->typeId;
        $this->locationId = isset($row["location_id"])? $row["location_id"]: $this->locationId;
        $this->lastModified = isset($row["last_modified"])? $row["last_modified"]: $this->lastModified;
    }

    /** CRUD Implementations #END */

} 

?> 