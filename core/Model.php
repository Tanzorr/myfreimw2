<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 01.08.19
 * Time: 12:50
 */

class Model
{
    protected $_db, $_table, $_modulName, $_softDelete = false, $_columnNames = [];
    public $id;

    public function __construct($table)
    {
        $this->_db =DB::getInstance();
        $this->_table =$table;
        $this->_setTableColums();
        $this->_modulName = str_replace(' ','',ucwords(str_replace('_',' ',$this->_table)) );
    }

    public  function _setTableColumns(){
        $columns =  $this->get_colums();
        foreach ($columns as $column){
            $this->_columnNames[] = $column->Field;
            $this->{$columnName} = null;
        }
    }

    public  function get_columns(){
        return $this->_db->get_columns($this->_table);
    }

}