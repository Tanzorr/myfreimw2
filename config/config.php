<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 23.07.19
 * Time: 15:57
 */


define('DEBUG',true);
define('DEFAULT_CONTROLLER', 'Home'); // default controller if there isn't6 one in the url
define('DEFAULT_LAYOUT','default'); // if not layout is set the controller use this layout.
define('SITE_TITLE','MVS framework');// this title will use if no site name will set;
define('PROOT', 'myfeimw.net'); // set this to '/' for a live server.

define('DB_NAME','myfreim');
define('DB_USER','root');
define('DB_PASSWORD','root');
define('DB_HOST','localhost');