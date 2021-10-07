<?php 
/* header("Content-type:application/json"); */
$mysqli = new mysqli('localhost','root','','grujovic');
if($mysqli->error){
    die("Greska". $mysqli->error);
}
$proizID = $_POST['IDdel'];


$delete = $mysqli->query("DELETE FROM proizvodjaci WHERE ID ='$proizID'");
if($delete){
    $response_array['status']='uspeh';
    
}
else{
    $response_array['status']='nije';
    
}
 
echo json_encode($response_array);

?>