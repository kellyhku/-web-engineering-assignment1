<?php
require_once APPLICATION_PATH . "/forms/Auth/Login.php";
require_once "Zend/Session/Namespace.php";

/**
 * Created by PhpStorm.
 * User: An
 * Date: 2016/11/12
 * Time: 11:26
 */
class AuthController extends Zend_Controller_Action
{

    public function  logoutAction(){
        $sess = new Zend_Session_Namespace("login");
        Zend_Session:: namespaceUnset("login");
        return $this->_redirect("/Auth/login");

    }

    public function loginAction()
    {
        $sess = new Zend_Session_Namespace("login");
        if($sess->id != ""){
            return $this->_redirect('/members/edit/id/'.$sess->id);
        }



        $db = $this->_getParam('dbname');
//        $db_config=Zend_Registry::get('db_config');
//        $db=Zend_Db::factory($db_config->db);
        $loginForm = new Default_Form_Auth_Login();

        if ($loginForm->isValid($_POST)) {

            $adapter = new Zend_Auth_Adapter_DbTable(
                $db,
                'members',
                'member_login',
                'member_password'
            );

            $adapter->setIdentity($loginForm->getValue('username'));
            $adapter->setCredential($loginForm->getValue('password'));

            $auth   = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);


            if ($result->isValid()) {
                $resultRow = $adapter->getResultRowObject();
                $this->_helper->FlashMessenger('Successful Login');


                $sess->id = $resultRow->member_id;

                $this->_redirect('/members/edit/id/'.$resultRow->member_id);


                return;
            }

        }

        $this->view->loginForm = $loginForm;

    }

}
?>