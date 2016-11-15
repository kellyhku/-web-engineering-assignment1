<?php
/**
 * Created by PhpStorm.
 * User: An
 * Date: 2016/11/12
 * Time: 11:25
 */
class Default_Form_Auth_Login extends Zend_Form
{
    public function init()
    {


        $this->setMethod('post');

        $this->addElement(
            'text', 'username', array(
            'label' => 'Username:',
            'required' => true,
            'filters'    => array('StringTrim'),
        ));

        $this->addElement('password', 'password', array(
            'label' => 'Password:',
            'required' => true,
        ));

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
        ));



    }

}



?>