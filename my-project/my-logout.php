<?php
    include('config/constants.php');
    // unset($_SESSION['user']);
    // unset($_SESSION['login']);
    //Destroy the session
    session_destroy();

    // Rediret to home page
    header('location:'.SITEURL);
?>