<?php
include_once '../db_connect/ini.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Richardho shopdemo</title>

<link rel="stylesheet" href="styles/style.css" type="text/css"/>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="scripts/slides.min.jquery.js" type="text/javascript"></script>
<script src="scripts/shopdemo.js" type="text/javascript"></script>
<script src="scripts/add2cart.js" type="text/javascript"></script>
<script src="scripts/jquery.validate.min.js" type="text/javascript"> </script>



</head>
<body>
<div id="container">

<!--topBar Used for logging in and signup-->
<?php 


include_once 'func/user.func.php';

if(logged_in()){
    
   
?><div id = "topBar"><span style="margin: 5px;">Welcome,<?php  $user_data = user_data('customer_id','f_name','l_name');
                                               $_SESSION["customerName"]=$user_data['f_name']." ".$user_data['l_name'];
                                                echo $user_data['f_name'];?>&nbsp;&nbsp;
    <a href="logout.php">Log out</a></span></div>

<?php }
else{ echo '
<div id="topBar">
		<div id="login">
            
            <form name="login" action="index.php" id="loginform" method="POST" >
            <span>Email</span>
            <input name="email" type="text" maxlength="60" value="sfree2005@163.com" />
            <span>Password</span>
            <input name="password" type="password" maxlength="60" value="123456" />
            <input name="rmb" type="checkbox" /><span>Remember me</span>
            <input name="login" type="submit" value="login"/>or <span id="clickme"><a href="#">Sign up</a></span>	
            
            </form>
       </div>
       <div id="signUp">
       		<form name="signup" id="signup" action="index.php" method="POST">
            <span>Email(require)</span>
            <input name="r_email" type="text" maxlength="60"  /><br/>
            <span>First Name(require)</span>
            <input name="fname" type="text" maxlength="60"  /><br/>
            <span>Last Name(require)</span>
            <input name="lname" type="text" maxlength="60"  /><br/>
       
            <span>Password(require)</span><br/>
            <span class="tip">(require,and more or eaqual than 5 characters)</span>
            <input name="r_password1" type="password" maxlength="60"  /><br/>
            <span>Confirm Password(require)</span>
            <input name="r_password2" type="password" maxlength="60"  /><br/>
            
            <input name="login" type="submit" value="Sign up"/>
       		</form>
       </div>
    
</div>';}
/*register.php*/

    if(isset ($_POST['r_email'],$_POST['fname'],$_POST['lname'],$_POST['r_password1'],$_POST['r_password2'])){
        @$register_email=mysql_real_escape_string($_POST['r_email']);
        @$register_fname=mysql_real_escape_string($_POST['fname']);
        @$register_lname=mysql_real_escape_string($_POST['lname']);
        @$register_password=mysql_real_escape_string($_POST['r_password1']);
        
    $errors=array();   
    if(empty ($register_email)||empty ($register_fname)||empty ($register_lname)||empty($register_password)){
        $errors[]="All fields are required ";
    }
    else{
       if(filter_var($register_email,FILTER_VALIDATE_EMAIL) === FALSE){
           $errors[]="Please input validate email.";
       }
       if(strlen($register_email) > 100 ||  strlen($register_fname) >  20 || strlen($register_password) > 35 ){
           $errors[]="One or more fields too many characters";
       }
       if(user_exist($register_email)){
           $errors[]= "Email has been registered";
       }
       if(strcmp($_POST['r_password1'],$_POST['r_password2'])){
            $errors[]= "Make sure you type the same password twice";
       }
    }
    if(!empty ($errors)){
        foreach ($errors as $error){
            echo 'Sorry, '.$error.'<br />';
        }
    }
    else{
        $register = user_register($register_email, $register_fname, $register_lname,$register_password);
        $_SESSION['customer_id'] = $register;
        header('location:index.php');
        exit();
    }

    }

 /*login.php*/
    
    if(isset ($_POST['email'],$_POST['password'])){
        @$login_email=$_POST['email'];
        @$login_password=$_POST['password'];
   
        
    $errors = array();
    
    if(empty ($login_email)||empty($login_password)){
        $errors[]= 'Email and Password are required.';
    }
    else{
        $login = loggin_check($login_email,$login_password);
        if($login == FALSE){
            $errors[] = 'Email or Password is not correct.';
        }
        if(!empty($errors)){
            foreach ($errors as $error) {
                echo $error.'<br />';
            }
        }
        else{
            //configure the login cookie.
            if($_POST["rmb"]){
               $week=time()+60*60*24*14;
               setcookie("remember_me",$login_email,$week);
            }
            elseif(!$_POST["rmb"]) {
                if(isset($_COOKIE['remember_me'])) {
                        $past = time() - 100;
                        setcookie("remember_me", "", $past);
                }
           }
            
            $_SESSION['customer_id']= $login;
            header("location:index.php");
            exit();
        }
   }
    }
   ?>
<div id="banner">
</div>
<div id="nav">
    <ul>
    	<li><a href="index.php">Home</a></li>
        <li><a href="categories.php?category_id=0">Categories</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
    
    	
    </ul>
    
</div>
    <!--Inner-->
    <div id="inner">
        <!--Left side bar-->
        <div id="leftSidebar">
            <div id="searchBar">
                <form action="search.php" name="searchForm" id="searchForm" method="POST">
                <label>Search for products</label>
                <input type="text" name="keyWord" size="18" maxlength="40" />
                <input type="submit" name="search" value="Search" style="margin-left:90px; margin-top:3px;" />
                </form> 
            </div>
            <div id="leftNav">
                <span style="padding:10px;">Products</span>
                <ul>
                    <li><a href="categories.php?category_id=1">Phones</a></li>
                    <li><a href="categories.php?category_id=2">Tablets</a></li>
                    <li><a href="categories.php?category_id=3">Cameras</a></li>
                    <li><a href="categories.php?category_id=4">TV</a></li>
                                    
                </ul>
            </div>   
        </div>
        <!-- Main Content-->
        <div id="main">
      
            
            
           
   
    
    
    

  
