<?php
    header("Content-type:application/json");
    $mysqli = new mysqli('localhost','root','','grujovic');
    if($mysqli->error){
    die("Greska". $mysqli->error);
    }

    $nazivPr = $_POST['tbupdateProizvodjac'];
    $IDpr = $_POST['tbupdateProizvodjacID'];


    $update = $mysqli->query("UPDATE proizvodjaci SET naziv='$nazivPr' WHERE ID = '$IDpr'");
    if($update){
        $response_array['status'] = 'success';
        
    }
    else{
        $response_array['status'] = 'fail'; 
        
    }
    echo json_encode($response_array);
?>