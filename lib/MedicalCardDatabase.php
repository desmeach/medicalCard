<?php
include_once "db_config.php";

class MedicalCardDatabase extends Database
{
    public function __construct()
    {
        parent::__construct('change-me', 'change-me', 'change-me', 'change-me');
    }
}