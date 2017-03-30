<?php

// include situations for dp.php
$db_subfolder = "config/db.php";
if (file_exists("../".$db_subfolder)) {
	require_once("../".$db_subfolder);
} elseif (file_exists("../api/".$db_subfolder)) {
	// Accessing from /actions folder
	require_once("../api/".$db_subfolder);
} else {
	// accessing from index.php
	require_once("api/".$db_subfolder);
}
include_once("StandardSqlQueryFactory.php");

class DBManager {

	private $_conn = null;
    private $_queryFactory = null;
    
    public function __construct() {
        // Create connection
        $this->_conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->queryFactory = new StandardSqlQueryFactory();
    }

    function __destruct() {
        // closing connection
        mysqli_close($this->_conn);
   }

   /* Adds a new User to the System */
    function addRecord($paramModel) {
		if (is_subclass_of($paramModel, 'CRUDable')) {
			return $this->executeQuery($this->queryFactory->getInsertQuery($paramModel));
		}
    	return "Invalid_Data";
    }

    /* Updates User To the System */
	function updateRecord($paramModel) {
		if (is_subclass_of($paramModel, 'CRUDable')) {
			return $this->executeQuery($this->queryFactory->getUpdateQuery($paramModel));
		}
    	return "Invalid_Data";
    }

    function deleteRecord($paramModel) { 
        if (is_subclass_of($paramModel, 'CRUDable')) {
			return $this->executeQuery($this->queryFactory->getDeleteQuery($paramModel));
		}
    	return "Invalid_Data";
    }

	function getRecord($paramModel)
	{
    	if (is_subclass_of($paramModel, 'CRUDable')) {
    		$modelType = get_class($paramModel);
    		$newObj = new $modelType;
			$result = $this->getQueryResult($this->queryFactory->getSelectQuery($paramModel));
			while ($row = $result->fetch_assoc()) {
            	$newObj->mapFields($row);
            	break;
        	}
        	return $newObj;
		}
    	return "Invalid_Data";
	}

	function getRecords($paramModel, $paramPage, $paramCount) {
		if (is_subclass_of($paramModel, 'CRUDable')) {
    		$modelType = get_class($paramModel);
    		$newObj = new $modelType;
			$result = $this->getQueryResult($this->queryFactory->getSelectAllQuery($paramModel));
			while ($row = $result->fetch_assoc()) {
            	$newObj->mapFields($row);
            	break;
        	}
        	return $newObj;
		}
    	return "Invalid_Data";
	}

	function getAllRecords($paramModel) {
		if (is_subclass_of($paramModel, 'CRUDable')) {
    		$modelType = get_class($paramModel);
    		 $modelList = array();
			$result = $this->getQueryResult($this->queryFactory->getSelectAllQuery($paramModel));
			while ($row = $result->fetch_assoc()) {
				$newObj = new $modelType;
            	$newObj->mapFields($row);
            	array_push($modelList, $newObj);
        	}
        	return $modelList;
		}
    	return "Invalid_Data";
	}

    function getCount($paramModel) {
    	$count = 0;
    	$result = $this->getQueryResult($this->queryFactory->getCountQuery($paramModel));
    	while ($row = $result->fetch_assoc()) {
            $count = $row["count(*)"];
            break;
        }
        return $count;
    }

    function executeQuery($paramSQL) {
    	$message = "";
        if($this->_conn->query($paramSQL)) {
            $message = "Operation Successful";
        } else {
        	$message = "Operation Failed: ";
            if ($this->_conn->error <> "") {
                $message +=$this->_conn->error;
            }
        }
        return $message;
    }

    function getQueryResult($paramSQL) {
    	if ($this->_conn->connect_error) {
            return 0;
        } else {
            return $this->_conn->query($paramSQL);
        }
    }

} 
