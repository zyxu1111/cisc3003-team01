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
<?php include('partials-front/my-login-check.php'); ?>

<?php
if( isset($_GET['cart_id'], $_SESSION['user_id']) ){
    $user_id = $_SESSION['user_id'];
    $cart_id = $_GET['cart_id'];
    $sql = "DELETE FROM tbl_cart WHERE tbl_cart.user_id=$user_id AND tbl_cart.id=$cart_id";
    $res = mysqli_query($conn, $sql);

    if($res){
        //SEt Success MEssage and REdirect
        $_SESSION['delete'] = "<div class='success'>Item Deleted Successfully.</div>";
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Item.</div>";
    }
    //Redirect to Manage Category
    header('location:'.SITEURL.'shopping-cart.php');
}
else{
    //SEt Fail MEssage and Redirecs
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Item.</div>";
    //Redirect to Manage Category
    header('location:'.SITEURL.'shopping-cart.php');
}
?>