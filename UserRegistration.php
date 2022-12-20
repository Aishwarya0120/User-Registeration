<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');


$response = array();
 
$postdata = json_decode(file_get_contents("php://input"), true);
$email = $postdata['email'];
$phone = $postdata['phone'];
$password = $postdata['password'];
$confirm_password = $postdata['confirm_password'];


 if (isset($email) && isset($phone) && isset($password) && isset($confirm_password)) {

    require_once __DIR__ . '/db_connect.php';
 
    $db = new DB_CONNECT();
 
    $result = mysqli_query($db->connect(),"INSERT INTO User( email, phone, password, first_name , last_name , role ,confirm_password ,dateCreated) VALUES('$email', '$phone', '$password', '$confirm_password', NULL , NULL , NULL , NOW())");
 
    if ($result) {
        $response["success"] = 1;
        $response["message"] = "user registered created.";
 
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "Oops! Something went wrong.";
 
        echo json_encode($response);
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Required fields missing , please check and try again.";
 
    echo json_encode($response);
}
?>