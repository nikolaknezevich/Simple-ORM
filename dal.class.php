<?php

/*
 * Superclass Dal
 *
 * (c) Nikola Knezevic <info@nikolaknezevich.com>
 *
 */

namespace Dal;
require __DIR__.'/vendor/autoload.php';

//require_once 'lib/yaml/Yaml.php';
//require_once 'lib/yaml/Parser.php';
//require_once 'lib/yaml/Inline.php';

use Symfony\Component\Yaml\Yaml;
use mysqli;
use Exception;

class Dal {
	
	protected $host;
	protected $username;
	protected $password;
	protected $database;
	protected $conn;
	
	/**
	 * Connects to a database using parameters from database.yaml
	 */
	public function __construct()
	{
			
			/* connect to database */
			$this->_readConfig();
			$this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
			if ($this->conn->connect_errno) {
				printf("Connection failed: %s\n", $this->conn->connect_error);
				exit();
			}
			$this->conn->select_db($this->database);	
	}	
	
	public  function execute($sql){
		
		$result = mysqli_query($this->conn,$sql);
		if (!$result)
		{
			return mysqli_error($this->conn);
		} else {
			return $result;
		}
		/* close connection */
		//$this->conn->close();
	}
	
	private function _readConfig(){
		$config = Yaml::parse(file_get_contents('config.yml'));
		$this->host = $config['database']['host'];
		$this->username = $config['database']['username'];
		$this->password = $config['database']['password'];
		$this->database = $config['database']['database'];
	}
	
	public static function parseYML($yml_file){
		return Yaml::parse(file_get_contents($yml_file));
	}
	
	private function _connect(){
		
	}
}