<?php
// Check whether the user is logged in or not
if(!isset($_SESSION['user_id'])){
    $_SESSION['no-login-message'] = "<div class='error'>Please login to access Admin Panel.</div>";
    header('location:'.SITEURL.'/my-login.php');
}
?>