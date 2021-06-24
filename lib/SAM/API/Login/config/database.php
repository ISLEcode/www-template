<?php

class Database {

    // specify your own database credentials
    private $dbhost = "localhost";
    private $dbname = "auth";
    private $uid = "root";
    private $upw = "Widenius1995!";
    public  $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname, $this->uid, $this->upw);
        }
        catch (PDOException $exception) { echo "Connection error: " . $exception ->getMessage(); }

        return $this->conn;
    }
}
