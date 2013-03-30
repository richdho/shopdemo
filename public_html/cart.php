<?php

include 'inc/header.php';
if(!logged_in()){
    echo "<h2>To use this demo, please click the login button on the top or sign up for your own account</h2>";
    include 'inc/footer.php';
    exit();
}

else{
  $c_id=$_SESSION["customer_id"];
}

?>

<table>
                <thead>
                    <tr>
                    <th colspan="2">Item</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Cost</th>
                    </tr>        
                </thead>
             
   
                <tbody>
                    <?php 
                    if(isset($_SESSION["product"][$c_id])){
                        for($i=0;$i<count($_SESSION["product"][$c_id]);$i++){
                           if($_SESSION["product"][$c_id][$i]!=0){
                            echo '
                            <tr>
                            <td><img src="'.$_SESSION["image"][$c_id][$i].''.$_SESSION["product"][$c_id][$i].'-1.jpg" height="100" width="150"></td>

                            <td>'.$_SESSION["name"][$c_id][$i].'</td>
                            <td>$'.$_SESSION["price"][$c_id][$i].'</td>
                            <td><input onkeyup="cart('.$_SESSION["product"][$c_id][$i].')" type=text id="product'.$_SESSION["product"][$c_id][$i].'" name="quantity"  size= "1" maxlength="2" value="'.$_SESSION["quantity"][$c_id][$i].'"></td>
                            <td><div id="cost'.$_SESSION["product"][$c_id][$i].'">$'.$_SESSION["cost"][$c_id][$i].'<br /><a href="delete.php?p_id='.$_SESSION["product"][$c_id][$i].'"><span style="font-size:13px;margin-top:15px;">Delete</a></div></td>
                         </tr>'; 
                          }
                        }
                    }
                    else{
                        echo '<span style="font-weight:bold;color:blue;font-size:20px;margin:10px 177px;" >Your shopping cart is empty.</span>';
                    }
                    ?>
                   
                     
                </tbody>
                <tfoot>
                <tr>
                   <th colspan="5"> <div id="total">Total: $<?php 
                   if(isset ($_SESSION["cost"][$c_id])){
                     $total=0;
                   for($j=0;$j<count($_SESSION["cost"][$c_id]);$j++){
                      
                       $total=$total+$_SESSION["cost"][$c_id][$j];
                   }
                   $_SESSION["total"][$c_id]=$total;
                   echo $total; 
                   
                   }
                   else{
                       echo "0";
                   }
                   ?></div></th>
                </tr>
                </tfoot>
                
            </table>
            <div id="cartbotton"><a href="clear.php"><input name="clear" type="submit" value="clear"/></a>
         <a href="index.php"><input name="back" type="submit" value="Continue shopping"/></a>
         <a href="address.php"><input name="order" type="submit" value="Place Order" style="background: #ff3333;color:black;"/></a>
            </div>

   <!---->
<?php
include 'inc/footer.php';
?>