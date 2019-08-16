<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 23.07.19
 * Time: 16:19
 */

class Router
{

    public static function route($url) {

        //controller
        $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;
        $controller_name = str_replace('Controller','',$controller);
        array_shift($url);

        //action
        $action = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action': 'indexAction';
        $action_name = (isset($url[0]) && $url[0] != '')? $url[0] : 'index';
        array_shift($url);

        //acl check
        $grantAccess = self::hasAccess($controller_name, $action_name);

        if (!$grantAccess ){
            $controller_name = $controller = ACCESS_RESTRICTED;
            $action = 'indexAction';
        }



        //params
        $queryParams = $url;
        $controller =  $controller;
        $dispatch = new $controller($controller_name, $action);

        if(method_exists($controller, $action)) {
            call_user_func_array([$dispatch, $action], $queryParams);
        } else {
            die('That method does not exist in the controller \"' . $controller_name . '\"');
        }
    }


    public static function redirect($location) {
        if(!headers_sent()) {
            header('Location: '.$location);
            exit();
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.$location.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$location.'" />';
            echo '</noscript>';exit;
        }
    }

    public static function hasAccess($controller_name, $action_name='index'){
        $acl_file= file_get_contents(ROOT.DS.'app'.DS.'acl.json');
        $acl=json_decode($acl_file,true);
        $current_user_acls = ["Guest"];
        $grantAccess= false;

        if (Session::exist(CURRENT_USER_SESSION_NAME)){
            $current_user_acls[]="LoggedIn";
            foreach (currentUser()->acls()as $a){
                $current_user_acls[]=$a;
            }
        }

       // did($current_user_acls);

        return true;
    }
}