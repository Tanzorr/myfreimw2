<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 07.08.19
 * Time: 16:48
 */

class Validate
{
        private $_passed =false, $_errors=[], $db=null;

        public function __construct()
        {
            $this->db =DB::getInstance();
        }

        public function check($source, $items=[]){
            $this->_errors =[];
            foreach ($items as $item=>$rules){
                $item = Input::sanitize($item);
                $display = $rules['display'];
                foreach ($rules as $rule=>$rule_value){
                    $value = Input::sanitize((trim($source[$item])));
                    if ($rule === 'required' && empty($value)){
                        $this->addError(["{$display} is required", $item]);
                    }else if (!empty($value)){
                        switch ($rules){
                            case 'min':
                                if (strlen($value)<$rule_value){
                                    $this->$this->addError(["{$display} must be  a minimum of {$rule_value} charsets",$item]);
                                }
                                break;

                            case 'max':
                                if (strlen($value)>$rule_value){
                                    $this->$this->addError(["{$display} must be  a maximum of {$rule_value} charsets",$item]);
                                }
                                break;
                        }
                    }
                }
            }
        }

        public function addError($error){
            $this->_errors[] =  $error;
            if (empty($this->_errors)){
                $this->_passed =  true;
            }else{
                $this->_passed =false;
            }
        }
}