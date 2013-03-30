<?php
session_start();
session_destroy();
if(isset($_COOKIE['remember_me'])) {
                        $past = time() - 100;
                        setcookie("remember_me","", $past);
}
header('location:index.php');
exit();
?>
