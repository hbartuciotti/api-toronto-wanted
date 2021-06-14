<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Includes
include_once '../../config/database.php';
include_once 'unsolvedCase.php';

// Database Instance
$database = new Database();
$db = $database->getConnection();

// Initialize object
$unsolvedCase = new UnsolvedCase($db);

// Get result from query
$victimId = intval($_GET['victimId']);
$stmt = $unsolvedCase->getUnsolvedCaseById($victimId);
$num = $stmt->rowCount();

// Check if empty
if ($num > 0) {

    $result['status'] = "success";
    $result['message'] = "Get UnsolvedCase by victim id";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Extract row
        extract($row);

        $unsolvedCaseItem = array(
            "victimId" => $victimId,
            "caseId" => $caseId,
            "name" => $name,
            "age" => $age,
            "gender" => $gender,
            "division" => $division,
            "date" => $date,
            "image" => $image,
            "caseName" => $caseName,
            "subtitle" => $subtitle,
            "details" => $details
        );

        $result["unsolvedCase"] = $unsolvedCaseItem;
    }

    // Set response code - 200 OK
    http_response_code(200);
    // Show data in json format
    echo json_encode($result);
} else {
    // Set response code - 404 Not found
    http_response_code(404);
    // Return message
    echo json_encode(
        array("status" => "fail")
    );
}
