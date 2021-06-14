<?php
class WantedCase {

    private $db_connection;
    private $tableWanted = "wanted";
    private $tableCases = "cases";

    // Object properties
    public $wantedId;
    public $caseId;
    public $name;
    public $charge;
    public $image;
    public $video;
    public $caseName;
    public $subtitle;
    public $details;

    // Db Constructor
    public function __construct($db) {
        $this->db_connection = $db;
    }
    
    function getWantedCaseById($wantedId){
        $query = "SELECT wanted.id AS `wantedId`,
		                 cases.id AS `caseId`,
                         wanted.name,
                         wanted.charge,
                         wanted.image,
                         wanted.video,
                         cases.case_name AS `caseName`,
                         cases.subtitle,
                         cases.details 
                         FROM " .$this->tableWanted. " 
                         INNER JOIN " .$this->tableCases. " ON wanted.case_id = cases.id 
                         WHERE wanted.id = " .$wantedId. " 
                         AND cases.is_unsolved = 0";

        // Prepare query statement
        $stmt = $this
            ->db_connection
            ->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
