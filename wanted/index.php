<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Includes
include_once '../config/database.php';
include_once 'wanted.php';

// Database Instance
$database = new Database();
$db = $database->getConnection();

// Initialize object
$wanted = new Wanted($db);

// Get result from query
$stmt = $wanted->readTable();
$num = $stmt->rowCount();

// Check if empty
if ($num > 0) {

    $result['status'] = "success";
    $result['message'] = "Get wanted table";
    $result["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Extract row
        extract($row);

        $wantedItem = array(
            "id" => $id,
            "caseId" => $case_id,
            "name" => $name,
            "charge" => $charge,
            "image" => $image,
            "video" => $video
        );
        array_push($result["data"], $wantedItem);
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
