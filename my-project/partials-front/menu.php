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
<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Yufei Jiang,WU MAN CHON,Nathan,XU ZHENG YU">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="description" content="CC029691(Yufei Jiang),DB927262(WU MAN CHON),DC128500(Nathan,XU ZHENG YU),DC128111(Leandro Manuel Chan Siqueira)">
    <title>E-Shopping Website - CISC3003 Team01</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>find.php">Find</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>shopping-cart.php">Shopping Cart</a>
                    </li>
                    <li>
                        <!-- <a href=" -->
                        <?php
                            if( isset($_SESSION['user_id'] )){
                                $user_id = $_SESSION['user_id'];
                                $sql = "SELECT username, nickname
                                FROM `tbl_users` WHERE id=$user_id";
                                //Execute Query
                                $res = mysqli_query($conn, $sql);
                                //Count Rows
                                $row=mysqli_fetch_assoc($res);
                                $username = $row['username'];
                                $nickname = $row['nickname'];
                                echo "<a href='".SITEURL."my-logout.php'>Hello, $nickname! (Log Out)</a>";
                            }
                            else{
                                echo "<a href='".SITEURL."my-login.php'>Log In</a>";
                            } 
                        ?>
                        <!-- "></a> -->
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->