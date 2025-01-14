<?php
include ("Header.php");
include "../database/db_connect.php";
$products=$db->select("*")->from("products")->order("productName")->toList();
echo $blade->run("products.catalog"
    ,['products'=>$products,'postfix'=>'mysql']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
    </head>
    <body>
        Products page
    </body>
</html>