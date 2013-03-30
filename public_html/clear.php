<?php 


session_start();
include_once '../db_connect/ini.php';
include_once 'func/user.func.php';
if(!logged_in()){
    header("location:index.php");
    exit();
}

else{
  $c_id=$_SESSION["customer_id"];
}
    unset($_SESSION["product"][$c_id]); 
    unset($_SESSION["quantity"][$c_id]); 
     unset($_SESSION["name"][$c_id]);
      unset($_SESSION["price"][$c_id]);
       unset($_SESSION["cost"][$c_id]);
        unset($_SESSION["image"][$c_id]);
         header("location:cart.php");
?>