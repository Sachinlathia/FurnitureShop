<?php 
session_start();
if($_POST['action']='reset'){
    foreach($_SESSION['cart'] as $key => $value){
    unset($_SESSION['cart'][$key]);
}

}



?>