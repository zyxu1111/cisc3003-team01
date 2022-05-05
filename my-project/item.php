<?php include('partials-front/menu.php'); ?>
<?php 
if(isset($_GET['specific'])){
    $id=$_GET['specific'];
    $sql = "SELECT * FROM tbl_goods WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($res);
    $title = $row['title'];
    $image_name=$row['image_name'];
    $description=$row['description'];
    $price=$row['price'];
    ?>
    <div>
    <form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
    <tr>
    <th><img src="<?php echo SITEURL; ?>images/vegetable/<?php echo $image_name; ?>" width="150px" height="150px"></th>
    <th>description:<?php echo $description?></th>
  </tr>
  <tr>
    <td> </td>
    <td>Price:<?php echo $price?></td>
  </tr>
  
  <tr>
    <td> </td>
    <td><label>quanitiy:<input type="number"  name="qy"></label></td>
  </tr>
  
    <tr>
    <td> </td>
    <td ><input type="submit" name="buy" value="buy it now" class="btn-secondary"></td>
     <td ><input type="submit" name="cart" value="shopping cart" class="btn-secondary"></td>
  </tr>
  
     
</table>        
</form>
</div>
<?php 
}
?>
<?php 
if(isset($_POST['buy']))
{
    // var_dump("bought");
    $qy=$_POST['qy'];
    header('location:'.SITEURL.'my-order.php?goods_id='.$id.'&qty='.$qy);
 //   header('location:'.SITEURL.'admin/manage-vegetable.php');
}
if(isset($_POST['cart']))
{
    $user_id = $_SESSION['user_id'];
    $qy=$_POST['qy'];
    $sql1 = "INSERT INTO tbl_cart SET 
                    user_id = $user_id,
                    goods_id =$id,
                    qty = $qy";
    $res1 = mysqli_query($conn, $sql1);
    if($res){
      header('location:'.SITEURL.'find.php');
    }  
    else{
      echo "Failed to add to shopping cart.";
      header('location:'.SITEURL.'item.php?specific='.$id);
    }
}


?>
<?php include('partials-front/footer.php'); ?>
