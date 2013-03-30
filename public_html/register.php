<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Richardho shopdemo</title>





</head>
<body>
<div id="signUp">
       		<form name="signup" id="signup" action="register.php" method="POST">
            <span>Email(require)</span>
            <input name="r_email" type="text" maxlength="60"  />
            <span>First Name(require)</span>
            <input name="fname" type="text" maxlength="60"  />
            <span>Last Name(require)</span>
            <input name="lname" type="text" maxlength="60"  />
            <span>Password(require)</span><br/>
            <span class="tip">(require,and more or eaqual than 5 characters)</span>
            <input name="r_password1" type="password" maxlength="60"  />
            <span>Confirm Password(require)</span>
            <input name="r_password2" type="password" maxlength="60"  />
            
            <input name="login" type="submit" value="Sign up"/>
       		</form>
</div>
</body>
</html>

<?php
include_once '../db_connect/ini.php';    
if(isset ($_POST['r_email'],$_POST['fname'],$_POST['lname'],$_POST['r_password1'],$_POST['r_password2'])){
        @$register_email=$_POST['r_email'];
        @$register_fname=$_POST['fname'];
        @$register_lname=$_POST['lname'];
        @$register_password=$_POST['r_password1'];
        
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
        $_SESSION['user_id'] = $register;
        header('location:index.php');
        exit();
    }

    }
    
?>
