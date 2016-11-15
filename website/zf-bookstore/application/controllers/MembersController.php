<?php
/**
 * Created by PhpStorm.
 * User: An
 * Date: 2016/11/12
 * Time: 12:47
 */

require_once APPLICATION_PATH."/models/Member.php";

class MembersController extends Zend_Controller_Action
{


    public function insertAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Member();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $member = new Application_Model_Member($form->getValues());
                $mapper  = new Application_Model_MemberMapper();
                $mapper->save($member);
                return $this->redirect('/auth/login');
            }
        }

        $this->view->form = $form;
    }

    public function editAction()
    {

        $sess = new Zend_Session_Namespace("login");

        if($sess->id == ""){
            return $this->redirect("/auth/login");
        }


        $request = $this->getRequest();
        $id = $request->getParam("id");

        $form    = new Application_Form_ModifyMember();
        $member    = new Application_Model_Member();
        $mapper  = new Application_Model_MemberMapper();
        $mapper->find($id, $member);

//        $form->populate((array)$member);
        $form->setMemberLogin($member->getMemberLogin());
        $form->setMemberPassword($member->getMemberPassword());
        $form->setFirstName($member->getFirstName());
        $form->setLastName($member->getLastName());
        $form->setEmail($member->getEmail());
        $form->setBirthday($member->getBirthday());

        if ($this->getRequest()->isPost()) {
                if ($form->isValid($request->getPost())) {
                    $member->setMemberPassword($form->getValue("member_password"));
                    $member->setMemberLogin($form->getValue("member_login"));
                    $member->setFirstName($form->getValue("first_name"));
                    $member->setLastName($form->getValue("last_name"));
                    $member->setEmail($form->getValue("email"));
                    $member->setBirthday($form->getValue("birthday"));
                    $mapper->save($member);
                    return $this->redirect("/auth/login");
                }
        }

        $this->view->form=$form;
//        $this->view->id=$id;


    }



}