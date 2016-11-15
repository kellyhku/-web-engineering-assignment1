<?php

class Application_Form_ModifyMember extends Zend_Form
{
    private $ml;
//    public function __construct($ml)
//    {
//        $this->ml = $ml;
////        parent::__construct($options);
////        $email = new Zend_Form_Element_Text('email');
////        $email ->setLabel('email:')
////            ->setRequired(true)
////            ->addFilter('StringToLower')
////            ->addValidor('NotEmpty',true)
////            ->addValidor('EmailAddress');
////
////
////
////        $birthday = new Zend_Form_Element_Text('birthday');
////        $birthday ->setLabel('birthday:')
////            ->setRequired(true)
////            ->addValidor('date');
////        $this->addElements(array($email,$birthday));
//    }



    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add an name element
//        $this->addElement('text', 'member_login', array(
//            'label'      => 'login_ID:',
//            'required'   => true,
//            'validators' => array(
//                array('validator' => 'StringLength', 'options' => array(5, 20))
//            )
//        ));

        $element = new Zend_Form_Element_Text('member_login');
        $element->setLabel('login_ID:')
            ->addValidator(new Zend_Validate_Db_NoRecordExists('members', 'member_login'))
//            ->addValidator('Db_NoRecordExists', false, array(
//                'table'     => 'members',
//                'field'     => 'member_login',
//                'exclude'   => array(
//                    'field' => 'member_login',
//                    'value' => $this->ml
//            )
//            )
//        )
            ->setRequired(true)
            ->addValidator('stringLength', false, array(5, 20));
        $this->addElement($element);

        // Add an author element
        $this->addElement('text', 'member_password', array(
            'label'      => 'password:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(5, 5))
            )

        ));

        // Add an publisher element
        $this->addElement('text', 'first_name', array(
            'label'      => 'first name:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(3, 50))
            )
        ));

        // Add an isbn element
        $this->addElement('text', 'last_name', array(
            'label'      => 'last name:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(5, 50))
            )
        ));

//			 Add an price element
//        $this->addElement('text', 'email', array(
//            'label'      => 'email:',
//            'required'   => true,
//            'field'=>'email',
//
//        ));
//
//        // Add an category id element
//        $this->addElement('text', 'birthday', array(
//            'label'      => 'birthday:',
//            'required'   => true,
//        ));

        $email = new Zend_Form_Element_Text('email');
        $email ->setLabel('email:')
            ->setRequired(true)
            ->addFilter('StringToLower')
            ->addValidator('NotEmpty',true)
            ->addValidator('EmailAddress');



        $birthday = new Zend_Form_Element_Text('birthday');
        $birthday ->setLabel('birthday:')
            ->setRequired(true)
            ->addValidator('date');
        $this->addElements(array($email,$birthday));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Modify Member',
        ));
    }

    public function setMemberLogin($member_login){
        $this->getElement("member_login")->setValue($member_login);

        $this->getElement("member_login")->getValidator('Db_NoRecordExists')->
        setExclude([
            'field' => 'member_login',
            'value' => $member_login,
        ]);
}
    public function setMemberPassword($member_password){
        $this->getElement("member_password")->setValue($member_password);
    }
    public function setFirstName($first_name){
        $this->getElement("first_name")->setValue($first_name);
    }
    public function setLastName($last_name){
        $this->getElement("last_name")->setValue($last_name);
    }public function setEmail($email){
    $this->getElement("email")->setValue($email);
}public function setBirthday($birthday){
    $this->getElement("birthday")->setValue($birthday);
}
}
