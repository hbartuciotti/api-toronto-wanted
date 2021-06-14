<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Includes
include_once '../config/database.php';
include_once 'victims.php';

// Database Instance
$database = new Database();
$db = $database->getConnection();

// Initialize object
$victims = new Victims($db);

// Get result from query
$stmt = $victims->readTable();
$num = $stmt->rowCount();

// Check if empty
if ($num > 0) {

    $result['status'] = "success";
    $result['message'] = "Get victims table";
    $result["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Extract row
        extract($row);

        $victimItem = array(
            "id" => $id,
            "caseId" => $case_id,
            "name" => $name,
            "age" => $age,
            "gender" => $gender,
            "division" => $division,
            "date" => $date,
            "image" => $image
        );
        array_push($result["data"], $victimItem);
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
