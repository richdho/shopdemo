<?php

error_reporting(0);
header('Content-Type:text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

echo "<response>";
   include '../db_connect/ini.php';
    if(!logged_in()){
    header("location:index.php");
    exit();
}
else{
  $c_id=$_SESSION["customer_id"];
}
if(isset($_GET["p_id"])&&(int)$_GET["p_id"]>0&&isset($_GET["quantity"])&&(int)$_GET["quantity"]>0){
    $p_id=(int)$_GET["p_id"];
    $quantity=(int)$_GET["quantity"];
     if(!isset ($_SESSION["product"][$c_id])){
         header("location:index.php");
         exit();
         }
     else{
         $i=0;
         while($p_id!=$_SESSION["product"][$c_id][$i]) 
         $i++;
         if($i<count($_SESSION["product"][$c_id]))
         $_SESSION["quantity"][$c_id][$i]=$quantity;
         $_SESSION["cost"][$c_id][$i]=$_SESSION["price"][$c_id][$i]*$quantity;
         echo '<cost>'.$_SESSION["cost"][$c_id][$i].'</cost>';
         if(isset ($_SESSION["cost"][$c_id])){
                     $total=0;
                     $itemNum=0;
                   for($j=0;$j<count($_SESSION["cost"][$c_id]);$j++){
                      $itemNum=$itemNum+$_SESSION["quantity"][$c_id][$j];
                       $total=$total+$_SESSION["cost"][$c_id][$j];
                   }
                   echo '<total>'.$total.'</total>'; 
                   echo'<item>'.$itemNum.'</item>';
                   }
                   else{
                       echo "<total>0</total>";
                   }
         
     }
    
}
echo "</response>";
?>
