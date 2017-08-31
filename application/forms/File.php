<?php

class Application_Form_File extends Zend_Form
{

    public function init()
    {
        
        $userImg = new Zend_Form_Element_File('img');
        $userImg->setLabel('User Image')
                ->setRequired(true)
                ->setDestination(APPLICATION_PATH.'/../public/fileUpload')
                ->addValidator('NotEmpty')
                    ->getValidator('NotEmpty')
                    ->setMessage('Image user not null!!');
        $userImg->addValidator('Count',false,1);
        $userImg->addValidator('Size',false,3000000)
                    ->getValidator('Size')
                    ->setMessage('File size <= 3000000');
        $userImg->addValidator('Extension',true,'jpg,png,gif,jpeg')
                    ->getValidator('Extension')
                    ->setMessage('only type file: jpg,png,gif,jpeg');
        $buttonAdd = new Zend_Form_Element_Submit('Add');

        $this->addElements([$userImg,$buttonAdd]);
        $userImg->setDecorators(['File']);
    }


}

