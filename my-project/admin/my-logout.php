<?php
    //Destroy the session
    session_destroy();

    // Rediret to login page
    header('location:../admin/my-login.php');   // location
?>