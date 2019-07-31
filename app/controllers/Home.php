<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 24.07.19
 * Time: 16:39
 */

class Home extends Controller
{
        public function __construct($controller, $action)
        {
            parent::__construct($controller, $action);
        }

        public function indexAction(){
            $db = DB::getInstance();
            $fields = [
                'fname'=>'Toni2',
                'lname'=>'Parham2',
                'email'=>'Parham2@ukr.net'
            ];
           $columns = $db->get_columns('contacts2');

            var_dump($columns);

            $this->view->render('home/index');
        }

}