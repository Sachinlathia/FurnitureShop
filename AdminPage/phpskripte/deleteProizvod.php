<?php 

 header("Content-type:application/json");
$mysqli = new mysqli('localhost','root','','grujovic');
if($mysqli->error){
    die("Greska". $mysqli->error);
}
$proizvodID = $_POST['proizvodID'];


$delete = $mysqli->query("DELETE FROM product WHERE productID ='$proizvodID'");
if($delete){
    $response_array['status']='uspeh';
    
}
else{
    $response_array['status']='nije';
    
}
 
echo json_encode($response_array);

?>