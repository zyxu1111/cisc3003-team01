<?php
    session_start();
    // define('SITEURL', 'http://localhost/cisc3003/cisc3003-team01/food-order-website-php-example/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food_order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //SElecting Database
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

    
    <div class="container">

        <div class="login-wrapper">
            <div class="header">Login</div>

            <form action="" method="POST">
                <input type="text" name="username" placeholder="username" class="input-item">
                <input type="password" name="password" placeholder="password" class="input-item">
                <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
                <input type="submit" name="submit" value="login" class="btn">
            </form>
            
            <div class="sign-up">
                Don't have account?
                <a href="#">Sign up</a>
            </div>
            
            <div class="login-footer">Created By - CISC3003 Team 01</div>
        </div>
        
    </div>
</body>
</html>


<?php
    // Check
    if(isset($_POST['submit']))
    {

        // Process for Login
        //1. Get the Data from Login form
        $username = $_POST['username'];
        $password = md5($_POST['password']); 

        echo "<script>console.log('$username'+'$password');</script>"; // delete

        //2. SQL
        $sql_login = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql_login);

        if(mysqli_num_rows($res))
        {
            $_SESSION['login'] = "<div class='msg success'>Login successful!.</div>";
            $_SESSION['user'] = $username;
            header('location:../admin/my-login.php'); // location
        }
        else{
            $_SESSION['login'] = "<div class='msg error'>Username or Password did not match.</div>";
            header('location:../admin/my-login.php');   // location 
        }
    }   
?>