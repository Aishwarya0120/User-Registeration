<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');


$response = array();
 
$postdata = json_decode(file_get_contents("php://input"), true);
$UserID = $postdata['UserID'];
$title = $postdata['title'];
$post = $postdata['post'];


 if (isset($title) && isset($post) ) {

    require_once __DIR__ . '/db_connect.php';
 
    $db = new DB_CONNECT();
 
    $result = mysqli_query($db->connect(),"INSERT INTO Post( title, post, dateCreated) VALUES('$title', '$post',  NOW() WHERE UserID = $UserID");
 
    if ($result) {
        $response["success"] = 1;
        $response["message"] = "post created.";
 
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