<?php
class News {

    private $db_connection;
    private $tableNews = "news";

    // Object properties
    public $id;
    public $date;
    public $title;
    public $link;

    // Db Constructor
    public function __construct($db) {
        $this->db_connection = $db;
    }

    function readTable() {

        $query = "SELECT * FROM `" . $this->tableNews . "`";

        // Prepare query statement
        $stmt = $this
            ->db_connection
            ->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
