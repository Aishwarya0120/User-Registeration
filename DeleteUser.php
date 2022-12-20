<?php
 header("Access-Control-Allow-Origin: *");
 header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
 header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
 header('Content-Type: application/json');


 
$response = array();

$postdata = json_decode(file_get_contents("php://input"), true);
$UserID = $postdata['UserID'];
 

if (isset($UserID)) {
 
    require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();
 
    $result = mysqli_query($db->connect(),"DELETE FROM tasks WHERE UserID = $UserID");
 

    if ($result) {
        $response["success"] = 1;
        $response["message"] = "User successfully deleted";
 
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "No task found";
 
        echo json_encode($response);
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    echo json_encode($response);
}
?>
