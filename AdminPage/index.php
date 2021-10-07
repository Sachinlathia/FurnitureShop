<?php
include_once 'templates/header.php'; 

session_start();
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
          <a class="nav-link" >Admin:</a>
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

<!----------------Proizvodjac addBox----------------------->
<div class="container mt-5 mb-5 purpl ch_proizvodjaci">
<h3 class="ch_absoulte">Makers</h3>

</div>
<div class="container">
    <div class="row">
        <div class="col-sm-4" id="addProizvodjac">
            <h4>Add Maker</h4>
            <hr>
            <form id="FrmUbaci">
                <div class="form-group">
                <label>Enter new Maker</label>
                <input type="text" name="tbProizvodjac" id="tbProizvodjac" class="form-control" placeholder="Input Makers name">
                <span id="inputError"></span>
                </div>
            </form>
            <button type="button" class="btn purpl"  id="btnDodaj">Add</button>
            
        </div>
        <div class="col-sm-4" id="updateProizvodjac">
            <h4 id="idIzmeni">Edit Maker</h4>
           
        </div>
        <div class="col-sm-8">
            <table class="table text-center">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="tabela">
                
                </tbody>
             </table>
</div>

    </div>
</div>
<?php
include_once 'templates/footer.php'; 
?>