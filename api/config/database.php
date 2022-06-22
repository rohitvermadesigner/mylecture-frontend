<?php

class Database
{
    // specify your own database credentials
    private $host = "10.153.47.201";
    private $db_name = "babjdecd_db";
    private $username = "babjdecd_dbuser";
    private $password = "Gemsdb@2022";
    public $conn;

    // get the database connection
    public function getConnection()
    {
        $this->conn = null;
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
        // Check connection
        if (mysqli_error($this->conn)) {
            die("Connection failed: " . mysqli_error($this->conn));
        }
        return $this->conn;
    }
}
