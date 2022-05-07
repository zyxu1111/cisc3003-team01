<!-- 
--------------------------------------------
CISC3003 Team Project - Team 01

Topic: Fresh Food E-shopping Platform

Team Member: 
CC029691    Yufei Jiang
DB927262    WU MAN CHON
DC128500    Nathan, XU ZHENG YU
DC128111    Leandro Manuel Chan Siqueira
-------------------------------------------- 
-->
<?php 

    include('../config/constants.php'); 
    include('my-login-check.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Yufei Jiang,WU MAN CHON,Nathan,XU ZHENG YU">
        <meta name="keywords" content="HTML, CSS, PHP">
        <meta name="description" content="CC029691(Yufei Jiang),DB927262(WU MAN CHON),DC128500(Nathan,XU ZHENG YU),DC128111(Leandro Manuel Chan Siqueira)">
        <title>E-Shopping Admin Page - CISC3003 Team01</title>

        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-users.php">Users</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-vegetable.php">Item</a></li>
                    <li><a href="my-manage-order.php">Order</a></li>
                    <li><a href="my-logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->