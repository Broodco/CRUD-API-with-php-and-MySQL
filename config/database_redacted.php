<?php
    class Database {
        // Creation of private properties i.o.to connect to the db
        private $host = "localhost";
        private $username = "--";
        private $password = "--";
        private $database = "--";
        // Get the database connection
        public $connection;
        public function getConnection(){
            $this->connection = null;
            try{
                $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $this->connection->exec("set names utf8");
            } catch (PDOException $exception){
                echo "Error : " . $exception->getMessage();
            }
            return $this->connection;
        }
    }
?>
