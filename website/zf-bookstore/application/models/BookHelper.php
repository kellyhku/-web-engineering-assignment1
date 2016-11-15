<?php
require_once 'Book.php';
    class BookHelper
    {
        protected  $dbAdapter;

        public function __construct($items)
        {
            $this->dbAdapter = $items->getAdapter();
        }

        public function getDbAdapter()
        {
            return $this->dbAdapter;
        }

        /**
         * @param field_type $dbAdapter
         */
        public function setDbAdapter($dbAdapter)
        {
            $this->dbAdapter = $dbAdapter;
        }


        public function getSearchResultsArr($search_condition)
        {
            $sql = "SELECT name,author,price,category_id,image_url FROM `items` where
               name LIKE '%{$search_condition['name']}%' ORDER BY name ASC";
            $resultSet = $this->dbAdapter->query($sql)->fetchAll();
//            $entries   = array();
//            foreach ($resultSet as $row) {
//                $entry = new Application_Model_Book();
//                $entry->setId($row["item_id"])
//                    ->setCategoryId($row["category_id"])
//                    ->setName($row["name"])
//                    ->setAuthor($row["author"])
//                    ->setPublisher($row["publisher"])
//                    ->setIsbn($row["isbn"])
//                    ->setPrice($row["price"])
//                    ->setImageUrl($row["image_url"]);
//
//                $entries[] = $entry;
//            }
//            return $entries;
            return $resultSet;
        }

        public function getSearchResultsObj($search_condition)
        {
            $sql = "SELECT * FROM `items` where name like '%{$search_condition['name']}%'ORDER BY name ASC";

            $resultSet = $this->dbAdapter->query($sql)->fetchAll();
            $entries   = array();
            foreach ($resultSet as $row) {
                $entry = new Application_Model_Book();
                $entry->setId($row["item_id"])
                    ->setCategoryId($row["category_id"])
                    ->setName($row["name"])
                    ->setAuthor($row["author"])
                    ->setPublisher($row["publisher"])
                    ->setIsbn($row["isbn"])
                    ->setPrice($row["price"])
                    ->setImageUrl($row["image_url"]);

                $entries[] = $entry;
            }


            return $entries;
        }
    
        
    }
?>