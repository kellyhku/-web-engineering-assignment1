<?php

class Application_Model_Book
{
    protected $_id;
    protected $_name;
	protected $_categoryId;
	protected $_author;
	protected $_publisher;
	protected $_isbn;
	protected $_price;
	protected $_imageUrl;
	/*
	protected $_language;
	protected $_pages;
	protected $_edition;
	protected $_binding;
	protected $_description;
	protected $_productUrl;
	protected $_notes;
	protected $_isRecommended;
	protected $_rating;
	protected $_ratingCount;
	*/
	
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid book property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid book property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setName($text)
    {
        $this->_name = (string) $text;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }
   
    public function setCategoryId($id)
    {
        $this->_categoryId = (int) $id;
        return $this;
    }

    public function getCategoryId()
    {
        return $this->_categoryId;
    }
	
	public function setAuthor($text)
    {
        $this->_author = (string) $text;
        return $this;
    }

    public function getAuthor()
    {
        return $this->_author;
    }
	
	public function setPublisher($text)
    {
        $this->_publisher = (string) $text;
        return $this;
    }

    public function getPublisher()
    {
        return $this->_publisher;
    }
	
	public function setIsbn($text)
    {
        $this->_isbn = (string) $text;
        return $this;
    }

    public function getIsbn()
    {
        return $this->_isbn;
    }
	
	public function setPrice($price)
    {
        $this->_price = (float) $price;
        return $this;
    }

    public function getPrice()
    {
        return $this->_price;
    }

	public function setImageUrl($url)
    {
        $this->_imageUrl = (string) $url;
        return $this;
    }
	public function getImageUrl()
    {
        return $this->_imageUrl;
    }
/*
	
	public function setLanguage($text)
    {
        $this->_language = (string) $text;
        return $this;
    }

    public function getLanguage()
    {
        return $this->_language;
    }
	
	public function setPages($pages)
    {
        $this->_pages = (int) $pages;
        return $this;
    }

    public function getPages()
    {
        return $this->_pages;
    }
	
	public function setEdition($text)
    {
        $this->_edition = (string) $text;
        return $this;
    }

    public function getEdition()
    {
        return $this->_edition;
    }
	
	public function setBinding($text)
    {
        $this->_binding = (string) $text;
        return $this;
    }

    public function getBinding()
    {
        return $this->_binding;
    }
	
	public function setDescription($text)
    {
        $this->_description = (string) $text;
        return $this;
    }

    public function getDescription()
    {
        return $this->_description;
    }
	
	public function setProductUrl($url)
    {
        $this->_productUrl = (string) $url;
        return $this;
    }

    public function getProductUrl()
    {
        return $this->_productUrl;
    }
	
	public function setNotes($text)
    {
        $this->_notes = (int) $text;
        return $this;
    }

    public function getNotes()
    {
        return $this->_notes;
    }
	
	public function setIsRecommended($text)
    {
        $this->_isRecommended = (int) $text;
        return $this;
    }

    public function getIsRecommended()
    {
        return $this->_isRecommended;
    }
	
	public function setRating($rating)
    {
        $this->_rating = (int) $rating;
        return $this;
    }

    public function getRating()
    {
        return $this->_rating;
    }
	
	public function setRatingCount($count)
    {
        $this->_ratingCount = (int) $count;
        return $this;
    }

    public function getRatingCount()
    {
        return $this->_ratingCount;
    }
	*/
}

