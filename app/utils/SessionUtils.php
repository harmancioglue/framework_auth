<?php

class SessionUtils
{
    /** can be customized */

    public static function createFlashMessage($name = '',$message='',$type = 'success'){

        $class = $type =='success' ? 'alert alert-success' : 'alert alert-warning';

        if (!empty($name) && !empty($message)){

            unset($_SESSION[$message]);
            unset($_SESSION[$message .'_class']);

            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;

        }

    }

    public static function getFlashMessage($name){

        if (isset($_SESSION[$name]) && !empty($_SESSION[$name])){

            echo '<div id="msg-flash" class="'.$_SESSION[$name .'_class'].'">'. $_SESSION[$name] .'</div>';
            unset($_SESSION[$name]);
        }
    }

    public static function setUser($user){
        if (!is_null($user)){
            $_SESSION['user'] = $user;
        }
    }

    public static function getUser()
    {
        if (self::isUserLogin())
        {
            return $_SESSION['user'];
        }

        return false;
    }

    public static function isUserLogin(){
        if (isset($_SESSION['user']) && !is_null($_SESSION['user'])){
            return true;
        }

        return false;
    }

    public static function logoutUser(){
        unset($_SESSION['user']);
    }
}