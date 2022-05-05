<?php include('partials-front/menu.php'); ?>
<div style="float:left;width:50%;height:100%;">
<form action="" method="POST" enctype="multipart/form-data">
<table class="tbl-30">
 <tr>
<td>
<input type="submit" name="submit" value="Refresh" class="btn-secondary">
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
  echo "<td>$category_title </td> ";
  ?>
  <td><img src="<?php echo SITEURL; ?>images/category/<?php echo $category_name; ?>" width="150px" height="150px"></td>
  <?php
     echo "<td><input type='radio' name='image' value='$id'></td>";
	echo "<tr>";


}
?>
</table>        
</form>

</div>
<div style="float:right;width:50%;height:100%; ">
<?php 
if(isset($_POST['submit']))
{
 $sql2 = "SELECT id FROM tbl_category";
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
            <table>
            <tr>
            <td>
 <?php echo $title.":"."$".$price; ?>
 </td>
  </tr>
 <tr>
 <td>
 <a href="<?php echo SITEURL; ?>item.php?specific=<?php echo $goodsid; ?>">
    <img src="<?php echo SITEURL; ?>images/vegetable/<?php echo $image_name; ?>" width="150px" height="150px">
    </a>
    </td>
    
               </tr>
               </table>
               <?php 
        }
        }
    }
}
               
?>             
 </div>                      
        <div style="clear:both;display:flex;bottom:0px;">       
         
           </div>      
               
<?php include('partials-front/footer.php'); ?>             
               
               
               
               
               
               
               
               
               
               
               
               

             