<?php include_once 'templates/headerUser.php';?>

<?php
session_start();
$mysqli = new mysqli('localhost','root','','grujovic');
if($mysqli->error){
    die("Greska". $mysqli->error);
}

 $sqlData = $mysqli->query("SELECT * FROM users WHERE name ='".$_SESSION['users']."'");
 $finalResult = $sqlData->fetch_assoc();
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
            <!--------Center container (SHEARCH BAR SHOULD BE DONE WITH ONE MORE CONTROLE IN MYSQLI DATA BASE THAT CONTAINS ALL KEY WORDS)---->
            <ul class="navbar-nav me-auto ml-auto">
            <form class="d-flex">
                <input class="form-control me-2 ch_length" id="search_bar" data-bs-toggle="popover" title="ShearchPopover" data-bs-trigger="focus" data-bs-html="true" data-bs-content="" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn " data-bs-toggle="modal" data-bs-target="#filterModal" id="filterBtn" type="button"><i class="fas fa-filter"></i></button>
            </form>
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
<!-- PAGE STARTS HERE -->


<div class="container mt-5">
   
    <div class="col-sm-12" id="shearchVisible" visibility="hidden">
    <div class="row" id="shearchResult">
    </div>
    </div>
    <div class="col-sm-12" id="filterVisible" visibility="hidden">
    <div class="row" id="filterResults">
    </div>
    </div>
    
    <div class="col-sm-12" id="baseProducts">
    <div class="row">
    
        <?php
        
        $allProd= $mysqli->query("SELECT * FROM product ");
        while($result_proizvod=$allProd->fetch_assoc()):
            ?>
            <div class="col-sm-3 mb-3" >
                <div class="card" style="width: 18rem;">
                    <img src="../AdminPage/images/<?php echo $result_proizvod['prod_images']?>" height="200px" class="card-img-top" alt="<?php echo $result_proizvod['naziv']?>">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight:bold;"><?php echo $result_proizvod['naziv']?></h5>
                        <p class="card-text">Price:<?php echo $result_proizvod['cena']?>.00 $</p>
                        <!-- <a href="#" class="btn btn-primary">Stavi u korpu</a> -->
                        <a href="productPage.php?id=<?php echo base64_encode($result_proizvod['productID'])?>" class="btn btn-secondary">Details</a>
                    </div>
                    
                </div>
            </div>
        <?php
        endwhile
        ?>
        </div>
    </div>
    <div class="col-sm-12" id="korpa">


    </div>
</div>
<!-- MODAL FOR FILTERS STARTS HERE -->
<div class="modal fade " id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"  >Filter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="ModalBody">
      <div class="row">
           
            <div class="col-md-6">
            <div class="list-group">
                <h6>Maker</h6>
                <select class="form-select" name="sbProizvodjac" id="sbProizvodjac"aria-label="Default select example">
                    <option selected value="0">---Select maker-----</option>
                    <?php 
                        $getProiz = $mysqli->query("SELECT * FROM proizvodjaci");
                        while($total = $getProiz->fetch_assoc()) :
                    ?>
                    <option value="<?php echo $total['ID']; ?>" ><?php echo $total['naziv']; ?></option>
                   <?php
                    endwhile
                    ?>
                </select>
            </div>
            </div>
            <div class="col-md-6">
            <div class="list-group">
                <h6>Category</h6>
                <select class="form-select" name="sbKategorija" id="sbKategorija"aria-label="Default select example">
                    <option selected value="0">---Select Category-----</option>
                    <?php 
                        $getKategorija = $mysqli->query("SELECT DISTINCT kategorija FROM product");
                        while($total = $getKategorija->fetch_assoc()) :
                    ?>
                    <option value="<?php echo $total['kategorija']; ?>" ><?php echo $total['kategorija']; ?></option>
                   <?php
                    endwhile
                    ?>
                </select>
            </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="resetFilter" name="resetFilter">Reset</button>
        <button type="button" class="btn btn-primary" id="primeniBtn" name="primeniBtn">Apply filter</button>
      </div>
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


<?php include_once 'templates/footerUser.php';?>

