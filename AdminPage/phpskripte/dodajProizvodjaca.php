<?php
    header('Content-type: application/json');
    //include_once '../config/connection.php';
    
    $mysqli = new mysqli('localhost','root','','grujovic');
    if($mysqli->error){
        die("Greska". $mysqli->error);
    }
    $proizvodjac = $_POST['tbProizvodjac'];

    $sql_verify = $mysqli->query("SELECT * FROM proizvodjaci WHERE naziv LIKE '$proizvodjac'");
    if(mysqli_num_rows($sql_verify)>0){
        $response_array['status']='fail';
    }
    else{
        
        $insert = $mysqli->query("INSERT INTO proizvodjaci (naziv) VALUES('$proizvodjac')");
        if($insert){
            $response_array['status']='success';
        }
        else{
            echo 'lose';
        }
        
    }
    echo json_encode($response_array);
?>