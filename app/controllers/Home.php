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
            $contacts =  $db->findFirst('contacts2',[
                'conditions'=>['lname = ?'],
                'bind'=>['white']

            ]);

            var_dump($contacts);

            $this->view->render('home/index');
        }

}