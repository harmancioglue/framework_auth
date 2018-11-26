<?php

class Home extends Controller
{
    public $mdl;

    public function __construct()
    {
        $this->mdl = $this->model('Model');
    }

    public function index()
    {
        $data = array(
          'title' => 'SharePost'
        );

        $this->view('pages/index',$data);
    }

}