<?php

class StandardSqlQueryFactory
{
	/* Insert Query - C */
    public function getInsertQuery(&$paramModel)
    {
    	$aCRUDable = get_class($paramModel);
    	switch($aCRUDable)
    	{
    		case 'User':
                /* future use
                $paramModel->getUserId();
                $paramModel->getFirstName();
                $paramModel->getLastName();
                $paramModel->getEmailId();
                $paramModel->getRoleId();
                $paramModel->getLastModified(); */
        		return "INSERT INTO `users`(`first_name`, `last_name`, `email_id`, `role_id`) VALUES ('".$paramModel->getFirstName()."', '".$paramModel->getLastName()."', '".$paramModel->getEmailId()."', ".$paramModel->getRoleId().")";
        	case 'UserRole':
                /* $paramModel->getRoleId();
                $paramModel->getRoleName();
                $paramModel->getRoleDescription();
                $paramModel->getLastModified(); */
        		return "INSERT INTO `user_roles`(`role_name`, `description`) VALUES ('".$paramModel->getRoleName()."','".$paramModel->getRoleDescription()."')";
        	case 'Display':
                /* future use
                $paramModel->getDisplayId();
                $paramModel->getDisplayName();
                $paramModel->getLatitude();
                $paramModel->getLatitude();
                $paramModel->getCurrentCampaign();
                $paramModel->getLastModified(); */
				return "INSERT INTO `displays`(`reg_code`, `display_name`, `slot_count`) VALUES ('". $paramModel->getRegCode() ."', '". $paramModel->getDisplayName() ."', ". $paramModel->getSlotCount() .")";
        		// return "INSERT INTO `displays`('reg_code',`display_name`, `slot_count`) VALUES ('".$paramModel->getRegCode()."','".$paramModel->getDisplayName()."',".$paramModel->getSlotCount().")";
        	case 'Campaign':
                /* future use
                $paramModel->getCampaignId();
                $paramModel->getCampaignName();
                $paramModel->getSlotCount();
                $paramModel->getLastModified(); */
        		return "INSERT INTO `campaign`(`campaign_name`, `slot_count`) VALUES ('".$paramModel->getCampaignName()."','".$paramModel->getSlotCount()."')";
        	case 'Media':
                /* $paramModel->getUserId();
                $paramModel->getFirstName();
                $paramModel->getLastName();
                $paramModel->getLastModified(); */
        		return "INSERT INTO `media`(`media_name`, `type_id`, `location_id`) VALUES ('".$paramModel->getMediaName()."',".$paramModel->getTypeId().",".$paramModel->getLocationId().")";
        	case 'MediaType':
                /* $paramModel->getTypeId();
                $paramModel->getTypeName();
                $paramModel->getFormat();
                $paramModel->getLastModified(); */
        		return "INSERT INTO `media_types`(`type_name`, `format`) VALUES ('".$paramModel->getTypeName()."','".$paramModel->getFormat()."')";
        	case 'MediaOnCampaign':
                /* $paramModel->getMediaId();
                $paramModel->getCampaignId();
                $paramModel->getSlotNo();
                $paramModel->getStatus();
                $paramModel->getLastModified(); */
                // Media is always instantly ACTIVE on isert into media.
                return "INSERT INTO `media_on_campaign`(`media_id`, `campaign_id`, `slot_no`) VALUES (".$paramModel->getMediaId().",".$paramModel->getCampaignId().",".$paramModel->getSlotNo().")";
    	}
    	return null;
    }

    /* Select Query - R */
    public function getSelectQuery(&$paramModel)
    {
    	$aCRUDable = get_class($paramModel);
    	switch($aCRUDable)
    	{
    		case 'User':
        		return "SELECT * FROM `users` where user_id='".$paramModel->getUserId()."'";
        	case 'UserRole':
        	    return "SELECT * FROM `user_roles` where role_id='".$paramModel->getRoleId()."'";
        	case 'Display':
        		return "SELECT * FROM `displays` where display_id='".$paramModel->getDisplayId()."'";
        	case 'Campaign':
        		return "SELECT * FROM `campaign` where campaign_id='".$paramModel->getCampaignId()."'";
        	case 'Media':
        		return "SELECT * FROM `media` where media_id='".$paramModel->getMediaId()."'";
        	case 'MediaType':
        		return "SELECT * FROM `media_types` where type_id='".$paramModel->getTypeId()."'";
        	case 'MediaOnCampaign':
        		return "SELECT * FROM `media_on_campaign` where campaign_id=".$paramModel->getCampaignId()." AND slot_no=".$paramModel->getSlotNo();;
    	}
    	return null;
    }

