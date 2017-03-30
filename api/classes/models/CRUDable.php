<?php

interface CRUDable
{

	/* Map result of a Query to Object */
    public function mapFields($row);

}
