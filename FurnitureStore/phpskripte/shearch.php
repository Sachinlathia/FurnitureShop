<?php

$mysqli = new mysqli('localhost','root','','grujovic');
if($mysqli->error){
    die("Greska". $mysqli->error);
}

$mainKey = $_POST['mainKey'];


$sqlResult = $mysqli->query("SELECT * FROM product WHERE naziv LIKE '%$mainKey%'");
if(mysqli_num_rows($sqlResult)>0){
    while($result = $sqlResult->fetch_assoc()){
        $output = '
        
        <div class="col-sm-3 mb-3">
                <div class="card" style="width: 18rem;">
                    <img src="../AdminPage/images/'.$result['prod_images'].'" height="200px" class="card-img-top" alt="'.$result['naziv'].'">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight:bold;">'.$result['naziv'].'</h5>
                        <p class="card-text">Price:'. $result['cena'].'.00 $.</p>
                        <a href="productPage.php?id='.base64_encode($result['productID']).'" class="btn btn-secondary">Detalji</a>
                    </div>
                    
                </div>
            </div>
        
       ';
    }
}
else{
    $output ='';
}

echo $output;

?>