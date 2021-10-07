<?php
    header('Content-type: application/json');
    //include_once '../config/connection.php';
    
    $mysqli = new mysqli('localhost','root','','grujovic');
    if($mysqli->error){
        die("Greska". $mysqli->error);
    }

    $userEmail = $_POST['email_verify'];
    $passw = $_POST['noviPass'];

    $update =  $mysqli->query("UPDATE users SET password='$passw' WHERE email lIKE'$userEmail'");
    if($update){
        $response_array['status']='success';
       //echo 'success';
    }
    else{
        $response_array['status']='fail';
      // echo 'fail';

    }
   echo json_encode($response_array);
?>