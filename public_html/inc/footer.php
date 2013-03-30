</div>
</div>

<!--right sidebar-->   
    <div id="rightSidebar">
    	<div id="shoppingCart">
            <a href="cart.php"><img src="images/shopping_cart.png"></a>
            <span id="itemNum"><?php
            if(isset($_SESSION["product"])){
                $c_id=$_SESSION["customer_id"];
                if(isset($_SESSION["product"][$c_id])){
                $itemNum=0;
                 for($i=0;$i<count($_SESSION["product"][$c_id]);$i++){
                  $itemNum=$itemNum+ $_SESSION["quantity"][$c_id][$i];
                }
                echo $itemNum;    
                }
                else{
                  echo "0"; 
                }
                          
            }
            else{
                echo "0";
            }
            ?></span>
        </div>
        <div id="guaranteed">
        </div>
        <div id="payments">
        </div>
   </div>
    <!--Footer-->
    <div id="footer">
    Copyright&copy;Richard Ho & Yuxiang HE<br/>
    Tel:0435378391<br/>
    <a href="mailto:heyuxiang85@gmail.com"><img src="images/gmail.png"></a><br/>
    <a href="#">Privacy Police</a> | <a href="#">About US</a> | <a href="#">Customer Service</a> | <a href="#">Terms&condition </a>   
    </div>
</div><!-- end of container-->
</body>
</html>