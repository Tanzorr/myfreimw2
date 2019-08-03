<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 03.08.2019
 * Time: 22:05
 */

class Useer extends Model
{
    private $_isLoggedIn, $_sessionName, $_cookieName;
    public  static $curentLoggedInUser = null;

    public function __construct($user='')
    {
        $table ='user';
        parent::__construct($table);
        $this->_sessionName($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        $this->_sessionName=REMEMBER_ME;
    }

}