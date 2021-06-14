<?php
class Cases
{

    private $db_connection;
    private $tableCases = "cases";

    // Object properties
    public $id;
    public $case_name;
    public $subtitle;
    public $details;
    public $is_unsolved;

    // Db Constructor
    public function __construct($db)
    {
        $this->db_connection = $db;
    }

    function readTable()
    {

        $query = "SELECT * FROM `" . $this->tableCases . "`";

        // Prepare query statement
        $stmt = $this
            ->db_connection
            ->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
