<?php 
namespace Dal\Model;

use Dal\Dal;
require 'dal.class.php';
abstract class Model extends Dal {
	private $modifiedColumns;
	
	public function save($v = null){
	 //var_dump(get_called_class());
		foreach($this->getModifiedColumns() as $column){
			$properties[] = $column;
			$column = 'get'. ucfirst ($column); 
			$propertyValue = call_user_func(array($v, $column));
			
			if ($propertyValue !== null && is_numeric ( $propertyValue )){
				$value = $propertyValue;
			} else {
				$value = "'".$propertyValue."'";
			}
			$values[] = $value;
		}
		
		if (empty($v->getId())){
			$SQL = "INSERT INTO ".$v->getShortName()." (". implode(',',  $properties). ") VALUES (".implode(',', $values).")";
			parent::execute($SQL);
		} else {
			$SQL = "UPDATE ".$v->getShortName()." SET ";
			$index = 0;
			foreach($properties as $property){
				if($index !== 0) $SQL .=", ";
				$SQL .= $property .'='.$values[$index];
				$index++;
			}
			$SQL .= " WHERE id=". $v->getId();
			//var_dump($SQL);
			parent::execute($SQL);
		}
	}
	
	public function delete(){
	
	}
	
	public function getModifiedColumns(){
		
	}

}

