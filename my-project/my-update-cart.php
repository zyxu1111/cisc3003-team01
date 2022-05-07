<?php include('config/constants.php'); ?>
<?php include('partials-front/my-login-check.php'); ?>

<?php
if( isset($_GET['cart_id'], $_GET['op'], $_SESSION['user_id']) ){
    $user_id = $_SESSION['user_id'];
    $cart_id = $_GET['cart_id'];
    $op = $_GET['op'];

    if($op=='add'){
        $sql = "UPDATE `tbl_cart` SET `qty`=`qty`+1 WHERE `id`=$cart_id AND `user_id`=$user_id";
        $res = mysqli_query($conn, $sql);
    }
    elseif($op=='sub'){
        $sql = "UPDATE `tbl_cart` SET `qty`=`qty`-1 WHERE `id`=$cart_id AND `user_id`=$user_id AND `qty`>1";
        $res = mysqli_query($conn, $sql);
    }

    if($res){
        // Set Success Message and Redirect
        $_SESSION['delete'] = "<div class='success'>Item Updated Successfully.</div>";
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed to Update Item.</div>";
    }

    header('location:'.SITEURL.'shopping-cart.php');
}
else{
    //SEt Fail MEssage and Redirecs
    $_SESSION['update'] = "<div class='error'>Failed to Update Item.</div>";
    //Redirect to Manage Category
    header('location:'.SITEURL.'shopping-cart.php');
}
?>