<?php
include 'inc/header.php';

if(!logged_in()){
   echo "<h2>To use this demo, please use the following infomation to login first.<br />Email: sfree2005@163.com password:123456</h2>";
    include 'inc/footer.php';
    exit();
}

else{
  $c_id=$_SESSION["customer_id"];
}
?>

<div id="address">
       <h2>Your address</h2>
   		<form name="address" id="addressform"action="order.php" method="post" >
        <label>Street</label>
        <input name="street" type="text" maxlength="60" size="50" /> 
        <label>Suburb</label>
        <input name="suburb" type="text" maxlength="30" size="50" /> 
        <label>State</label>
        <input name="state" type="text" maxlength="30"  size="50"/> 
        <label>Post Code</label>
        <input name="code" type="text" maxlength="4" size="4"/>       
        <p><input name="order" type="submit" value="submit"/>
         <input name="back" type="submit" value="Back to shoping cart"/></p>
        </form>
   </div>

<?php
include 'inc/footer.php';
?>
