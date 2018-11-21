<?php

class Controller
{
    public function model($model)
    {
        if (GeneralUtils::checkModelExist($model)){

            require_once (GeneralUtils::getBaseModelPath());

            require_once (GeneralUtils::getModelPath($model));
            return new $model;
        }
    }

    public function view($view, $data = array()){
        if (GeneralUtils::checkViewExist($view)){
            require_once (GeneralUtils::getViewPath($view));
        }
    }
}