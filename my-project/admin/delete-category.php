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
?>
<?php
 if(isset($_SESSION['remove']))
    {
      echo $_SESSION['remove'];
      unset($_SESSION['remove']);
    }
  ?>
<?php
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    
   if($image_name != "")
    {
        $path = "../images/category/".$image_name;
        $remove = unlink($path);
        if($remove==false)
        {
            $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            // die();
        }
    } 
    
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    
    
    
}
else
{
    header('location:'.SITEURL.'admin/manage-category.php');
}
?>
