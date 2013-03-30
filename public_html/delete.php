<?php
session_start();
include_once 'func/user.func.php';
if(!logged_in()){
    echo "<h2>To use this demo, please use the following infomation to login first.<br />Email: sfree2005@163.com password:123456</h2>";
    include 'inc/footer.php';
    exit();
}

else{
  $c_id=$_SESSION["customer_id"];
}

if(isset($_GET["p_id"])&&(int)$_GET["p_id"]>0){
      $i=0;
      while($i<count($_SESSION["product"][$c_id])&&$_SESSION["product"][$c_id][$i]!=(int)$_GET["p_id"])
          $i++;
      if($i<count($_SESSION["product"][$c_id])){
          $_SESSION["product"][$c_id][$i]=0;
          $_SESSION["cost"][$c_id][$i]=0;
          $_SESSION["quantity"][$c_id][$i]=0;
      }
    
      
      header("location:cart.php");
      
}

?>
