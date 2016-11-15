<?php

class Application_Form_Member extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);

    }



    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add an name element
//        $this->addElement('text', 'memberLogin', array(
//            'label'      => 'login_ID:',
//            'required'   => true,
//			'validators' => array(
//                array('validator' => 'StringLength', 'options' => array(5, 20))
//                )
//        ));

        $element = new Zend_Form_Element_Text('memberLogin');
        $element->setLabel('login_ID:')
            ->addValidator(new Zend_Validate_Db_NoRecordExists('members', 'member_login'))
            ->setRequired(true)
            ->addValidator('stringLength', false, array(5, 20));
        $this->addElement($element);

		// Add an author element
        $this->addElement('text', 'memberPassword', array(
            'label'      => 'password:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(5, 5))
            )
            
        ));
		
		// Add an publisher element
        $this->addElement('text', 'firstName', array(
            'label'      => 'first name:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(3, 50))
            )
        ));
	
		// Add an isbn element
        $this->addElement('text', 'lastName', array(
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
//            'field' => 'email',
//
//               ));
//
//		// Add an category id element
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
            'label'    => 'Add Member',
        ));
    }
}
