<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 03.08.2019
 * Time: 21:25
 */

class Session
{
    public static function exist($name){
        return (isset($_SESSION[$name]))?true :false;
    }

    public static function get($name){
        return $_SESSION[$name];
    }

    public  static function set($name, $value){
        return $_SESSION[$name]= $value;
    }

    public static function delete($name){
        if(self::exist($name)){
            unset($_SESSION[$name]);
        }
    }

    public static function ungent_no_version(){
        $uagent = $_SERVER['HTTP_USER_AGENT'];
        $regx = '/\/[a-zA-Z0-9.]+/';
        $newString = preg_replace($regx, '', $uagent);
        return $newString;
    }


}