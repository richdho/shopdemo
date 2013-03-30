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

if(isset($_GET["p_id"])&&(int)$_GET["p_id"]>0){
    $p_id=(int)$_GET["p_id"];
    $quantity=(int)$_GET["quantity"];
    $product_data=product_data($p_id,'product_id','product_name','price','image');
    if($product_data["product_id"]){
          if(!isset ($_SESSION["product"][$c_id])){
              $_SESSION["product"][$c_id]=array();
              $_SESSION["quantity"][$c_id]=array();
              $_SESSION["name"][$c_id]=array();
              $_SESSION["image"][$c_id]=array();
              $_SESSION["price"][$c_id]=array();
              $_SESSION["cost"][$c_id]=array();
              }
              $i=0;
              while($i<count($_SESSION["product"][$c_id])&&$_SESSION["product"][$c_id][$i]!=$p_id)$i++;
              if($i<count($_SESSION["product"][$c_id])){
                  $_SESSION["quantity"][$c_id][$i] = $_SESSION["quantity"][$c_id][$i]+$quantity;
                  $_SESSION["name"][$c_id][$i]=$product_data["product_name"];
                  $_SESSION["image"][$c_id][$i]=$product_data["image"];
                  $_SESSION["price"][$c_id][$i]=$product_data["price"];
                  $_SESSION["cost"][$c_id][$i]=$_SESSION["cost"][$c_id][$i]+$product_data["price"]*$quantity;
                  }
              else{
                  $_SESSION["product"][$c_id][]=$p_id;
                  $_SESSION["quantity"][$c_id][] = $quantity;
                  $_SESSION["name"][$c_id][]=$product_data["product_name"];
                  $_SESSION["image"][$c_id][]=$product_data["image"];
                  $_SESSION["price"][$c_id][$i]=$product_data["price"];
                  $_SESSION["cost"][$c_id][]=$product_data["price"]*$quantity;
              }
               $itemNum=0;
              for($i=0;$i<count($_SESSION["product"][$c_id]);$i++){
                  $itemNum=$itemNum+ $_SESSION["quantity"][$c_id][$i];
              }
              echo $itemNum;
    }
    else{
        header('location:index.php');
    }
}

echo "</response>";

?>