    /* Select All Query - R */
    public function getSelectAllQuery(&$paramModel)
    {
    	$aCRUDable = get_class($paramModel);
    	switch($aCRUDable)
    	{
    		case 'User':
        		return "SELECT * FROM `users`";
        	case 'UserRole':
        	    return "SELECT * FROM `user_roles`";
        	case 'Display':
        		return "SELECT * FROM `displays`";
        	case 'Campaign':
        		return "SELECT * FROM `campaign`";
        	case 'Media':
        		return "SELECT * FROM `media`";
        	case 'MediaType':
        		return "SELECT * FROM `media_types`";
        	case 'MediaOnCampaign': /* Select all media from campaign only;  not usefull to get all media */
        		return "SELECT * FROM `media_on_campaign` where campaign_id='".$paramModel->getCampaignId()."'";
    	}
    	return null;
    }

    /* Count Query - R */
    public function getCountQuery(&$paramModel)
    {
    	$aCRUDable = get_class($paramModel);
    	switch($aCRUDable)
    	{
    		case 'User':
        		return "SELECT count(*) FROM `users`";
        	case 'UserRole':
        	    return "SELECT count(*) FROM `user_roles`";
        	case 'Display':
        		return "SELECT count(*) FROM `displays`";
        	case 'Campaign':
        		return "SELECT count(*) FROM `campaign`";
        	case 'Media':
        		return "SELECT count(*) FROM `media`";
        	case 'MediaType':
        		return "SELECT count(*) FROM `media_types`";
        	case 'MediaOnCampaign':
        		return "SELECT count(*) FROM `media_on_campaign` where campaign_id='".$paramModel->getCampaignId()."'";
    	}
    	return null;
    }

    /* Upgrade Query - U */
    public function getUpdateQuery(&$paramModel)
    {
		$aCRUDable = get_class($paramModel);
    	switch($aCRUDable)
    	{
    		case 'User':
    			/* for readability */
        		return "UPDATE `users` SET `first_name`='".$paramModel->getFirstName()."',`last_name`='".$paramModel->getLastName()."',`email_id`='".$paramModel->getEmailId()."',`role_id`='".$paramModel->getRoleId()."' WHERE user_id = '".$paramModel->getUserId()."'";
        	case 'UserRole':
        		/* for readability */
        		return "UPDATE `user_roles` SET `role_name`='".$paramModel->getRoleName()."',`description`='".$paramModel->getRoleDescription()."' WHERE `role_id`='".$paramModel->getRoleId()."'";
        	case 'Display':
        		/* for readability */
				return "UPDATE `displays` SET `reg_code`='".$paramModel->getRegCode()."',`display_name`='".$paramModel->getDisplayName()."',`slot_count`=".$paramModel->getSlotCount()." WHERE `display_id`=".$paramModel->getDisplayId()."";
        		// return "UPDATE `displays` SET `display_name`=`".$paramModel->getDisplayName()."`, `reg_code`=`".$paramModel->getRegCode()."`, `slot_count`=".$paramModel->getSlotCount()." where `display_id`=".$paramModel->getDisplayId();
        	case 'Campaign':
        		/* for readability */
        		return "UPDATE `campaign` SET `campaign_name`='".$paramModel->getCampaignName()."',`slot_count`='".$paramModel->getSlotCount()."' WHERE `campaign_id`='".$paramModel->getCampaignId()."'";
        	case 'Media':
        		/* for readability */
        		return "UPDATE `media` SET `media_name`='".$paramModel->getMediaName()."',`type_id`='".$paramModel->getTypeId()."',`location_id`='".$paramModel->getLocationId()."' WHERE `media_id`='".$paramModel->getMediaId()."'";
        	case 'MediaType':
        		/* for readability */
        		return "UPDATE `media_types` SET `type_name`='".$paramModel->getTypeName()."',`format`='".$paramModel->getFormat()."' WHERE `type_id`='".$paramModel->getTypeId()."'";
        	case 'MediaOnCampaign':
        		/* for readability */
        		return "UPDATE `media_on_campaign` SET `slot_no`=".$paramModel->getSlotNo().",`status`='".$paramModel->getStatus()."' WHERE `media_id`=".$paramModel->getMediaId()." AND `campaign_id`=".$paramModel->getCampaignId();
    	}
    	return null;
    }

    /* Delete Query - D */
    public function getDeleteQuery(&$paramModel)
    {
    	$aCRUDable = get_class($paramModel);
    	switch($aCRUDable)
    	{
    		case 'User':
        		return "DELETE FROM `users` WHERE user_id='". $paramModel->getUserId()."'";
        	case 'UserRole':
        	    return "DELETE FROM `user_roles` WHERE user_id='". $paramModel->getRoleId()."'";
        	case 'Display':
        		return "DELETE FROM `displays` WHERE display_id='". $paramModel->getDisplayId()."'";
        	case 'Campaign':
        		return "DELETE FROM `campaign` WHERE campaign_id='". $paramModel->getCampaignId()."'";
        	case 'Media':
        		return "DELETE FROM `media` WHERE media_id='". $paramModel->getMediaId()."'";
        	case 'MediaType':
        		return "DELETE FROM `media_types` WHERE type_id='". $paramModel->getTypeId()."'";
        	case 'MediaOnCampaign':
        		return "DELETE FROM 'media_on_campaign` WHERE user_id='". $paramModel->getUserId()."'";
    	}
    	return null;
    }
}