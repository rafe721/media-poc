<?php 

require("CRUDable.php");

class UserRole implements CRUDable
{

    private $roleId = 0;
    private $roleName = '';
    private $roleDescription = '';
    private $lastModified = ''; /* Time */
    
    public function __construct()
    {

    }
    
    public function getRoleId()
    {
        return $this->roleId;
    }

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
    }

    public function getRoleName()
    {
        return $this->roleName;
    }

    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
    }

    public function getRoleDescription()
    {
        return $this->roleDescription;
    }

    public function setRoleDescription($roleDescription)
    {
        $this->roleDescription = $roleDescription;
    }

    public function getLastModified()
    {
        return $this->lastModified;
    }

    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }

    /** CRUD Implementations #BEGIN */
    /* Map result of a Query to Object */
    public function mapFields($row)
    {
        $this->setRoleId(isset($row["role_id"])? $row["role_id"]: "");
        $this->setRoleName(isset($row["role_name"])? $row["role_name"]: "");
        $this->setRoleDescription(isset($row["role_description"])? $row["role_description"]: "");
        $this->setLastModified(isset($row["last_modified"])? $row["last_modified"]: "");
    }

} 

?> 