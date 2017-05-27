<?php 
namespace Dal\Creator;

use Dal\Dal;
require 'dal.class.php';
class Creator extends Dal {
	public function buildObjects(){
		
	}
	
	public static function buildObject($filename){
		$entityOrm = parent::parseYML($filename);
		$entity = reset($entityOrm)['table'];
		$entityUp = ucfirst($entity);
		$primaryKey = reset($entityOrm);
		$primaryKeyName = key($primaryKey['id']);
		$primaryKeyType = reset($primaryKey['id'])['type'];
		$primaryKeyGeneratorStrategy = reset($primaryKey['id'])['generator']['strategy'];
		$classFile = fopen("model/".$entity.".class.php", "wa+");
		$classContent = "";
		$classContent .= "<?php \n";
		$classContent .= "namespace Dal\Model\\".$entityUp."; \n";
		$classContent .= "\n";
		$classContent .= "use Dal\Model\Model; \n";
		$classContent .= "\n";
		$classContent .= "/** \n";
		$classContent .= " * @Dal\Model \n";
		$classContent .= " * @Dal\Table(name=\"".$entity."\") \n";
		$classContent .= " * \n";
		$classContent .= " * Defines the properties of the ". $entityUp ." entity. \n";
		$classContent .= " * \n";
		$classContent .= " * @author Nikola Knezevic <info@nikolaknezevich.com> \n";
		$classContent .= " */ \n";
		$classContent .= "\n";
		$classContent .= "require 'model.class.php'; \n";
		$classContent .= "\n";
		$classContent .= "class ".$entityUp." extends Model {";
		$classContent .= "\n";
		$classContent .= "	/** \n";
		$classContent .= "	* The value for the ".$primaryKeyName." field. \n";
		$classContent .= "	* @var ".$primaryKeyType."\n";
		$classContent .= "	*/ \n";
		$classContent .= "	private $".$primaryKeyName."; \n";
		
		//Iterate through properties / fields
		$privatePropertiesContent = "";
		$getPropertiesContent = "";
		$setPropertiesContent = "";
		$getPropertiesContentPK = "";
		$setPropertiesContentPK = "";
		
		$fields = reset($entityOrm)['fields'];
		foreach ($fields as $key => $value){
			$privatePropertiesContent .= "	/** \n";
			$privatePropertiesContent .= "	* The value for the ".$key." field. \n";
			$privatePropertiesContent .= "	* @var ". $value['type'] ."\n";
			$privatePropertiesContent .= "	*/ \n";
			$privatePropertiesContent .= "	private $".$key."; \n";
		
			$getPropertiesContent .= "	/** \n";
			$getPropertiesContent .= "	 * Get the [". $key ."] column value. \n";
			$getPropertiesContent .= "	 * \n";
			$getPropertiesContent .= "	 * \n";
			$getPropertiesContent .= "	 * @return ". $value['type'] ."\n";
			$getPropertiesContent .= "	 */ \n";
			$getPropertiesContent .= " 	public function get".ucfirst($key)."() \n";
			$getPropertiesContent .= "	{ \n";
			$getPropertiesContent .= "	  return $"."this->". $key ."; \n";
			$getPropertiesContent .= "  } \n";
		
			$setPropertiesContent .= "	/** \n";
			$setPropertiesContent .= "	 * Set the value of [". $key ."] column. \n";
			$setPropertiesContent .= "	 * \n";
			$setPropertiesContent .= "	 * \n";
			$setPropertiesContent .= "	 * @param ".  $value['type'] ." \$v \n";
			$setPropertiesContent .= "	 * \n";
			$setPropertiesContent .= "	 */ \n";
			$setPropertiesContent .= " 	public function set".ucfirst($key)."(\$v) \n";
			$setPropertiesContent .= " 	{ \n";
		
			if($value['type'] == 'integer' || $value['type'] == 'decimal'){
				$setPropertiesContent .= "		if (\$v !== null && is_numeric ( \$v )) { \n";
				$setPropertiesContent .= "			\$v = ( int ) \$v; \n";
				$setPropertiesContent .= "    }; \n";
			}
		
			$setPropertiesContent .= " 		if (\$this->". $key ." !== \$v) { \n";
			$setPropertiesContent .= "			\$this->modifiedColumns [] = \"".$key."\"; \n";
			$setPropertiesContent .= "    }; \n";
			$setPropertiesContent .= " 		\$this->".$key." = \$v; \n";
			$setPropertiesContent .= "	} \n";
		}
		
		$classContent .= $privatePropertiesContent;
		$getPropertiesContentPK .= "	/** \n";
		$getPropertiesContentPK .= "	 * Get the [". $primaryKeyName ."] column value. \n";
		$getPropertiesContentPK .= "	 * \n";
		$getPropertiesContentPK .= "	 * \n";
		$getPropertiesContentPK .= "	 * @return ". $primaryKeyType ."\n";
		$getPropertiesContentPK .= "	 */ \n";
		$getPropertiesContentPK .= " 	public function get".ucfirst($primaryKeyName)."() \n";
		$getPropertiesContentPK .= "	{ \n";
		$getPropertiesContentPK .= "	  return $"."this->". $primaryKeyName ."; \n";
		$getPropertiesContentPK .= "  } \n";
		
		$classContent .= $getPropertiesContentPK;
		$classContent .= $getPropertiesContent;
		
		$setPropertiesContentPK .= "	/** \n";
		$setPropertiesContentPK .= "	 * Set the value of [". $primaryKeyName ."] column. \n";
		$setPropertiesContentPK .= "	 * \n";
		$setPropertiesContentPK .= "	 * \n";
		$setPropertiesContentPK .= "	 * @param ".  $primaryKeyType ." \$v \n";
		$setPropertiesContentPK .= "	 * \n";
		$setPropertiesContentPK .= "	 */ \n";
		$setPropertiesContentPK .= " 	public function set".ucfirst($primaryKeyName)."(\$v) \n";
		$setPropertiesContentPK .= " 	{ \n";
		$setPropertiesContentPK .= "		if (\$v !== null && is_numeric ( \$v )) { \n";
		$setPropertiesContentPK .= "			\$v = ( int ) \$v; \n";
		$setPropertiesContentPK .= "  	}; \n";
		$setPropertiesContentPK .= " 		if (\$this->". $primaryKeyName ." !== \$v) { \n";
		$setPropertiesContentPK .= "			\$this->modifiedColumns [] = \"".$primaryKeyName."\"; \n";
		$setPropertiesContentPK .= "    }; \n";
		$setPropertiesContentPK .= " 		\$this->".$primaryKeyName." = \$v; \n";
		$setPropertiesContentPK .= "	} \n";
		
		$classContent .= $setPropertiesContentPK;
		$classContent .= $setPropertiesContent;
		
		$classContent .= " \n";
		$classContent .= "	public function getModifiedColumns(){ \n";
		$classContent .= "		return \$this->modifiedColumns; \n ";
		$classContent .= "  } \n";
		
		$classContent .= " \n";
		$classContent .= "	public function save(\$v=null){ \n";
		$classContent .= "		return parent::save(\$this); \n ";
		$classContent .= "  } \n";
		
		$classContent .= " \n";
		$classContent .= "	public function delete(\$v=null){ \n";
		$classContent .= "		return parent::delete(\$this); \n ";
		$classContent .= "  } \n";
		
		$classContent .= " \n";
		$classContent .= " 	public function getShortName() \n";
		$classContent .= "  {\n";
		$classContent .= "  	\$class = get_class(\$this); \n";
		$classContent .= "		\$class = explode( \"\\\\\", \$class ); \n";
		$classContent .= "    \$class = end( \$class ); \n";
		$classContent .= "    return strtolower (\$class); \n";
		$classContent .= " 	} \n";
		
		$classContent .= "} \n";
		
		fwrite($classFile, $classContent);
		fclose($classFile);
	}
}