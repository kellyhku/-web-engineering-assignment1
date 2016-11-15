<?php

//require_once "BaseController.php";
require_once APPLICATION_PATH."/models/BookHelper.php";
require_once APPLICATION_PATH."/models/Book.php";
require_once APPLICATION_PATH."/models/Items.php";




class SearchController extends Zend_Controller_Action
{

    public function init()
    {
//        parent::init();
    }



    public function searchAction()
    {
        $search_condition['name'] = $this->getRequest()->getParam("name");
        $bookHelper = new BookHelper(new Items());
        $arr = $bookHelper->getSearchResultsArr($search_condition);
        echo json_encode($arr);

        exit();

    }


}
