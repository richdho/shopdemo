<?php
include 'inc/header.php';
if(isset($_GET["category_id"])){
    $cat_id=(int)$_GET["category_id"];
 
    if($cat_id==0){//list all categories
       $query="SELECT * FROM categories where 1";
       
       }
   else{// list a specific category
       $query="SELECT * FROM categories where category_id=".$cat_id;
       
   }
   list_category($query);   
       
   }
   else{
   header("location:index.php");
   exit ();
   }
?>
  
<?php
include 'inc/footer.php';
?>