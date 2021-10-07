<?php
header('Content-type: application/json');

// require_once '../config/connection.php';
$mysqli = new mysqli('localhost','root','','grujovic');
if($mysqli->error){
    die("Greska". $mysqli->error);
}
$user = $_POST['UnosUsername'];
$email = $_POST['UnosEmail1'];
$pw = $_POST['UnosPW2'];

$sql_verify = $mysqli->query("SELECT * FROM users WHERE email LIKE '$email'");
if(mysqli_num_rows($sql_verify)>0){
    $response_array['status']='fail';
    
}
else{
    $sql_insert = $mysqli->query("INSERT INTO users (name,email,password,role) VALUES ('$user','$email','$pw','user')");
    if($sql_insert){
        $response_array['status']='success';
   
    
    }
}
echo json_encode($response_array);


?>