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

    //Include constants.php file here
    include('../config/constants.php');

    // 1. get the ID of Admin to be deleted
    $id = $_GET['id'];

    //2. Create SQL Query to Delete Admin
    $sql_cart = "DELETE FROM tbl_cart WHERE user_id=$id";
    $sql_order = "DELETE FROM tbl_order WHERE user_id=$id";
    $sql = "DELETE FROM tbl_users WHERE id=$id";

    //Execute the Query
    $res_cart = mysqli_query($conn, $sql_cart);
    $res_order = mysqli_query($conn, $sql_order);
    $res = mysqli_query($conn, $sql);
    

    // Check whether the query executed successfully or not
    if($res and $res_cart and $res_order)
    {
        //Query Executed Successully and Admin Deleted
        //echo "User Deleted";
        //Create SEssion Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>User Deleted Successfully.</div>";
        //Redirect to Manage Page
        header('location:'.SITEURL.'admin/manage-users.php');
    }
    else
    {
        //Failed to Delete 
        //echo "Failed to Delete User";

        $_SESSION['delete'] = "<div class='error'>Failed to Delete User. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-users.php');
    }

    //3. Redirect to Manage page with message (success/error)

?>