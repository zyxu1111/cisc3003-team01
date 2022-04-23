<?php
// Check whether the user is logged in or not
if(!isset($_SESSION['user'])){
    header("location:my-login.php")
}
?>