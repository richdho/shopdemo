<?php
include 'inc/header.php';?>

<div id="slideShowDetail">
                <div class="slides_container">
                    <?php
                    if(isset($_GET["p_id"])){
                        $p_id=(int)$_GET["p_id"];
                         for($i=1;$i<=3;$i++){
                         
                        echo '<div>
                            <img src="products/images/'.$p_id.'/'.$p_id.'-'.$i.'.jpg">
                        </div>';                                    
                        }
                    }
                    else{
                        header("location:index.php");
                        exit ();
                    }
                     
                   
                    ?>
                                       
                </div>
                <ul class="pagination">
                    <?php
                    for($i=1;$i<=3;$i++){
                        echo '<li><a href="#"><img src="products/images/'.$p_id.'/'.$p_id.'-'.$i.'.jpg" width="60" alt="1144953 3 2x"></a></li>';
                    }
                    ?>                                                       
                </ul>     
      </div>
  <div id="detail">
      <?php
          $product_data=product_data($p_id,'product_name','price');
      ?>
      	
        <div class="detailTitle">
        	<?php echo $product_data["product_name"]?>
        </div>
        <div class="detailPrice">
        	$<?php echo $product_data["price"]?>
        </div>
        <div class="detailQuantity">
        	
            <div class="detailID">
             <input type="text" name="p_id" value="<?php echo $p_id;?>"/>
            </div>
            <label>Quantity:</label>
            <input id="itemqty" type="text" size="2" value="1"/>
            <p>
                
            <?php
            if(isset($_SESSION['customer_id'])){
             echo ' 
           <input type="submit" onclick="add2cart('.$p_id.')" name="addToCart" value="Add to Cart" />
            <a href="cart.php" onmousedown="add2cart('.$p_id.')"><input type="submit"  name="buy" value="Buy" /></a>';
            }
            else{
           echo ' 
           <input type="submit" onclick="requireLogin()" name="addToCart" value="Add to Cart" />
            <a href="cart.php" onmousedown="requireLogin()"><input type="submit"  name="buy" value="Buy" /></a>';
            }
              ?>
            <p>
       </div>
      
      </div>
      <div class="description">
       <?php include 'products/descriptions/'.$p_id.'.html';?>
<h2>Features</h2> 
<img src='products/images/<?php echo $p_id;?>/<?php echo $p_id;?>-4.png'>
   </div>

 <!--detail ends-->

<?php
include 'inc/footer.php';
?>
