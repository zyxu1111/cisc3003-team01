<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>find.php">Find</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>my-shopping-cart.php">Shopping Cart</a>
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