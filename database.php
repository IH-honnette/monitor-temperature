<?php
class Database{
	
    private $host  = 'localhost';
    private $user  = 'root';
    private $password  ="root";
    private $database  = "iot_data_mgt"; 
      
    public function getConnection(){		
          $connection = new mysqli($this->host, $this->user, $this->password, $this->database);
          if($connection->connect_error) {
              die("Failed to connect: " . $connection->connect_error);
          } else {
              return $connection;
          }
      }
  }
?>