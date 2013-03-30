<?php
function product_data($product_id){
    $product_id = (int)$product_id;
    $args = func_get_args();
    unset ($args[0]);
    $feilds = '`'.implode('`,`', $args).'`';
    $query = mysql_query("SELECT $feilds FROM `products` WHERE `product_id`=".$product_id);
    $query_result = mysql_fetch_assoc($query);
    foreach( $args as $fields){
        $args[$fields] = $query_result[$fields];  
    }
    return $args;
}



function grib_view($query){
            $result=mysql_query($query);
            
            while($row=  mysql_fetch_assoc($result)){
                $product_data=product_data($row['product_id'],'product_id','product_name','price','image');
            ?>  
           <!-- product preview grib-->         
                <div class="productView">
                    <div class="preview"><a href="detail.php?p_id=<?php echo $product_data["product_id"]?>"><img src="<?php echo $product_data['image'].$product_data['product_id']?>-1.jpg" width="134" alt="dasd"></a></div>
                <div class="title"><a href="detail.php?p_id=<?php echo $product_data["product_id"]?>"><?php echo $product_data['product_name']?></a></div>
                <div class="previewPrice">$<?php echo $product_data['price']?></div>
      
                <!--<ul>
                    <li><a>Add to Cart</a></li>
                    <li><a>Detail</a></li>
                </ul>-->
                <div class="previewButton">
                 <?php if(isset ($_SESSION['customer_id']))
                  echo '<input type="submit" onclick="add2cart('.$product_data["product_id"].')" name="addToCart" value="Add to Cart" />';
                 else
                     echo '<input type="submit" onclick="requireLogin()" name="addToCart" value="Add to Cart" />'; 
                     ?>
                
                <a href="detail.php?p_id=<?php echo $product_data["product_id"]?>"><input type="submit" name="detail" value="Detail" /></a>
                </div>
                </div>
            <!-- product preview grib ends-->  
                
                <?php
                
            }
    }
    
function list_category($query){
      $result=mysql_query($query);
      
      while( $query_result = mysql_fetch_assoc($result)){
           //$category_data= category_data($query_result["category_id"],'category_id','category_name');
          
     ?>
            <div class="subbanner"><span><?php echo $query_result["category_name"]?><span></div>
            <?php
            $query="SELECT product_id FROM products WHERE category_id=".$query_result["category_id"]." limit 3";
            
            grib_view($query);
            
     }
}
?>       
                        
