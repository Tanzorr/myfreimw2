<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 06.08.19
 * Time: 13:27
 */

class Input
{

    public static function sanitaze($dirty){
        return htmlentities($dirty, ENT_QUOTES, "UTF-8");
    }

    public static function get($input){
        if(isset($_POST[$input])){
            return self::sanitaze($_POST[$input]);
        }else if(isset($_GET[$input])){
            return self::sanitaze($_GET[$input]);
        }
    }

}