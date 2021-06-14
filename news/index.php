<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// Includes
include_once '../config/database.php';
include_once 'news.php';
  
// Database Instance
$database = new Database();
$db = $database->getConnection();
  
// Initialize object
$news = new News($db);
  
// Get result from query
$stmt = $news->readTable();
$num = $stmt->rowCount();
  
// Check if empty
if($num>0){
  
    $result['status'] = "success";
    $result['message'] = "Get news table";
    $result["data"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // Extract row
        extract($row);
  
        $news_item=array(
            "id" => $id,
            "date" => $date,
            "title" => $title,
            "link" => $link
        );
        array_push($result["data"], $news_item);
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
