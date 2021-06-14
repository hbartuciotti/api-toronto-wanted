<?php
class Victims
{

    private $db_connection;
    private $tableVictims = "victims";

    // Object properties
    public $id;
    public $case_id;
    public $name;
    public $age;
    public $gender;
    public $division;
    public $date;
    public $image;

    // Db Constructor
    public function __construct($db)
    {
        $this->db_connection = $db;
    }

    function readTable()
    {

        $query = "SELECT * FROM `" . $this->tableVictims . "`";

        // Prepare query statement
        $stmt = $this
            ->db_connection
            ->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
