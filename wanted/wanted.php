<?php
class Wanted
{

    private $db_connection;
    private $tableWanted = "wanted";

    // Object properties
    public $id;
    public $case_id;
    public $name;
    public $charge;
    public $image;
    public $video;

    // Db Constructor
    public function __construct($db)
    {
        $this->db_connection = $db;
    }

    function readTable()
    {

        $query = "SELECT * FROM `" . $this->tableWanted . "`";

        // Prepare query statement
        $stmt = $this
            ->db_connection
            ->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
