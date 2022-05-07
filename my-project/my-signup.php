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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Fresh Food E-Shopping</title>
    <link rel="stylesheet" href="css/my-login.css">
</head>
<body>

    
    <div class="container">

        <div class="login-wrapper">
            <div class="header">User Signup</div>

            <form action="" method="POST">
                <input type="text" name="nickname" placeholder="nickname" class="input-item">
                <input type="text" name="username" placeholder="username" class="input-item">
                <input type="password" name="password" placeholder="password" class="input-item">
                <input type="password" name="confirm_password" placeholder="confirm password" class="input-item">
                <?php
                if(isset($_SESSION['signup'])){
                    echo $_SESSION['signup'];
                    unset($_SESSION['signup']);
                }
                ?>
                <input type="submit" name="submit" value="Sign Up" class="btn">
            </form>
            
            <div class="sign-up">
                Already have an account?
                <a href="<?php echo SITEURL;?>my-login.php">Log In</a>
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
        $nickname = mysqli_real_escape_string($conn, $_POST['nickname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password'])); 
        $password_c = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));
        // $password = mysqli_real_escape_string($conn, $_POST['password']); 

        if($password!=$password_c){
            $_SESSION['signup'] = "<div class='msg error'>The entered passwords are inconsistent!</div>";
            header('location:'.SITEURL."my-signup.php");
        }
        else{
            $sql_signup = "INSERT INTO `tbl_users` (nickname, username, password) VALUES ($nickname, $username, $password)";
            $sql = "INSERT INTO tbl_users SET 
            nickname='$nickname',
            username='$username',
            password='$password'";
            $res = mysqli_query($conn, $sql);
            if($res)
            {
                $_SESSION['login'] = "<div class='msg success'>Successfully Signed Up!</div>";
                // $_SESSION['user'] = $username;

                // $row = mysqli_fetch_assoc($res);

                header('location:'.SITEURL.'my-login.php'); // redirect to home page
            }
            else{
                $_SESSION['signup'] = "<div class='msg error'>Username already exists!</div>";
                header('location:'.SITEURL.'my-signup.php');
            }
        }


    }   
?>