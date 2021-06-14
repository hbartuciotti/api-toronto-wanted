<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// Includes
include_once '../../config/database.php';
include_once 'wantedCase.php';
  
// Database Instance
$database = new Database();
$db = $database->getConnection();
  
// Initialize object
$wantedCase = new WantedCase($db);
  
// Get result from query
$wantedId = intval($_GET['wantedId']);
$stmt = $wantedCase->getWantedCaseById($wantedId);
$num = $stmt->rowCount();
  
// Check if empty
if($num>0){

    $result['status'] = "success";
    $result['message'] = "Get WantedCase by wanted id";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // Extract row
        extract($row);
  
        $wantedCaseItem=array(
            "wantedId" => $wantedId,
            "caseId" => $caseId,
            "name" => $name,
            "charge" => $charge,
            "image" => $image,
            "video" => $video,
            "caseName" => $caseName,
            "subtitle" => $subtitle,
            "details" => $details
        );

        $result["wantedCase"] = $wantedCaseItem;
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
