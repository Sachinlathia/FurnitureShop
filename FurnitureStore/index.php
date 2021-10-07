<?php 
include_once 'templates/headerUser.php';
?>
<?php 
session_start();
if(isset($_COOKIE['welcomeMessage'])){
    //echo "Welcome ".$_SESSION['users']."";
    echo '<script type="text/javascript">
            setTimeout(function(){
            Swal.fire("HI! '.$_SESSION['users'].'"," welcome to our store.","success");
            },100);
            </script>';
}
else{
    echo "";
}



?>

<!--------USer DATA--->
<?php
$mysqli = new mysqli('localhost','root','','grujovic');
if($mysqli->error){
    die("Greska". $mysqli->error);
}

 $sqlData = $mysqli->query("SELECT * FROM users WHERE name ='".$_SESSION['users']."'");
 $finalResult = $sqlData->fetch_assoc();
?>

<!-------START OF THE NAVBAR------------->
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
                    <a class="nav-link dropdown"  id="cartBtn" role="button"  aria-expanded="false" data-bs-toggle="modal" data-bs-target="#modalKorpa">
                    <i class="fas fa-shopping-cart"></i>
                    </a>
                    
                    </li>
                    <?php
                    echo '<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        '.$finalResult['name'].'
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                         
                        <li><a class="dropdown-item" href="../index.php"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
                    </ul>
                    </li>'
                    
                    ?>
                   
                    
                </ul>
            </div>
        </div>
  
</nav>



<!-- Novi proizvodi -->
<div class="wrapperPopular">
    <div class="container mt-5 text-center">
        <h3 style="font-size 30px;"><strong>New Products</strong></h3>
    </div>
    
    <div class="container mt-5">
        <div class="row">
            <?php 
            
            $new = $mysqli->query("SELECT * FROM product WHERE tip ='New'");
            while($proizvod = $new->fetch_assoc()):
            ?>
            <div class="col-sm-3 mb-3">
                <div class="card" style="width: 18rem;">
                    <img src="../AdminPage/images/<?php echo $proizvod['prod_images']?>" height="200px" class="card-img-top" alt="<?php echo $proizvod['naziv']?>">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight:bold;"><?php echo $proizvod['naziv']?></h5>
                        <p class="card-text">Cena:<?php echo $proizvod['cena']?>.00 DIN.</p>
                        <!-- <a href="#" class="btn btn-primary">Stavi u korpu</a> -->
                        <a href="productPage.php?id=<?php echo base64_encode($proizvod['productID'])?>" class="btn btn-secondary">Detalji</a>
                    </div>
                    
                </div>
            </div>
            <?php endwhile ?>
        </div>
    </div>
</div>
<div class="wrapperPopular">
    <div class="container mt-5 text-center">
        <h3 style="font-size 30px;"><strong>Popular products</strong></h3>
    </div>
    
    <div class="container mt-5">
        <div class="row">
            <?php 
            $popular = $mysqli->query("SELECT * FROM product WHERE tip ='Popular'");
            while($Popproizvod = $popular->fetch_assoc()):
            ?>
            <div class="col-sm-3 mb-3">
                <div class="card" style="width: 18rem;">
                    <img src="../AdminPage/images/<?php echo $Popproizvod['prod_images']?>" height="200px" class="card-img-top" alt="<?php echo $Popproizvod['naziv']?>">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight:bold;"><?php echo $Popproizvod['naziv']?></h5>
                        <p class="card-text">Cena:<?php echo $Popproizvod['cena']?>.00 DIN.</p>
                        <!-- <a href="#" class="btn btn-primary">Stavi u korpu</a> -->
                        <a href="productPage.php?id=<?php echo base64_encode($Popproizvod['productID'])?>" class="btn btn-secondary">Detalji</a>
                    </div>
                    
                </div>
            </div>
            <?php endwhile ?>
        </div>
    </div>
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

<?php 
include_once 'templates/footerUser.php';
?>