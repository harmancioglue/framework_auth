<?php

class Home extends Controller
{
    private $mdl;

    public function __construct()
    {
       $this->mdl = $this->model('Model');
    }

    public function index()
    {
        $this->mdl->getPosts();
    }

}