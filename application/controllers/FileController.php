<?php

class FileController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $fileForm = new Application_Form_File();

        $this->view->form = $fileForm;
    }

    public function addAction()
    {
        $fileForm = new Application_Form_File();
        $fileInfo = new Zend_File_Transfer();

        $userPostForm = $this->getRequest()->isPost();
        $isValidDataForm = $fileForm->isValid($this->getRequest()->getPost());

        if($userPostForm){
            if($isValidDataForm){
                $fileForm->getValues();
                return $this->_helper->json($fileInfo->getFileInfo());
            }
        }
    }


}



