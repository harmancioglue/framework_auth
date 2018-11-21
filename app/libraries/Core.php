<?php

class Core
{
    private $current_controller = 'Home';
    private $current_method = 'index';
    private $parameters = array();


    public function __construct()
    {
        $this->run();
    }


    private function run()
    {
        /**
         * home/about --> controller=home, method=about
         */
        $url = $this->getUrl();


        /** check controller exists */
        $controller = isset($url[0]) ? $url[0] : null;
        $this->getAndInitiliazeController($controller);
        unset($url[0]);


        /** check method exist */
        if (isset($url[1])){
            $this->getMethod($url[1]);
            unset($url[1]);
        }

        /** check params */
        if (!empty($url)){
            $this->parameters = array_values($url);
        }

        /** call the method from controller with params */
        call_user_func_array([$this->current_controller,$this->current_method],$this->parameters);

    }

    private function getMethod($method)
    {
        if (method_exists($this->current_controller,$method)){
            $this->current_method = $method;
        }
    }

    private function getAndInitiliazeController($controller)
    {
        if (!is_null($controller)){
            if (GeneralUtils::checkControllerExist($controller)){
                $this->current_controller = ucwords($controller);
            }
        }

        require_once(GeneralUtils::getControllerPath($this->current_controller));

        $this->current_controller = new $this->current_controller;
    }

    private function getUrl()
    {
        if (isset($_GET['url']))
        {
            $url = $_GET['url'];
            $url = explode('/', rtrim($url, '/'));
            return $url;
        }
        return false;
    }

}