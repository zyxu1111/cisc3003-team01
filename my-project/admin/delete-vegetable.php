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
if(isset($_GET['id']) && isset($_GET['image_name'])) 
{
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    if($image_name != "")
    {

        $path = "../images/vegetable/".$image_name;
        $remove = unlink($path);
        if($remove==false)
        {
            $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
            header('location:'.SITEURL.'admin/manage-vegetable.php');
            
        }
        
    }
    
    $sql = "DELETE FROM tbl_goods WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Vegetable Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-vegetable.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete vegetable.</div>";
        header('location:'.SITEURL.'admin/manage-vegetable.php');
    }
    
    
    
}
else
{
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-vegetable.php');
}

?>