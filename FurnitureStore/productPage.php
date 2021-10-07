<?php include_once 'templates/headerUser.php';?>
<?php
session_start();
$mysqli = new mysqli('localhost','root','','grujovic');
if($mysqli->error){
    die("Greska". $mysqli->error);
}
 $userName = $_SESSION['users'];
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
    <div class="container">
        <a class="navbar-brand" >Furniture Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="proizvodi.php">Products</a>
                </li>
                
                
            </ul>
            <!--------Center container---->
            <ul class="navbar-nav me-auto ml-auto">
            
            </ul>
            <!------Right containerr------>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown"  id="cart-popover" role="button"  aria-expanded="false" data-bs-toggle="modal" data-bs-target="#modalKorpa">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="numOrd"></span>
                   <!--  <span class="total_price">Din. 0.00</span> -->
                    </a>
                    
                    </li>
                
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php 
                    $sqlData = $mysqli->query("SELECT * FROM users WHERE name ='$userName'");
                    while($finalResult = $sqlData->fetch_assoc()){
                        echo $finalResult['name'];
                    }
                    
                    
                     ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> Account</a></li>
                    <li><hr class="dropdown-divider"></li> -->
                    <li><a class="dropdown-item" href="../index.php"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
                </ul>
                </li>
                
            
               
                
            </ul>
        </div>
    </div>

</nav>

<div class="container mt-5">
    <div class="col-sm-12">
        <?php
        if(isset($_GET['id'])){
            $productGet = base64_decode($_GET['id']);
        }
        $choseProdbyID = $mysqli->query("SELECT * FROM product WHERE productID='$productGet'");
        while($result_proizvod=$choseProdbyID->fetch_assoc()):
            ?>
            
                <div class="card mb-3 text-center">
                
                    <image src="../AdminPage/images/<?php echo $result_proizvod['prod_images']?>" alt="<?php echo $result_proizvod['prod_images']?>" height="500px" width="1295px">
                    <div class="card-body mb-3 text-dark">
                        <h3 class="card-title"><?php echo $result_proizvod['naziv']?></h3>
                        <p class="card-text" ><strong>Price:<?php echo $result_proizvod['cena']?>.00 $</strong></p>
                        <p class="card-text"><strong>Avaliable amount:<?php echo $result_proizvod['kolicina']?> pieces</strong></p>
                        <h4 class="card-text" style="font-weight: 600">Description: </h4>
                        <p class="card-text"><?php echo $result_proizvod['opis'] ?> </p>
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="25">
                        <button  class="btn btn-primary btnKupi" data-id="<?php echo $result_proizvod['productID']?>" >Add to Cart</button>
                        <input type="hidden" id="price" name="price" value="<?php echo $result_proizvod['cena']?>">
                        <input type="hidden" id="name" name="name"  value="<?php echo $result_proizvod['naziv']?>">
                        <input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $result_proizvod['productID']?>">
                        <input type="hidden" id="dostupnaKol" value="<?php echo $result_proizvod['kolicina']?>">
                        
                        
                    </div>
                
            </div>
            
            
            
        <?php
        endwhile
        ?>
    </div>
    <div class="col-sm-12" id="korpa"></div>
</div>
<!-- MODAL FOR SHOPPING CART STARTS HERE -->
<div class="modal fade " id="modalKorpa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalContent">
          <span id="modalProizvod" name="modalProizvod">
        
        </span>
      </div>
      <div class="modal-footer">
      <button type="button"  class="btn btn-primary checkout">Checkout</button>
      </div>
    </div>
  </div>
</div>
<?php include_once 'templates/footerUser.php';?>

