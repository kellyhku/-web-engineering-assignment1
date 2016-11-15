<?php

class Application_Model_MemberMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Members');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Member $member)
    {
        $data = array(
            'member_login' => $member->getMemberLogin(),
            'member_password' => $member->getMemberPassword(),
            'member_level' => ($member->getMemberLevel()=='')?1:$member->getMemberLevel(),
            'first_name' => $member->getFirstName(),
            'last_name' => $member->getLastName(),
            'email' => $member->getEmail(),
            'phone' => $member->getPhone(),
            'birthday' => $member->getBirthday(),
            'address' => $member->getAddress(),
            'notes' => $member->getNotes(),


            /*			'language'   => $book->getLanguage(),
                        'pages'   => $book->getPages(),
                        'edition'   => $book->getEdition(),
                        'binding'   => $book->getBinding(),
                        'description'   => $book->getDescription(),
                        'product_url'   => $book->getProductUrl(),
                        'notes'   => $book->getNotes(),
                        'is_recommended'   => $book->getIsRecommended(),
                        'rating'   => $book->getRating(),
                        'rating_count'   => $book->getRatingCount(),
            */
        );

        if (null == ($member_id = $member->getMemberId())) {
            unset($data['member_id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('member_id = ?' => $member_id));
        }
    }

    public function find($member_id, Application_Model_Member $member)
    {
        $result = $this->getDbTable()->find($member_id);

        if (0 == count($result)) {
            return;
    }
        $row = $result->current();

        $member->setMemberId($row->member_id);
        $member->setMemberLogin($row->member_login);
            $member->setMemberPassword($row->member_password);
            $member->setMemberLevel($row->member_level);
            $member->setFirstName($row->first_name);
            $member->setLastName($row->last_name);
            $member->setEmail($row->email);
            $member->setPhone($row->phone);
            $member->setBirthday($row->birthday);
            $member->setAddress($row->address);
            $member->setNotes($row->notes);

/*
				  ->setLanguage($row->language)
                  ->setPages($row->pages)
				  ->setEdition($row->edition)
                  ->setBinding($row->binding)
				  ->setDescription($row->description)
                  ->setProductUrl($row->product_url)
	                ->setNotes($row->notes)
				  ->setIsRecommended($row->is_recommended)
                  ->setRating($row->rating)
				  ->setRatingCount($row->rating_count);
*/
    }

//    public function fetchAll()
//    {
//        $resultSet = $this->getDbTable()->fetchAll();
//        $entries = array();
//        foreach ($resultSet as $row) {
//            $entry = new Application_Model_Member();
//            $entry->setMemberId($row->member_id)
//                ->setMemberLogin($row->member_login)
//                ->setMemberPassword($row->member_password)
//                ->setMemberLevel($row->member_level)
//                ->setFirstName($row->first_name)
//                ->setLastName($row->last_name)
//                ->setEmail($row->email)
//                ->setPhone($row->phone)
//                ->setBirthday($row->birthday)
//                ->setAddress($row->address)
//                ->setNotes($row->notes);
            /*
                              ->setLanguage($row->language)
                              ->setPages($row->pages)
                              ->setEdition($row->edition)
                              ->setBinding($row->binding)
                              ->setDescription($row->description)
                              ->setProductUrl($row->product_url)
                                ->setNotes($row->notes)
                              ->setIsRecommended($row->is_recommended)
                              ->setRating($row->rating)
                              ->setRatingCount($row->rating_count);
            */
//            $entries[] = $entry;
//        }
//        return $entries;
//    }
}

