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
include('../config/constants.php'); 
include('partials/my-login-check.php');
?>

<?php
if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $sql = "DELETE FROM tbl_order WHERE tbl_order.id = $order_id";
    $res = mysqli_query($conn, $sql);

    if($res){
        $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully.</div>";
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete order.</div>";
    }
    header('location:'.SITEURL.'admin/my-manage-order.php');

}
else{
    $_SESSION['delete'] = "<div class='error'>Order Id Does Not Exist. Failed to Delete Order.</div>";
    //Redirect to Manage Category
    header('location:'.SITEURL.'admin/my-manage-order.php');
}

?>