<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 26.07.19
 * Time: 17:33
 */

class Tools extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    public function indexAction(){
        $this->view->render('tools/index');
    }


    public function firstAction(){
        $this->view->render('tools/first');
    }


    public function secondAction(){
        $this->view->render('tools/second');
    }


    public function thridAction(){
        $this->view->render('tools/third');
    }


}