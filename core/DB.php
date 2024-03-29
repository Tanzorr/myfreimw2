<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 26.07.19
 * Time: 18:17
 */

class DB
{
    private static $_instance =  null;
    private  $_pdo, $_query, $_error = false, $_result, $_count = 0, $_lastInsertID = null;

    private  function __construct()
    {


        try {
            $this->_pdo = new PDO("mysql:host=localhost;dbname=myfreim", "root", "root");
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
           
            
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public  static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }

        return self::$_instance;
    }

    public function query($sql, $params = [],$class = false) {
        $this->_error = false;

        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->_query->execute()) {
                if($class){
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_CLASS,$class);
                } else {
                    $this->_result = $this->_query->fetchALL(PDO::FETCH_OBJ);
                }
                $this->_count = $this->_query->rowCount();
                $this->_lastInsertID = $this->_pdo->lastInsertId();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    protected function _read($table, $params=[]){
        $conditionString = '';
        $bind = [];
        $order='';
        $limit='';
        //conditions
        if (isset($params['conditions'])){
            if(is_array($params['conditions'])){
                foreach ($params['conditions'] as $condition){
                    $conditionString .=' '. $condition . ' AND ';
                }
                $conditionString = trim($conditionString);
                $conditionString = rtrim($conditionString,' AND');
            }else{
                $conditionString =$params['conditions'];
            }
            if($conditionString !=''){
                $conditionString = ' WHERE '. $conditionString;
            }
           
        }
        //bind
        if(array_key_exists('bind',$params)){
            $bind = $params['bind'];
        }
        //order
        if (array_key_exists('order',$params)){
            $order = ' ORDER BY '.$params['order'];
        }
        //limit
        if (array_key_exists('limit',$params)){
            $order = " LIMIT ".$params['limit'];
        }

        $sql = "SELECT *FROM {$table}{$conditionString}{$order}{$limit}";
            echo 'bind';
       var_dump($bind);

        if ($this->query($sql,$bind)){
            if(!$this->count($this->_result)) return false;
            return true;
        }
        return false;
    }



    public  function find($table, $params){
        if ($this->_read($table, $params)){
            return $this->results();
        }
        return false;
    }

    public  function findFirst($table, $params=[]){
        if ($this->_read($table, $params =[])){
            return $this->first();
        }
        return false;
    }

    public function insert($table, $fieldes=[]){
        $fildString = '';
        $valueString = '';
        $values = [];
        foreach ($fieldes as $field=>$value){
            $fildString .='`'.$field.'`,';
            $valueString .= '?,';
            $values[] = $value;
        }
        $fildString = rtrim($fildString,',');
        $valueString = rtrim($valueString,',');
        $sql = "INSERT INTO {$table} ({$fildString})VALUES ({$valueString})";
        if (!$this->query($sql,$values)->error()){
            return true;
        }
        return false;

    }

    public function update($table,$id, $fieldes = []){
        $fieldString = '';
        $values =[];
        foreach ($fieldes as $field=>$value){
            $fieldString .=' '.$field. ' =? ,';
            $values[] = $value;
        }
        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString,',');
        $sql = "UPDATE {$table}  SET {$fieldString} WHERE  id={$id}";
        if (!$this->query($sql, $values)->error()){
            return true;
        }
        return false;
    }

    public  function delete($table,$id){
        $sql = "DELETE FROM {$table} WHERE  id = {$id}";
        if(!$this->query($sql)->error()){
            return false;
        }
        return false;
    }

    public  function results(){
        return $this->_result;
    }

    public  function  first(){
        return (!empty($this->_result))? $this->_result[0] :[];
    }

    public  function count(){
        return $this->_count;
    }

    public  function lastID(){
        return $this->_lastInsertID;
    }

    public  function get_columns($table){
        return $this->query("SHOW COLUMNS FROM {$table}")->results();
    }

    public function error(){
        return $this->_error;
    }

}