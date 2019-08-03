<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 03.08.2019
 * Time: 13:23
 */

class Register extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    public function indexAction(){
        $this->view->render('register/login');
    }

    public function loginAction(){

        $this->view->render('register/login');
    }

}