<?php
class Database
{
    // Database Credentials
    private $host = "PRIVATE";
    private $db_name = "PRIVATE";
    private $username = "PRIVATE";
    private $password = "PRIVATE";
    public $conn;

    // Get the database connection
    public function getConnection()
    {
        $this->conn = null;
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this
                ->conn
                ->exec("set names utf8");
        }
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
