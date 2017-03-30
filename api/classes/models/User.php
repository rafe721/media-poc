<?php

require("CRUDable.php");

class User implements CRUDable
{

    private $userId = 0;
    private $username = '';
    private $password = '';
    private $firstName = '';
    private $lastName = '';
    private $emailId = '';
    private $roleId = 0;
    private $lastModified = ''; /* Time */
    
    public function __construct()
    {

    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($aUserId)
    {
        $this->userId = $aUserId;
    }
    
    public function getUsername()
    {
    	return $this->username;
    }
    
    public function setUsername($username)
    {
    	$this->username = $username;
    }
    
    public function getPassword()
    {
    	return $this->password;
    }
    
    public function setPassword($password)
    {
    	$this->password = $password;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($aName)
    {
        $this->firstName = $aName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($aName)
    {
        $this->lastName = $aName;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }

    public function setRoleId($aRoleId)
    {
        $this->roleId = $aRoleId;
    }

    public function getEmailId()
    {
        return $this->emailId;
    }

    public function setEmailId($anEmailId)
    {
        $this->emailId = $anEmailId;
    }

    public function getLastModified()
    {
        return $this->lastModified;
    }

    public function setLastModified($LastModifiedDate)
    {
        $this->lastModified = $LastModifiedDate;
    }

    /** CRUD Implementations #BEGIN */
    /* Map result of a Query to Object - another way of initialisation */
    public function mapFields($row)
    {
        $this->setUserId(isset($row["user_id"])? $row["user_id"]: "");
        $this->setUsername(isset($row["user_name"])? $row["user_name"]: "");
        $this->setPassword(isset($row["password"])? $row["password"]: "");
        $this->setFirstName(isset($row["first_name"])? $row["first_name"]: "");
        $this->setLastName(isset($row["last_name"])? $row["last_name"]: "");
        $this->setEmailId(isset($row["email_id"])? $row["email_id"]: "");
        $this->setRoleId(isset($row["role_id"])? $row["role_id"]: "");
        $this->setLastModified(isset($row["last_modified"])? $row["last_modified"]: "");
    }

    /** CRUD Implementations #End */

}
