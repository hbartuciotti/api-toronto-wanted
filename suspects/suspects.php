<?php
class Suspects
{

    private $db_connection;
    private $tableSuspects = "suspects";

    // Object properties
    public $id;
    public $case_id;
    public $name;
    public $age;
    public $image;

    // Db Constructor
    public function __construct($db)
    {
        $this->db_connection = $db;
    }

    function readTable()
    {

        $query = "SELECT * FROM `" . $this->tableSuspects . "`";

        // Prepare query statement
        $stmt = $this
            ->db_connection
            ->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
