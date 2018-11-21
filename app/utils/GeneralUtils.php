<?php

class GeneralUtils
{

    public static function getControllerPath($controller)
    {
        $project_path = dirname(dirname(__FILE__));
        $controller_path = $project_path. '/controller/';

        return $controller_path. ucwords($controller) . '.php';
    }

    public static function checkControllerExist($controller)
    {
        if (file_exists(self::getControllerPath($controller))){
            return true;
        }

        return false;
    }

    public static function getModelPath($model)
    {
        $project_path = dirname(dirname(__FILE__));
        $model_path = $project_path. '/model/';

        return $model_path. ucwords($model) . '.php';
    }

    public static function checkModelExist($model)
    {
        if (file_exists(self::getModelPath($model))){
            return true;
        }
        return false;
    }

    public static function getViewPath($view){
        $project_path = dirname(dirname(__FILE__));
        $view_path = $project_path. '/view/';

        return $view_path. $view . '.php';
    }

    public static function checkViewExist($view){
        if (file_exists(self::getViewPath($view))){
            return true;
        }
        return false;
    }
}