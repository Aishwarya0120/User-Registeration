<?php
class DB_CONNECT {
 
    function __construct() {
        $this->connect();
    }
 
    function __destruct() {
        $this->close();
    }
 
    # connection
    function connect() {
        require_once __DIR__ . '/db_config.php';
 
        
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_connect_error());
 
    
        $db = mysqli_select_db($con, DB_DATABASE) or die(mysqli_connect_error()) or die(mysqli_connect_error());
 
    
        return $con;
    }
 
    # connection-close
    function close() {
        mysqli_close($this->connect());
    }
 
}
 