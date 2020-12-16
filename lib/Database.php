<?php
class Database {
     private $hostname = DB_HOST;
     private $username = USER_NAME;
     private $pass = USER_PASS;
     private $dbname = DB_NAME;
     private $connection;
     private $options;
     private $dsn;
     private $resultsSet;
     private $singleResult;
     private $rowCount;
     private $stmt;
     public function __construct(){
           try{
               $this->dsn =  'mysql:host='.$this->hostname.';dbname='.$this->dbname;
               $this->options  = [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_EMULATE_PREPARES => false
               ];
               $this->connection = new PDO ($this->dsn, $this->pass, $this->username, $this->options);

           }catch(PDOExpeption $e){
                die('ERROR' . $e->getMessage());
           }
     }
     public function query($sql){
          $this->stmt = $this->connection->prepare($sql);
     }
     public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch($value){
                  case  is_int($value):
                     $type = PDO::PARAM_INT;
                  break;
                  case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                  break;
                  case is_null($value):
                    $type = PDO::PARAM_NULL;
                  break;
                  default:
                  $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param,$value, $type);

     }
     public function execute(){
           return $this->stmt->execute();
     }
     public function resultSet(){
          $this->resultSet = $this->stmt->fetchAll();
          return $this->resultSet;
     }
     public function singleResult(){
          $this->singleResult = $this->stmt->fetch();
          return $this->singleResult;
     }
     public function rowCount(){
        $this->rowCount = $this->stmt->rowCount();
        return $this->rowCount;
    }


}