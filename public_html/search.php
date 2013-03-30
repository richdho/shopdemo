<?php
include 'inc/header.php';

?> 
 <div class="subbanner"><span>Search Results<span></div>
<?php
           if(isset($_POST["search"])&&isset($_POST["keyWord"])){
               $key=mysql_escape_string($_POST["keyWord"]);
           
            $query="SELECT product_id FROM products WHERE product_name LIKE '%".$key."%'";
            
            grib_view($query);
               
           } 

      
?>


<?php
include 'inc/footer.php';
?>