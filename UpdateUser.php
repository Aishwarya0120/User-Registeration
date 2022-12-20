<?php
 header("Access-Control-Allow-Origin: *");
 header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
 header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
 header('Content-Type: application/json');

$response = array();
 
$postdata = json_decode(file_get_contents("php://input"), true);
$UserID = $postdata['UserID'];
$first_name = $postdata['first_name'];
$last_name = $postdata['last_name'];
$role = $postdata['role'];


if (isset($UserID) && isset($first_name) && isset($last_name)) {
 

    require_once __DIR__ . '/db_connect.php';
 
    
    $db = new DB_CONNECT();
 
    
    $result = mysqli_query($db->connect(),"UPDATE tasks SET first_name = '$first_name', last_name = '$last_name', role = '$role', dateUpdated = NOW() WHERE UserID = $UserID");
 

    if ($result) {
        $response["success"] = 1;
        $response["message"] = "user successfully updated.";
 
        echo json_encode($response);
    } else {
 
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Required fields missing , please check and try again";
 
    echo json_encode($response);
}
?>