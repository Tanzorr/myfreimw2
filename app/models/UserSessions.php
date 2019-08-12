<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 12.08.19
 * Time: 12:25
 */

class UserSessions extends Model
{
    public  function __construct($table)
    {
        $table = 'user_sessions';
        parent::__construct($table);
    }

}