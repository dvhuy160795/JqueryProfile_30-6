<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
        $this->setEnctype(Zend_Form::ENCTYPE_MULTIPART);
        $userName = new Zend_Form_Element_Text('name');
        $userName->setLabel('User Name')
                 ->setRequired(true)
                 ->addFilter('StringToUpper')
                 ->addValidator('NotEmpty')
                    ->getValidator('NotEmpty')
                    ->setMessage('User Name is empty !!');
        $userName->addValidator('StringLength', false,[6,32])
                    ->getValidator('StringLength')
                    ->setMessage('String length only 6 to 32 letter!!');

        $userAge = new Zend_Form_Element_Text('age');
        $userAge->setLabel('User Age')
                ->setRequired(true)
                ->addValidator('NotEmpty')
                    ->getValidator('NotEmpty')
                    ->setMessage('User age is empty');
        $userAge->addValidator('Int', false)
                    ->getValidator('Int')
                    ->setMessage('User must be Integer');
        $userId = new Zend_Form_Element_Hidden('id');
        $buttonAdd = new Zend_Form_Element_Submit('Add');
        $buttonUpdate = new Zend_Form_Element_Submit('Update');
        $this->addElements([$userName,$userAge,$userId,$buttonAdd,$buttonUpdate]);

        foreach( $this->getElements() as $element){
            $element->setDecorators(['ViewHelper']);
        }
        
    }


}

