<?php
class UnsolvedCase {

    private $db_connection;
    private $tableVictims = "victims";
    private $tableCases = "cases";

    // Object properties
    public $victimId;
    public $caseId;
    public $name;
    public $age;
    public $gender;
    public $division;
    public $date;
    public $image;
    public $caseName;
    public $subtitle;
    public $details;

    // Db Constructor
    public function __construct($db) {
        $this->db_connection = $db;
    }

    function getUnsolvedCaseById($victimId){
        $query = "SELECT victims.id AS `victimId`,
		                 cases.id AS `caseId`,
                         victims.name,
                         victims.age,
                         victims.gender,
                         victims.division,
                         victims.date,
                         victims.image,
                         cases.case_name AS `caseName`,
                         cases.subtitle,
                         cases.details 
                         FROM " .$this->tableVictims. " 
                         INNER JOIN " .$this->tableCases. " ON victims.case_id = cases.id 
                         WHERE victims.id = " .$victimId. "
                         AND cases.is_unsolved = 1";
        
                         // Prepare query statement
        $stmt = $this
            ->db_connection
            ->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
