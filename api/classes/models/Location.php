<?php

require("CRUDable.php");
    
class Location implements CRUDable
{

    private $locationId = null;
    private $latitude = null;
    private $longitude = null;
    private $addressLine = null;
    private $suburb = null;
    private $postcode = null;
    private $city = null;
    private $country = null;
    private $lastModified = null;
    
    public function __construct()
    {
        $this->locationId = '';
        $this->latitude = '';
        $this->longitude = '';
        $this->addressLine = '';
        $this->suburb = '';
        $this->postcode = '';
        $this->city = '';
        $this->country = '';
        $this->lastModified = '';

    }

    /** Getters and Setters #BEGIN */

    /* locationId */
    public function getLocationId()
    {
        return $this->locationId;
    }

    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
    }

    /* latitude */
    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /* longitude */
    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /* addressLine */
    public function getAddressLine()
    {
        return $this->addressLine;
    }

    public function setAddressLine($addressLine)
    {
        $this->addressLine = $addressLine;
    }

    /* suburb */
    public function getSuburb()
    {
        return $this->suburb;
    }

    public function setSuburb($suburb)
    {
        $this->suburb = $suburb;
    }

    /* postcode */
    public function getPostcode()
    {
        return $this->postcode;
    }

    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /* city */
    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }
    
    /* Country */
    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    /* Last Modified */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }

    /** Getters and Setters #END */

    /** CRUD Implementations #BEGIN */
    /* Map result of a Query to Object - another way of initialisation */
    public function mapFields($row)
    {

    	$this->setLocationId(isset($row["location_id"])? $row["location_id"]: $this->getLocationId());
    	$this->setLatitude(isset($row["latitude"])? $row["latitude"]: $this->getLatitude());
    	$this->setLongitude(isset($row["longitude"])? $row["longitude"]: $this->getLongitude());
    	$this->setAddressLine(isset($row["address_line"])? $row["address_line"]: $this->getAddressLine());
    	$this->setSuburb(isset($row["suburb"])? $row["suburb"]: $this->getSuburb());
    	$this->setPostcode(isset($row["postcode"])? $row["postcode"]: $this->getPostcode());
    	$this->setCity(isset($row["city"])? $row["city"]: $this->getCity());
    	$this->setCountry(isset($row["country"])? $row["country"]: $this->getCountry());
    	$this->setLastModified(isset($row["campaign_id"])? $row["campaign_id"]: $this->getLastModified());
    }

    /** CRUD Implementations #END */

} 
