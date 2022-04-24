<?php
    // unset($_SESSION['user']);
    // unset($_SESSION['login']);
    //Destroy the session
    session_destroy();

    // Rediret to login page
    header('location:../admin/my-login.php');   // location
?>