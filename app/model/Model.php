<?php

class Model
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
       $this->db->query("SELECT * FROM posts");
       $test = $this->db->getResultSet();
       $test = 4;
    }
}