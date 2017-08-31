<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $userForm = new Application_Form_User();
        $userTable =  new Zend_Db_Table('user');
       
        $userDatas = $userTable->fetchAll()->toArray();

        $this->view->userForm = $userForm;
        $this->view->users = $userDatas;
    }

    public function addAction()
    {
        $userForm = new Application_Form_User();
        $userTable = new Zend_Db_Table('user');

        $errorMessages = [
            'messages' =>'User not post form',
            'data' => []
        ];
        $userPostForm = $this->getRequest()->isPost();
        $isValidForm = $userForm->isValid($this->getRequest()->getPost());
        $filteredUserForm = $userForm->getValues();
        
        if (!$userPostForm) {
            return $errorMessages;
        }
        
        if (!$isValidForm) {
            $this->setError400($userForm,$errorMessages);
        }

        
        $lastId = $userTable->insert($filteredUserForm);
        $filteredUserForm['id'] = $lastId;
        return $this->_helper->json($filteredUserForm);
    }

    public function editAction()
    {
        $userTable = new Zend_Db_Table('user');
        $userForm = new Application_Form_User();

        $errorMessages = [
            "message" => "this is not post form",
            "data" => []
        ];

        $userPostForm = $this->getRequest()->isPost();
        $isValidForm = $userForm->isValid($this->getRequest()->getPost());
        $filteredUserForm = $userForm->getValues();
        if (!$userPostForm) {
            return $errorMessages;
        }
        if (!$isValidForm){
            $this->setError400($userForm,$errorMessages);
        }

        $userId = $filteredUserForm['id'];
        unset($filteredUserForm['id']);
        $userTable->update($filteredUserForm,["id = ?" => $userId]);
        $filteredUserForm['id'] = $userId;
        return $this->_helper->json($filteredUserForm);
    }

    private function setError400($userForm,$errorMessages){
        $this->getResponse()->setHttpResponseCode(400);
        $errorMessages['data'] = $userForm->getMessages();
        return $this->_helper->json($errorMessages);
    }

}





