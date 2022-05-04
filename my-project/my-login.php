<?php include('config/constants.php'); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="css/my-login.css">
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
                <input type="submit" name="submit" value="Login" class="btn">
            </form>
            
            <div class="sign-up">
                Do not have an account?
                <a href="<?php echo SITEURL;?>my-signup.php">Sign up</a>
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
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password'])); 
        // $password = mysqli_real_escape_string($conn, $_POST['password']); 

        //2. SQL
        $sql_login = "SELECT * FROM tbl_users WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql_login);

        if(mysqli_num_rows($res))
        {
            $_SESSION['login'] = "<div class='msg success'>Login successful!.</div>";
            // $_SESSION['user'] = $username;

            $row = mysqli_fetch_assoc($res);
            $_SESSION['user_id'] = $row['id'];

            header('location:'.SITEURL); // redirect to home page
        }
        else{
            $_SESSION['login'] = "<div class='msg error'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'my-login.php');
        }
    }   
?>