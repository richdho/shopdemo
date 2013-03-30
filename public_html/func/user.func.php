<?php
function logged_in(){
    if(isset ($_COOKIE["remember_me"])){
    $query="SELECT customer_id FROM customers WHERE email='".$_COOKIE["remember_me"]."'";
    $result=mysql_query($query);
    $row=mysql_fetch_assoc($result);
    $_SESSION['customer_id']=$row["customer_id"];
    return true;   
    }
    else{
      return isset($_SESSION['customer_id']);  
    }
    
}

function loggin_check($email,$password){
    $email = mysql_real_escape_string($email);
    $query = mysql_query("SELECT COUNT(`customer_id`) as `count`, `customer_id` FROM `customers` WHERE `email`='$email' AND `pass`='".md5($password)."'");
    return (mysql_result($query, 0) == 1) ? mysql_result($query, 0,'customer_id'):false;
}

function user_data(){
    $args = func_get_args();
    $fields = '`'.implode('`,`', $args).'`';
    $query = mysql_query("SELECT $fields FROM `customers` WHERE `customer_id`= ".$_SESSION['customer_id']);
    $query_result = mysql_fetch_assoc($query);
    foreach( $args as $field){
        $args[$field]=$query_result[$field];
    }
    return $args;
    
}

function user_register($email,$fname,$lname,$password){
    $email=mysql_real_escape_string($email);
    $fname=mysql_real_escape_string($fname);
     $lname=mysql_real_escape_string($lname);
    mysql_query("INSERT INTO `customers` VALUES ('','$fname','$lname','$email','".md5($password)."') ");
    return mysql_insert_id();   
}

function user_exist($email){
    $email = mysql_real_escape_string($email);
    $query = mysql_query("SELECT COUNT(`customer_id`) FROM `customers` WHERE `email`= '$email' ");
    return (mysql_result($query, 0) == 1) ? true:false;
}

?>
