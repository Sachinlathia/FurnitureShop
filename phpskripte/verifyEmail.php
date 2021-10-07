<?php
    header('Content-type: application/json');
    //include_once '../config/connection.php';
    
    $mysqli = new mysqli('localhost','root','','grujovic');
    if($mysqli->error){
        die("Greska". $mysqli->error);
    }
    $userEmail = $_POST['email_verify'];

    $sql_verify = $mysqli->query("SELECT * FROM users WHERE Email LIKE '$userEmail'");
    if(mysqli_num_rows($sql_verify)>0){
        $response_array['status']='success';
    }
    else{
        $response_array['status']='fail';

    }
    echo json_encode($response_array);
?>