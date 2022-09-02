<?php
final class Authentication{
    private $conn;
    private $apiKey;
    private $table_name = "users";

    public function __construct($conn, $apiKey)
    {
        $this->conn = $conn;
        $this->apiKey = $apiKey;
        
    }

    private function findDeveloper()
    {
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    gcm_regid = :hash";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":hash", $this->apiKey);

    
        // execute query
        $stmt->execute();

    
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function authenticate()
    {
        return $this->findDeveloper();
    }
}