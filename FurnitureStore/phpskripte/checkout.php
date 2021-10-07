<?php 
session_start();
$mysqli = new mysqli('localhost','root','','grujovic');
if($mysqli->error){
    die("Greska". $mysqli->error);
}
$response_array['output'] ='';
if(!empty($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $key=> $value){
        $id = $value['p_id'];
        $qty = $value['p_qty'];
        $sqlData = $mysqli->query("SELECT * FROM product WHERE productID ='$id'");
        while($result= $sqlData->fetch_assoc()){
            if($qty <= $result['kolicina']){
                $novaKolicina= $result['kolicina'] - $qty;
                $update = $mysqli->query("UPDATE product SET kolicina ='$novaKolicina' WHERE productID ='$id'");
                if($update){
                    $response_array['status'] = 'moze';
                    unset($_SESSION['cart']);
                }
                else{
                    $response_array['status']='greska';
                }
                
            }
            else{
                $response_array['status'] = 'ne';
                $response_array['output'] .= ' | '.$value['p_name'].'';
            }
        }
    }
    
}else{
    $response_array['status'] = 'prazno';;
}
    
echo json_encode($response_array);



?>