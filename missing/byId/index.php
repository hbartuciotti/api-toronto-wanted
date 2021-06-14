<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// Includes
include_once '../../config/database.php';
include_once '../missing.php';
  
// Database Instance
$database = new Database();
$db = $database->getConnection();
  
// Initialize object
$missing = new Missing($db);
  
// Get result from query
$id = intval($_GET['id']);
$stmt = $missing->getMissingById($id);
$num = $stmt->rowCount();
  
// Check if empty
if($num>0){
  
    $result['status'] = "success";
    $result['message'] = "Get missing by id";
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // Extract row
        extract($row);
  
        $missingItem=array(
            "id" => $id,
            "name" => $name,
            "age" => $age,
            "gender" => $gender,
            "ethnicity" => $ethnicity,
            "location" => $location,
            "since" => $since,
            "details" => $details,
            "description" => $description,
            "image" => $image
        );
        
        $result["missing"]=$missingItem;
    }
  
    // Set response code - 200 OK
    http_response_code(200);
    // Show data in json format
    echo json_encode($result);
}
else{
    // Set response code - 404 Not found
    http_response_code(404);
    // Return message
    echo json_encode(
        array("status" => "fail")
    );
}
