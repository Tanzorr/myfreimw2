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
        $this->load_model('User');
        $this->view->setLayout('default');
    }

    public function indexAction(){
        $this->view->render('register/login');
    }

    public function loginAction(){
        $validation = new  Validate();
        if ($_POST){
            //form validation
             $validation->check($_POST,[
                 'username'=>[
                     'display'=>'Username',
                     'required'=>true
                 ],
                'password'=>[
                    'display'=>'Password',
                    'required'=>true,
                    'min'=>6
                   ]
             ]);
             if ($validation->passed()){
                  $user = $this->UserModel->findByUsername($_POST['username']);

                  if ($user && $_POST['password'] === $user->password ){
                      $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true :false;
                    $user->login($remember);
                    Router::redirect('/');
                }else{
                      $validation->addError("There is an arror wit your username or password.");
                  }
             }
        }

        $this->view->displayErrors =  $validation->displayErrors();
        $this->view->render('register/login');
    }

    public function logoutAction(){
        $user = currentUser();

        if ($user){
            $user->logout();
        }

        Router::redirect('login');
    }

}