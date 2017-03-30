<?php 

include_once("CRUDable.php");
include_once("../classes/dataSources/DBManager.php");

class Slot implements CRUDable
{
	public $tableName = "media_on_display";
	
	private $dbManager;

    public $mediaId = 0;
    public $displayId = 0;
    public $slotNo = 0;
    public $status = '';
    public $lastModified = ''; /* time */
	
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
	
	// pseudo-Constructor
	public function __construct3($paramMediaId, $paramDisplayId, $paramSlotNo)
    {
		$this->mediaId = $paramMediaId;
		$this->displayId = $paramDisplayId;
		$this->slotNo = $paramSlotNo;
    }
	
	function getTableName() {
		return $this->tableName;
	}
	
	function getArray() {
		$mediaArray = array();
		if (0 != $this->mediaId) {
			$mediaArray['media_id'] = $this->mediaId;
		}
		if (0 != $this->displayId) {
			$mediaArray['display_id'] = $this->displayId;
		}
		if (0 != $this->slotNo) {
			$mediaArray['slot_no'] = $this->slotNo;
		}
		if ('' != $this->status) {
			$mediaArray['status'] = $this->status;
		}
		if ('' != $this->lastModified) {
			$mediaArray['last_modified'] = $this->lastModified;
		}
		return $mediaArray;
	}
	
	function getMediaNames() { // this parameter will be used when users area added to the system.
		// everything for now
		$sql = "select a.media_id, a.slot_no, a.display_id, b.media_name from media_on_display as a LEFT join media as b ON b.media_id = a.media_id";
		$mediaList = array();
		$result = $this->dbManager->getQueryResult($sql);
		while ($row = $result->fetch_assoc()) {
			$newObj = array("media_id" => $row["media_id"],"media_name"=> $row["media_name"], "slot_no"=> $row["slot_no"], "display_id"=> $row["display_id"]); // for easier code replication
			// $newObj->mapFields($row);
			//$mediaList[$row["slot_no"]] = $newObj;
			array_push($mediaList, $newObj);
		}
		return $mediaList;
	}
	
	function readAll()
    {
        if( null === $this->displayId) {
			return null;
		}
		$sql = "SELECT * FROM `media_on_display` where display_id='".$this->displayId."'";
		$result = $this->dbManager->getQueryResult($sql);
		$modelList = array();
		while ($row = $result->fetch_assoc()) {
			$class = (get_class($this)); // get this class name
			$newObj = new $class; // for easier code replication
			$newObj->mapFields($row);
			array_push($modelList, $newObj);
		}
		
		return $modelList;
    }
	
	function removeAll()
    {
		if( null === $this->displayId ) {
			return null;
		}
		$sql = "DELETE FROM `media_on_display` WHERE display_id = ". $this->displayId;
        return $this->dbManager->executeQuery($sql);
    }
	
	function readMedia()
    {
        if( null == $this->displayId || null == $this->slotNo) {
			return null;
		}
		$sql = "SELECT media_id FROM `media_on_display` where display_id='".$this->displayId."' AND slot_no=".$this->slotNo;
		$result = $this->dbManager->getQueryResult($sql);
		while ($row = $result->fetch_assoc()) {
			$this->mapFields($row);
			break;
		}
		return "Operation Completed";
    }
	
	/* function getIndertQuery() {
		$mediaArray = new MediaOnDisplay(5, 5, 5)->getArray();

		$keys = "";
		$values = "";
		echo "<br/>";
		foreach ($mediaArray as $key => $value) {
			$keys .= $key ", ";
			$values .= $value ", ";
		}
		echo "Insert into 'media_on_display'(".$keys .") values (".$values .")";
		echo "<br/>";
	} */
    
    function create()
    {
		
		if( null === $this->mediaId || null === $this->displayId || null === $this->slotNo) {
			return null;
		}
		$sql = "Insert into media_on_display (media_id, display_id, slot_no) VALUES (".$this->mediaId .", ". $this->displayId .", ". $this->slotNo.")";
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
		$sql = "UPDATE `media_on_display` SET `media_id`=".$this->mediaId." WHERE `slot_no`=".$this->slotNo." AND `display_id`=".$this->displayId;
        return $this->dbManager->executeQuery($sql);
    }

    function remove()
    {
        if( null === $this->displayId || null === $this->slotNo) {
			return null;
		}
		$sql = "DELETE FROM `media_on_display` WHERE display_id = ". $this->displayId ." AND slot_no = " . $this->slotNo;
        return $this->dbManager->executeQuery($sql);
    }

    function getId($slotNo)
    {
        $this->slotNo = $slotNo;
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

    /** CRUD Implementations #END */
} 

?> 