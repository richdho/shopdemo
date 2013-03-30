<?php

/*include '../db_connect/config.php';
include 'func/user.func.php';*/
include 'inc/header.php';

if(!logged_in()){
    header("location:index.php");
    exit();
}

else{
  $c_id=$_SESSION["customer_id"];
}
/*form validation*/
 if(isset ($_POST['order'],$_POST['street'],$_POST['suburb'],$_POST['state'],$_POST['code'])){
        @$street=mysql_real_escape_string($_POST['street']);
        @$suburb=mysql_real_escape_string($_POST['suburb']);
        @$state=mysql_real_escape_string($_POST['state']);
        @$code=mysql_real_escape_string($_POST['code']);
        
    $errors=array();   
    if(empty ($street)||empty ($state)||empty ($suburb)||empty($code)){
        $errors[]="All fields are required ";
    }
    
    if(!empty ($errors)){
        foreach ($errors as $error){
            echo 'Sorry, '.$error.'<br />';
        }
    }
    else{
        $dbci= new mysqli($CONFIG['HOST'],$CONFIG['USER'],$CONFIG['PWD'],$CONFIG['DB_NAME']) or die('Uable to connect db.');
        mysqli_set_charset($dbci,'utf8');
        $dbci->autocommit(false);

        $errors =array();

        $result=$dbci->query("INSERT INTO addresses VALUE('','".$c_id."','".$street."','".$suburb."','".$state."','".$code."') ");
        if(!$result)
            $errors[]='cannot insert address';
        $id=$dbci->insert_id;

        $result=$dbci->query("INSERT INTO orders VALUE('','".$c_id."','".$_SESSION["total"][$c_id]."',NOW(),'".$id."') ");
        if(!$result)
            $errors[]='cannot insert order';
        $id=$dbci->insert_id;

        for($i=0;$i<count($_SESSION["product"][$c_id]);$i++){
        $result=$dbci->query("INSERT INTO order_content VALUE ('','".$id."','".$c_id."','".$_SESSION['product'][$c_id][$i]."','".$_SESSION['name'][$c_id][$i]."','".$_SESSION['price'][$c_id][$i]."','".$_SESSION['quantity'][$c_id][$i]."','') ");
        if(!$result)
            $errors[]='cannot insert order_content';
        }
        if(!empty ($errors)){
                $dbci->rollback();
                foreach ($errors as $error){
                    echo 'Sorry, '.$error.'<br />';
                }

            }
            else{
                $dbci->commit();
                $dbci->autocommit(true);
                date_default_timezone_set('Australia/Melbourne');
                $date=date('m/d/Y h:i a',time());
                echo "<div style='margin-left:25px;'>
                    <h2>Thank You, and this is your order information</h2>
                    
                    <p>Order ID:".$id."<br />
                    Order Time:".$date."<br />
                    Name:".$_SESSION["customerName"]."    
                    </p>
                                      
                    
                    <p>Order Address:<br />
                       ".$street."<br />
                       ".$suburb." 
                           ".$state."   ".$code."<br />
                              
                            </p>
                    <p style='font-weight: bold;'>Order Items</p>
                        </div>";
                    ?> 
                <div id="ordertable">
                <table >
                <thead>
                    <tr>
                    <th>Item</th>
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
                            

                            <td>'.$_SESSION["name"][$c_id][$i].'</td>
                            <td>'.$_SESSION["price"][$c_id][$i].'</td>
                            <td>'.$_SESSION["quantity"][$c_id][$i].'</td>
                            <td>$'.$_SESSION["cost"][$c_id][$i].'</td>
                         </tr>
                              '; 
                            
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
                   <th colspan="4"> <div id="total">Total: $<?php 
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
                    </div>
      <p style="color:red;font-size:15px;font-weight:bold;">For security and cost reasons, I do not integrate any payment function in this demo. This is the end of the demo, please log out, thank you for your time!</p>
                    <?php
                    /* unset($_SESSION["product"][$c_id]); 
                     unset($_SESSION["quantity"][$c_id]); 
                     unset($_SESSION["name"][$c_id]);
                     unset($_SESSION["price"][$c_id]);
                     unset($_SESSION["cost"][$c_id]);
                     unset($_SESSION["image"][$c_id]);
                     unset($_SESSION["total"][$c_id]);*/
                
            }

    }

    }



?>


<?php
include 'inc/footer.php';
?>
