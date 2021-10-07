<?php 
$mysqli = new mysqli('localhost','root','','grujovic');
if($mysqli->error){
die("Greska". $mysqli->error);
}

$naziv = $_POST['naziv'];
$ID = $_POST['id'];
$cena = $_POST['cena'];
$kolicina = $_POST['kolicina'];
$proizvodjac = $_POST['proizvodjac'];
$opis = $_POST['opis'];
$tip = $_POST['tip'];
$kategorija = $_POST['kategorija'];



$updateProizvod = $mysqli->query("UPDATE product SET naziv='$naziv', cena='$cena', kolicina='$kolicina', prod_proizID='$proizvodjac', opis='$opis', tip='$tip', kategorija='$kategorija' WHERE productID ='$ID'");

if($updateProizvod){
    $response_array['status'] = 'success';
    
}
else{
    $response_array['status'] = 'fail'; 
    
} 
 echo json_encode($response_array);


?>