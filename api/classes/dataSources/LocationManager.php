<?php

class LocationManager
{
    /* local instance of Data Manager */
    private $dbManager = null;

    public function __construct()
    {
        // create DBManager instance
        $this->dbManager = new DBManager;
    }

    function getCount() {
        $sql="";
        $count = 0;
        $result = $this->getQueryResult($sql);
        while ($row = $result->fetch_assoc()) {
            $count = $row["count(*)"];
            break;
        }
        return $count;
    }

    public function getAllLocations() {
        $sql = "";
        $result = $this->dbManager->executeQuery($sql);
        $locationList = array();

        // if result is invalid return null
        if (0 == $result) return null;

        // else continue
        while ($row = $result-fetch_assoc()) {
            $newLocation = new $Location;
            $newLocation->mapFields($row);
            array_push($locationList, $newLocation);
        }

        return $locationList;

    }

}