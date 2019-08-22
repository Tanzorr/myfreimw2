<?php
/**
 * Created by PhpStorm.
 * User: alexx
 * Date: 21.08.19
 * Time: 13:22
 */

class ContactsController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
        $this->load_model('Contacts');
    }

    public function indexAction(){
        $contacts= $this->ContactsModel->find(['order'=>'lname, fname']);

        $this->view->contacts = $contacts;

        $this->view->render('contacts/index');
    }

    public function addAction(){
        $contact= new Contacts('contacts');
        $valifation = new Validate();
        if ($_POST){
            $contact->assign($_POST);
            $valifation->check($_POST, Contacts::$addValidation);
            if ($valifation->passed()){
                $contact->user_id = currentUser()->id;
                $contact->deleted = 0;
                $contact->save();
                Router::redirect('/contacts');
            }

        }
        $this->view->contact = $contact;
        $this->view->displayErrors = $valifation->displayErrors();
        $this->view->postAction = '/contacts'.DS.'add';
        $this->view->render('contacts/add');
    }

    public function detailsAction($id){



        $contact= $this->ContactsModel->findByUserId((int)$id);

        if (!$contact){
            Router::redirect('contacts');
        }
        $this->view->contact = $contact;
        $this->view->render('contacts/details');
    }


}