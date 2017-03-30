<?php

require("CRUDable.php");

class MediaType implements CRUDable
{

    private $typeId = 0;
    private $typeName = '';
    private $format = '';
    private $lastModified = ''; /* time */
    
    public function __construct()
    {

    }
    
    function getTypeId()
    {
        return $this->typeId;
    }

    function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    function getTypeName()
    {
        return $this->typeName;
    }

    function setTypeName($typeName)
    {
        $this->typeName = $typeName;
    }

    function getFormat()
    {
        return $this->format;
    }

    function setFormat($format)
    {
        $this->format = $format;
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
        $this->setTypeId(isset($row["type_id"])? $row["type_id"]: "");
        $this->setTypeName(isset($row["type_name"])? $row["type_name"]: "");
        $this->setFormat(isset($row["format"])? $row["format"]: "");
        $this->setLastModified(isset($row["last_modified"])? $row["last_modified"]: "");
    }

    /** CRUD Implementations #END */

} 

?> 