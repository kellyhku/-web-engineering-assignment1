<?php

class Application_Model_BookMapper
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
            $this->setDbTable('Application_Model_DbTable_Books');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Book $book)
    {
        $data = array(
            'category_id'   => $book->getCategoryId(),
			'name'   => $book->getName(),
			'author'   => $book->getAuthor(),
			'publisher'   => $book->getPublisher(),
			'isbn'   => $book->getIsbn(),
			'price'   => $book->getPrice(),
			'image_url'   => $book->getImageUrl(),
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

        if (null === ($id = $book->getId())) {
            unset($data['item_id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('item_id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Book $book)
    {
        $result = $this->getDbTable()->find($id);
        
		if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        
		$book->setId($row->item_id)
				  ->setCategoryId($row->category_id)
                  ->setName($row->name)
				  ->setAuthor($row->author)
                  ->setPublisher($row->publisher)
				  ->setIsbn($row->isbn)
                  ->setPrice($row->price)
				  ->setImageUrl($row->image_url);
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

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Book();
            $entry->setId($row->item_id)
                  ->setCategoryId($row->category_id)
                  ->setName($row->name)
				  ->setAuthor($row->author)
                  ->setPublisher($row->publisher)
				  ->setIsbn($row->isbn)
                  ->setPrice($row->price)
				  ->setImageUrl($row->image_url);
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
            $entries[] = $entry;
        }
        return $entries;
    }
}

