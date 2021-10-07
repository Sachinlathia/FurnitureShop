<?php include_once "templates/header.php";?>
<!---PhpLOGINKOD--->
<?php 
  $mysqli = new mysqli('localhost','root','','grujovic');
  if($mysqli->error){
      die("Greska". $mysqli->error);
  }

  if(isset($_POST['loginBtn']))
  {
    $userEmail = $_POST['loginEmail'];
    $userPassword = $_POST['loginPassword'];

    $userVerification = $mysqli->query("SELECT * FROM users WHERE email='$userEmail' AND password = '$userPassword'");

    if(mysqli_num_rows($userVerification)>0)
    {
      $updateErrorCount = $mysqli->query("UPDATE users SET error_count = 0 WHERE email='$userEmail'");
      $userData = $userVerification->fetch_assoc();
      if($userData['role']=='user')
      {
        session_start();
        $_SESSION['users']=$userData['name'];
        setcookie("welcomeMessage",$_SESSION['users'],time()+(10));
        header('location:FurnitureStore/index.php');
      }
      else if($userData['role']=='admin')
      {
        session_start();
        $_SESSION['users']=$userData['name'];
        header('location:AdminPage/index.php');
      }

    }

    else
    {
      // -------------giving user three times to login before account is deleted
      $dataEmail = $mysqli->query("SELECT * FROM users WHERE email= '$userEmail'");

      //--------------checking if entered email exist in database
      if(mysqli_num_rows($dataEmail)>0)
      {
        $updateError = $mysqli->query("UPDATE users SET error_count = error_count+1 WHERE email='$userEmail'");
        $getUpdatedData = $mysqli->query("SELECT * FROM users WHERE email='$userEmail'");
        $result = $getUpdatedData->fetch_assoc();

        if($result['error_count']==1)
        {
          $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Warning</strong> You have 2 attempts left.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        else if($result['error_count']==2)
        {
          $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Warning</strong> You have 1 attempt left.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        else if($result['error_count']==3)
        {
          $deleteUser = $mysqli->query("DELETE FROM users WHERE email='$userEmail'");
          $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Warning</strong> Sorry your account has been deleted due to incorecct login details.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
      }
      else
      {
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Incorect login details.</strong> Pleas check details again.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }

    }

  }


  ?>

<div class="container text-center " >
    <div class="row">
        <div class="col-sm-5">

        </div>
        <div class="col-sm-2 ch_pozicija">
          <div class="ch_blur_content">
            <i class="fas fa-couch fa-3x mb-3"></i>
            <h3 class="mb-3 ch-bold">Login</h3>
            <form method="post">
                <div class="mb-3 ">
                    
                    <input type="email" class="form-control" name="loginEmail" id="loginEmail" aria-describedby="emailHelp" placeholder="Enter Email">
                    <span id="loginEmailError"></span>
                    <div id="emailHelp" class="form-text"><i class="fas fa-lock"></i>We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    
                    <input type="password" name="loginPassword" id="loginPassword" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
                    <span id="loginPasswordError"></span>
                </div>
                
                <button type="submit" id="loginBtn" name="loginBtn" class="btn purpl ">Log in</button>
            </form>
            <span class="float-left"><a  href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#register">Register</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="float-right"><a  href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#forget">Forget password</a></span>
            <?php echo @$msg; ?>
        </div>
        </div>
        <div class="col-sm-5">

        </div>
    </div>
</div>
<!--Register model-->
<div class="modal fade " id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register</h5>
        <button type="button" id="closeReg" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
        <form id="registerForm">
            
                <div class="form-group">

                    <lable>Username:</lable>
                    <input type="text" class="form-control" name="UnosUsername" id="UnosUsername" aria-describedby="emailHelp" placeholder="Enter Username">
                    <span id="username_error" class="ch_error"></span>
                </div>
                <div class="form-group">
                    <lable>Email:</lable>
                    <input type="email" class="form-control" name="UnosEmail1" id="UnosEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
                    <span id="email_error" class="ch_error"></span>
                </div>
                <div class="form-group">
                    <lable>Password:</lable>
                    <input type="password" class="form-control" name="UnosPW1" id="UnosPW1" placeholder="Enter Password">
                    <span id="pw_error" class="ch_error"></span>
                </div>
                <div class="form-group">
                    <lable>Reenter password:</lable>
                    <input type="password" class="form-control" name="UnosPW2" id="UnosPW2" placeholder="Reenter Password">
                    <span id="pw2_error" class="ch_error"></span>
                </div>
                
                
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <p class="text-center" id="msg"></p>
        <button type="button" class="btn purpl" name="regBtn" id="RegisterBtn">Register</button>
      </div>
    </div>
  </div>
</div>

<!--Zaboravljena sifra--->
<div class="modal fade " id="forget" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Password recovery</h5>
        <button type="button" id="passClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
        <form id="forwardPw">
            
                
                <div class="form-group">
                    
                    <input type="email" class="form-control" id="email_verify" name="email_verify" aria-describedby="emailHelp" placeholder="Enter Email">
                    <span id="email_error1" class="ch_error"></span>
                </div>
                <div class="form-group" id="passFiled">
                    
                    <input type="password" class="form-control" id="noviPass" name="noviPass"  placeholder="New password">
                    <span id="forgotpassErorr" class="ch_error"></span>
                </div>
                
                
            </form>
        </div>
      </div>
      <div class="modal-footer">
      <p class="text-center" id="msg1"></p>
      <button type="button" class="btn purpl" id="verifyBtn">Verify Email</button>
      <button type="button" class="btn purpl" id="btnChangePass">Change Password</button>
      </div>
    </div>
  </div>
</div>




<?php include_once "templates/footer.php";?>