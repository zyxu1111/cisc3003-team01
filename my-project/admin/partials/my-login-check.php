<?php
// Check whether the user is logged in or not
if(!isset($_SESSION['user'])){
    $_SESSION['no-login-message'] = "<div class='error'>Please login to access Admin Panel.</div>";
    header('location:'.SITEURL.'admin/my-login.php');
}
?>