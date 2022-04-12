<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PW', '');
define('DB_NAME', 'coderschat');

class Connection {

    private $dbhost = DB_HOST;
    private $dbname = DB_NAME;
    private $dbuser = DB_USER;
    private $dbpw = DB_PW;

   protected function connect(){

      try {
          $dsn = "mysql:host=" .$this->dbhost.";dbname=" . $this->dbname;
          $pdo = new PDO ($dsn, $this->dbuser, $this->dbpw);
          $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
          return $pdo;
      } 
      catch(PDOException $e){
          print "Error!" . $e->getMessage();
          die();
      }

   }



}




?>