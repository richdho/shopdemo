<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Shopping mall</title>
</head>
    <body>
            <p><?php
            include_once '../db_connect/ini.php';
            $q= 'SELECT * FROM products';
            $results=$mysqli_query($q);
            while ($row = $results_fetch_object()) {
                echo $row_product_name;
            }
            ?>
            </p>
    </body>
</html>
