<?php

class BaseModel
{
    public $db;

    public function __construct()
    {
        $this->db = Database::getDbInstance();
    }
}