<?php

// database connection class

class DbClass {

    // database connection handler
    public $dbh;

    public function __construct(){
        // connect to database
        try {
            $this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            exit("Error: " . $e->getMessage());
        }
    }



}

?>