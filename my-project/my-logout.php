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
<?php
    include('config/constants.php');
    // unset($_SESSION['user']);
    // unset($_SESSION['login']);
    //Destroy the session
    session_destroy();

    // Rediret to home page
    header('location:'.SITEURL);
?>