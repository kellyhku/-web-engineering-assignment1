<?php
require_once APPLICATION_PATH."/models/Items.php";

class BooksController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		/* default to the view action */
		$this->_redirect('/books/view');
		//$this->_helper->redirector('view');		
	}
	
	/* List of all the books */
	public function viewAction()
    {
        $book = new Application_Model_BookMapper();
        $this->view->books = $book->fetchAll();
    }
	
	/* Insert a new book */
    public function insertAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Book();
		
		if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $book = new Application_Model_Book($form->getValues());
                $mapper  = new Application_Model_BookMapper();
                $mapper->save($book);
                return $this->_helper->redirector('view');
            }
        }

        $this->view->form = $form;
    }

	/* Update the book record */
	public function editAction()
    {
        $request = $this->getRequest();
		$id = $request->getParam("id");

        $form    = new Application_Form_Book();
        $book    = new Application_Model_Book();
		$mapper  = new Application_Model_BookMapper();
        $mapper->find($id, $book);
		
		$form->populate($book);
		
		$this->view->form=$form;

    }	
	public function detailAction()
    {
        $request = $this->getRequest();
		$id = $request->getParam("id");
        
        $book    = new Application_Model_Book();
		$mapper  = new Application_Model_BookMapper();
        $mapper->find($id, $book);
		$this->view->book = $book;
		
    }



//    public function searchAction()
//    {
//        $search_condition['name'] = $this->getRequest()->getParam("name");
//        $bookHelper = new Application_Model_BookHelper(new Items());
//        $arr = $bookHelper->getSearchResultsObj($search_condition);
//        $this->search->books = $arr;
////        $this->view->books = array(
////            'category_id'   => "1",
////            'name'   => "1",
////            'author'   => "1",
////            'publisher'   => "1",
////            'isbn'   => "1",
////            'price'   => "1",
////            'image_url'   => "1",
////            /*			'language'   => $book->getLanguage(),
////                        'pages'   => $book->getPages(),
////                        'edition'   => $book->getEdition(),
////                        'binding'   => $book->getBinding(),
////                        'description'   => $book->getDescription(),
////                        'product_url'   => $book->getProductUrl(),
////                        'notes'   => $book->getNotes(),
////                        'is_recommended'   => $book->getIsRecommended(),
////                        'rating'   => $book->getRating(),
////                        'rating_count'   => $book->getRatingCount(),
////            */
////        );
////        $book = new Application_Model_BookMapper();
////        $this->view->books = $book->fetchAll();
//
//
//    }


}
