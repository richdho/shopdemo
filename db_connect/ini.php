<?php
include_once '../db_connect/config.php';
//$CONFIG['HOST']='rerun.it.uts.edu.au';
//$CONFIG['USER']='potiro';
//$CONFIG['PWD']='pcXZb(kL';
//$CONFIG['DB_NAME']='poti';
// $CONFIG['HOST']='localhost';
// $CONFIG['USER']='root';
// $CONFIG['PWD']='';
// $CONFIG['DB_NAME']='poti';

ob_start();
session_start();
$dbc = mysql_connect($CONFIG['HOST'],$CONFIG['USER'],$CONFIG['PWD'])
        or die('Uable to connect db.');

mysql_select_db($CONFIG['DB_NAME']);
mysql_set_charset('utf8');

include 'func/user.func.php';
include 'func/product.func.php';


?>
