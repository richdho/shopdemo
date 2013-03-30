<?php
include 'inc/header.php';?>
<div id="slideShow">
                <div class="slides_container">
                    <div>
                            <a href="detail.php?p_id=3"><img src="images/samsung-galaxy-note.jpg"></a>
                   </div>
                    <div>
                            <a href="detail.php?p_id=2"><img src="images/galaxyS3.jpg"></a>
                    </div>
                    <div>
                           <a href="detail.php?p_id=1"><img src="images/Samsung-Galaxy-Nexus.jpg"></a>
                    </div>
                </div>
                <ul class="pagination">
                            <li><a href="#1">1</a></li>
                            <li><a href="#2">2</a></li>
                            <li><a href="#3">3</a></li>
                </ul>     
            </div>
             <div class="subbanner"><span>Features<span></div>
                         
            <?php
            $query="SELECT product_id FROM products WHERE 1 ";
            
            grib_view($query);
           
            ?>
            
                         
          
           
            
<?php
include 'inc/footer.php';

/*register*/



?>
