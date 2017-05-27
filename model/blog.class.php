<?php 
namespace Dal\Model\Blog; 

use Dal\Model\Model; 

/** 
 * @Dal\Model 
 * @Dal\Table(name="blog") 
 * 
 * Defines the properties of the Blog entity. 
 * 
 * @author Nikola Knezevic <info@nikolaknezevich.com> 
 */ 

require 'model.class.php'; 

class Blog extends Model {
	/** 
	* The value for the id field. 
	* @var integer
	*/ 
	private $id; 
	/** 
	* The value for the title field. 
	* @var string
	*/ 
	private $title; 
	/** 
	* The value for the slug field. 
	* @var string
	*/ 
	private $slug; 
	/** 
	* The value for the blog_text field. 
	* @var text
	*/ 
	private $blog_text; 
	/** 
	 * Get the [id] column value. 
	 * 
	 * 
	 * @return integer
	 */ 
 	public function getId() 
	{ 
	  return $this->id; 
  } 
	/** 
	 * Get the [title] column value. 
	 * 
	 * 
	 * @return string
	 */ 
 	public function getTitle() 
	{ 
	  return $this->title; 
  } 
	/** 
	 * Get the [slug] column value. 
	 * 
	 * 
	 * @return string
	 */ 
 	public function getSlug() 
	{ 
	  return $this->slug; 
  } 
	/** 
	 * Get the [blog_text] column value. 
	 * 
	 * 
	 * @return text
	 */ 
 	public function getBlog_text() 
	{ 
	  return $this->blog_text; 
  } 
	/** 
	 * Set the value of [id] column. 
	 * 
	 * 
	 * @param integer $v 
	 * 
	 */ 
 	public function setId($v) 
 	{ 
		if ($v !== null && is_numeric ( $v )) { 
			$v = ( int ) $v; 
  	}; 
 		if ($this->id !== $v) { 
			$this->modifiedColumns [] = "id"; 
    }; 
 		$this->id = $v; 
	} 
	/** 
	 * Set the value of [title] column. 
	 * 
	 * 
	 * @param string $v 
	 * 
	 */ 
 	public function setTitle($v) 
 	{ 
 		if ($this->title !== $v) { 
			$this->modifiedColumns [] = "title"; 
    }; 
 		$this->title = $v; 
	} 
	/** 
	 * Set the value of [slug] column. 
	 * 
	 * 
	 * @param string $v 
	 * 
	 */ 
 	public function setSlug($v) 
 	{ 
 		if ($this->slug !== $v) { 
			$this->modifiedColumns [] = "slug"; 
    }; 
 		$this->slug = $v; 
	} 
	/** 
	 * Set the value of [blog_text] column. 
	 * 
	 * 
	 * @param text $v 
	 * 
	 */ 
 	public function setBlog_text($v) 
 	{ 
 		if ($this->blog_text !== $v) { 
			$this->modifiedColumns [] = "blog_text"; 
    }; 
 		$this->blog_text = $v; 
	} 
 
	public function getModifiedColumns(){ 
		return $this->modifiedColumns; 
   } 
 
	public function save($v=null){ 
		return parent::save($this); 
   } 
 
	public function delete($v=null){ 
		return parent::delete($this); 
   } 
 
 	public function getShortName() 
  {
  	$class = get_class($this); 
		$class = explode( "\\", $class ); 
    $class = end( $class ); 
    return strtolower ($class); 
 	} 
} 
