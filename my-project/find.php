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
<?php include('partials-front/menu.php'); ?>
<div style="float:left;width:30%;height:100%;margin: 5px 0px 20px 10%;background-color: #35bbca;">
<form action="" method="POST" enctype="multipart/form-data">
<table class="tbl-30" style="border: 1px solid;width:100%;height:100%;">
 <tr >
<td >
<input type="submit" name="submit" value="Enter" class="btn-secondary" style="height: 40px; width: 80px;">
</td>
</tr>
<?php 
$sql = "SELECT * FROM tbl_category";
$res = mysqli_query($conn, $sql);
while($row=mysqli_fetch_assoc($res))
{ 
 $id=$row['id'];
 $category_title = $row['title'];
 $category_name=$row['image_name'];

 echo "<tr>";
  echo "<td >$category_title </td> ";
  ?>
  <td style="border: 1px solid;padding:10px;width:200px;height:200px;margin: 5px 0px 5px 0px;"><img src="<?php echo SITEURL; ?>images/category/<?php echo $category_name; ?>" width="190px" height="190px"></td>
  <?php
    if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
        if($id==$category_id){
            echo "<td><input type='radio' name='image' value='$id' checked ></td>";
        }
        else{
            echo "<td><input type='radio' name='image' value='$id'></td>";
        }
    }
    else{
        echo "<td><input type='radio' name='image' value='$id' ></td>";
    }
	echo "<tr>";
}
?>
</table>        
</form>

</div>
<div style="float:right;width:20%;height:100%;margin: 5px 15% 20px 0%;background-color: #d3dd18; ">
<?php 
if(isset($_POST['submit']))
{
    
    if(isset($_POST['image'])){$sql2 = "SELECT id FROM tbl_category";
    $res2 = mysqli_query($conn, $sql2);
    $number=-1;
    while($row2=mysqli_fetch_assoc($res2))
    {
        if($row2['id']==$_POST['image'])
        {
            $number=$row2['id'];
            break;
        }
    }
    if(isset($number))
    {
        $sql3 = "SELECT * FROM tbl_goods WHERE category_id=$number AND active='Yes'";
        if(isset($sql3))
        {
            $res3 = mysqli_query($conn, $sql3);
            
            while($row3=mysqli_fetch_assoc($res3))
            {
                $goodsid=$row3['id'];
                $title=$row3['title'];
                $image_name = $row3['image_name'];
                $price=$row3['price'];
                ?>
            <table style="border: 1px solid;width:100%;height:100%;">
            <tr>
            <td>
 <?php echo $title.":"."$".$price; ?>
 </td>
  </tr>
 <tr>
 <td style="border: 1px solid;padding:10px;width:100px;height:200px;margin: 5px 0px 5px 0px;">
 <a href="<?php echo SITEURL; ?>item.php?specific=<?php echo $goodsid; ?>">
    <img src="<?php echo SITEURL; ?>images/vegetable/<?php echo $image_name; ?>" width="190px" height="190px">
    </a>
    </td>
    
               </tr>
               </table>
               <?php 
        }
        }
    }
    
    }
    else{
        echo"<h1>Not Selected</h1>";
    }
    
}
               
?>             
 </div>                      
        <div style="clear:both;display:flex;bottom:0px;">       
         
           </div>      
               
<?php include('partials-front/footer.php'); ?>             
               
               
               
               
               
               
               
               
               
               
               
               

             