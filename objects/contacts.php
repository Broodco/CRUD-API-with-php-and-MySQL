<?php
    class Contacts{
        // Connection to db
        private $connection;
        private $table_name = "Contacts";
        // Object Properties
        public $id;
        public $username;
        public $email;
        public $city;
        public $country;
        public $job;
        // Constructor with $db as database connection
        public function __construct($db){
            $this->connection = $db;
        }
        // Read the Contacts info
        function read(){
            // Query to get the data needed
            $query = "SELECT * FROM Contacts ORDER BY id;";
            // Preparation of the query
            $stmt = $this->connection->prepare($query);
            // Execution of the query
            $stmt->execute();
            return $stmt;
        }
        // Read one row of the contact info
        function readOne(){
            // Query to geat the data needed
            $query = "SELECT * FROM Contacts WHERE id = ? LIMIT 0,1;";
            // Preparation of the query
            $stmt = $this->connection->prepare($query);
            // Bind the id of the required line
            $stmt->bindParam(1,$this->id);
            // Execution of the query
            $stmt->execute();
            // Retrieve the row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set Values to object properties
            $this->username = $row['username'];
            $this->email = $row['email'];
            $this->city = $row['city'];
            $this->country = $row['country'];
            $this->job = $row['job'];
        }
        // Create a row in the table
        function create(){
            // Query to insert the data
            $query = "INSERT INTO " . $this->table_name . " 
            SET username= :username, email= :email, city= :city, country= :country, job= :job";
            // Prepare query
            $stmt = $this->connection->prepare($query);
            // Sanitize
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->city=htmlspecialchars(strip_tags($this->city));
            $this->country=htmlspecialchars(strip_tags($this->country));
            $this->job=htmlspecialchars(strip_tags($this->job));
            // Bind Values
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":city", $this->city);
            $stmt->bindParam(":country", $this->country);
            $stmt->bindParam(":job", $this->job);
            // Execute Query
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        // Update the info of a row of the table
        function update(){
            // Query to update the data
            $query = "UPDATE " . $this->table_name . " 
            SET username= :username, email= :email, city= :city, country= :country, job= :job 
            WHERE id = :id ;";
            // Prepare query
            $stmt = $this->connection->prepare($query);
            // Sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->city=htmlspecialchars(strip_tags($this->city));
            $this->country=htmlspecialchars(strip_tags($this->country));
            $this->job=htmlspecialchars(strip_tags($this->job));
            // Bind Values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":city", $this->city);
            $stmt->bindParam(":country", $this->country);
            $stmt->bindParam(":job", $this->job);
            // Execute Query
            if($stmt->execute()){
                return true;
            }
            return false;        
        }
        // Delete a row of the table
        function delete(){
            // Delete query
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?; ";
            // Prepare query
            $stmt =$this->connection->prepare($query);
            // Sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            // Bind id of contact to delete
            $stmt->bindParam(1,$this->id);
            // Execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        // Search of a term in the table and read rows having it
        function search(){
            // Search query
            $query = "SELECT * FROM " . $this->table_name . " 
            WHERE username LIKE ? OR email LIKE ? OR city LIKE ? OR country LIKE ? OR job LIKE ?;";
            // Prepare query
            $stmt = $this->connection->prepare($query);
            // Sanitize
            $keywords = htmlspecialchars(strip_tags($keywords));
            $keywords = "%{$keywords}%";
            // Bind search params
            $stmt->bindParam(1,$keywords);
            $stmt->bindParam(2,$keywords);
            $stmt->bindParam(3,$keywords);
            $stmt->bindParam(4,$keywords);
            $stmt->bindParam(5,$keywords);
            // Execute query
            $stmt->execute();
            return $stmt;
        }
    }
?>