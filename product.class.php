<?php 


namespace Dal\Model\Product;

use Dal\Model\Model;

/**
 * @Dal\Model
 * @Dal\Table(name="product")
 * 
 * Defines the properties of the Product entity.
 *
 * @author Nikola Knezevic <info@nikolaknezevich.com>
 */

require 'model.class.php';

class Product extends Model {
	/**
	 * The value for the id field.
	 *
	 * @var int
	 */
	private $id;
	/**
	 * The value for the name field.
	 *
	 * @var string
	 */
	private $name;
	/**
	 * The value for the price field.
	 *
	 * @var decimal
	 */
	private $price;
	/**
	 * The value for the description field.
	 *
	 * @var string
	 */
	private $description;
	
	/**
	 * Get the [id] column value.
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Get the [name] column value.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	/**
	 * Get the [price] column value.
	 *
	 * @return decimal
	 */
	public function getPrice()
	{
		return $this->price;
	}
	/**
	 * Get the [description] column value.
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}
	/**
	 * Set the value of [id] column.
	 *
	 * @param int $v
	 *        	
	 */
	public function setId($v)
	{
		if ($v !== null && is_numeric ( $v )) {
			$v = ( int ) $v;
		}
		if ($this->id !== $v) {
			$this->modifiedColumns [] = "id";
		}
		$this->id = $v;
	}
	/**
	 * Set the value of [name] column.
	 *
	 * @param string $v
	 *
	 */
	public function setName($v)
	{
		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns [] = "name";
		}
	}
	/**
	 * Set the value of [price] column.
	 *
	 * @param decimal $v
	 *
	 */
	public function setPrice($v)
	{
		if ($v !== null && is_numeric ( $v )) {
			$v = ( int ) $v;
		}
		if ($this->price !== $v) {
			$this->modifiedColumns [] = "price";
		}
		$this->price = $v;
	}
	/**
	 * Set the value of [description] column.
	 *
	 * @param string $v
	 *
	 */
	public function setDescription($v)
	{
		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns [] = "description";
		}
	}
	
	public function getModifiedColumns(){
		return $this->modifiedColumns;
	}
	
	public function save($v = null){
		parent::save($this);
	}
	
	public function delete(){
		
	}
	
	public function getShortName()
	{
		$class = get_class($this);
		$class = explode( "\\", $class );
		$class = end( $class );
		return strtolower ($class);
	}
}