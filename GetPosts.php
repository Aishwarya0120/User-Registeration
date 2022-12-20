<?php
 header("Access-Control-Allow-Origin: *");
 header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
 header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
 header('Content-Type: application/json');

$response = array();
 

require_once __DIR__ . '/db_connect.php';
 

$db = new DB_CONNECT();
 

$result = mysqli_query($db->connect(), "SELECT *FROM Post");
 

if (mysqli_num_rows($result) > 0) {
   
    $response["data"] = array();
 
    while ($row = mysqli_fetch_array($result)) {
        $data = array();
        $task["UserID"] = $row["UserID"];
        $task["title"] = $row["title"];
        $task["post"] = $row["post"];
       
        array_push($response["data"], $data);
    }
    $response["success"] = 1;
 

    echo json_encode($response);
} else {
    
    $response["success"] = 0;
    $response["message"] = "No post found";
 
    
    echo json_encode($response);
}
?>