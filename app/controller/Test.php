<?php

class Test extends Controller
{
    private $mdl;

    public function __construct()
    {
        $this->mdl = $this->model('Tests');
    }

    public function index()
    {
        $this->mdl->getPosts();
        $this->mdl->getPosts();
    }
}