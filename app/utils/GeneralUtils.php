<?php

class GeneralUtils
{
    public static function getBaseModelPath()
    {
        $projectPath = self::getProjectPath();
        $baseModelPath = $projectPath.'/model/BaseModel.php';
        return $baseModelPath;
    }

    public static function getControllerPath($controller)
    {
        $project_path = self::getProjectPath();
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
        $project_path = self::getProjectPath();
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
        $project_path = self::getProjectPath();
        $view_path = $project_path. '/view/';

        return $view_path. $view . '.php';
    }

    public static function checkViewExist($view){
        if (file_exists(self::getViewPath($view))){
            return true;
        }
        return false;
    }

    public static function getProjectPath(){
        return dirname(dirname(__FILE__));
    }

    public static function isPostRequest(){
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public static function redirect($page = ''){
        header('location:'.URL_ROOT.'/' . $page);
    }
}