<?php
include_once 'templates/header.php'; 
$mysqli = new mysqli('localhost','root','','grujovic');
if($mysqli->error){
    die("Greska". $mysqli->error);
}
session_start();


 if(isset($_POST['addProizvod'])){
     $proizvodjac = $_POST['sbProizvodjac'];
     $naziv = $_POST['nazivPr'];
     $kolicina = $_POST['kolicinaPr'];
     $cena = $_POST['tbCena'];
     $opis = $_POST['tbOpis'];
     $tip = $_POST['sbTip'];
     $kategorija = $_POST['sbKategorija'];
     /* product picture */
     $slika_org = $_FILES['proizvodSlika']['name'];
     $slika_temp = $_FILES['proizvodSlika']['tmp_name'];
     move_uploaded_file($slika_temp,"images/$slika_org");

     $insert = $mysqli->query("INSERT INTO product(prod_images,prod_proizID,cena,kolicina,naziv,opis,tip,kategorija) VALUES('$slika_org','$proizvodjac','$cena','$kolicina','$naziv','$opis','$tip','$kategorija')");
     if($insert){
        echo '<script type="text/javascript">
		setTimeout(function(){
			Swal.fire("Well done","You have successfully added a product","success");
			},100)
			</script>';
     } 
     else{
        echo '<script type="text/javascript">
		setTimeout(function(){
			Swal.fire("Error","Something went wrong!","error");
			},100)
			</script>';
     }
 }
?>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" >Furniture Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       </ul>
       <ul class="navbar-nav me-auto ml-auto"></ul>
      <ul class="navbar-nav ml-auto"> 
        <li class="nav-item">
          <a class="nav-link">Admin:</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['users']?>
        
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php"><i class="fas fa-plus"></i>Add Maker</a></li>
            <li><a class="dropdown-item" href="proizvod.php"><i class="fas fa-plus"></i>Add Product</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../index.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
          </ul>
        </li>
        </ul>
    </div>
  </div>
</nav>

<!----------------Proizvod addBox----------------------->
<div class="container mt-5 mb-5 purpl ch_proizvodjaci">
<h3 class="ch_absoulte">Proizvodi</h3>

</div>


<div class="container">
  <div class="row">
  <div class="row" id="editProizvod">
  </div>
    <div class="row" id="addProizvod">
    <div class="col-sm-6">
        <form method="post" enctype="multipart/form-data">
                <label for="">Chose Maker:</label>
                <select class="form-select" name="sbProizvodjac" id="sbProizvodjac"aria-label="Default select example">
                    <option selected value="0">---Select Maker-----</option>
                    <?php 
                        $getProizvodjaci = $mysqli->query("SELECT * FROM proizvodjaci");
                        while($total = $getProizvodjaci->fetch_assoc()) :
                    ?>
                    <option value="<?php echo $total['ID']; ?>" ><?php echo $total['naziv']; ?></option>
                   <?php
                    endwhile
                    ?>
                </select>
                <label for="" >Description:</label>
                
                <textarea class="form-control" name="tbOpis" id="tbOpis" rows="3"></textarea>
                
                <label for="">Chose a type of offer:</label>
                <select class="form-select" name="sbTip" id="sbTip" aria-label="Default select example">
                    <option selected value="0">---Select type-----</option>
                    <option value="Popular">Popular</option>
                    <option value="New">New</option>
                    <option value="Regular">Regular</option>
                </select>
                <label for="">Chose category:</label>
                <select class="form-select" name="sbKategorija" id="sbKategorija" aria-label="Default select example">
                    <option selected value="0">---Select Category-----</option>
                    <option value="Kreveti">Kreveti</option>
                    <option value="Garniture">Garniture</option>
                    <option value="Stolice">Stolice</option>
                </select>
                <div class="form-group">
                    <button type="submit" name="addProizvod"class="btn btn-block purpl">Add</button>
                </div>
                
            </div>
            <div class="col-sm-6">
                <label for="">Name of product:</label>
                <input type="text" class="form-control" name="nazivPr" id="nazivPr" placeholder="Name of product...">
                <label for="">Quantity:</label>
                <input type="text" class="form-control" name="kolicinaPr" id="kolicinaPr" placeholder="Product quantity...">
                <label for="">Price:</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="text" name="tbCena" id="tbCena" class="form-control" aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text">.00</span>
                </div>
                <label for="">Product picture:</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="proizvodSlika" id="proizvodSlika" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <!-- <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Upload</button> -->
                </div>
                

            </div>
            
       </form>
       </div>
        

        <div class="col-sm-8">
            <table class="table text-center">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Type</th>
                    <th scope="col">Category</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="tabelaProizvoda">
                
                </tbody>
             </table>
          </div>
  </div>
  
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js" ></script>
<script src="js/popper.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
jQuery.noConflict();
jQuery(document).ready(function()
{

   setInterval(function(){
      get_proizvod();
      
   },500);


   function get_proizvod(){
      jQuery.ajax({
         type:'POST',
         url:'phpskripte/vratiProizvod.php',
         success:function(result){
            jQuery("#tabelaProizvoda").html(result);
         }
      })
   }
  })
</script>
</body>
</html>
