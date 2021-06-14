<?php
class Missing
{
    private $db_connection;
    private $tableMissing = "missing";

    // Object properties
    public $id;
    public $name;
    public $age;
    public $gender;
    public $ethnicity;
    public $location;
    public $since;
    public $details;
    public $description;
    public $image;


    // Db Constructor
    public function __construct($db)
    {
        $this->db_connection = $db;
    }


    function readTable()
    {
        $query = "SELECT * FROM `" . $this->tableMissing . "`";
        return $this->getStatement($query);
    }


    function getMissingById($id)
    {
        $query = "SELECT * FROM `" . $this->tableMissing . "` WHERE `id` = " . $id;
        return $this->getStatement($query);
    }

    
    private function getStatement($query)
    {
        // Prepare query statement
        $stmt = $this
            ->db_connection
            ->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
