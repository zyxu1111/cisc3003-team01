<?php include('partials-front/menu.php'); ?>
<?php include('partials-front/my-login-check.php'); ?>
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
	<div style="float:left;width:30%;height:100%;margin: 5px 0px 20px 10%;">
	<img src="<?php echo SITEURL; ?>images/vegetable/<?php echo $image_name; ?>" width="550px" height="550px">
	</div>

 <div style="float:right;width:30%;height:100%;margin: 5px 15% 20px 0%;">
 <h1 style="font-size:300%;">Title: <?php echo $title; ?></h1>
 <br> <br>
 <P style="font-size:160%;">Description: <?php echo $description; ?></P>
 <br> <br>
 <P style="font-size:160%;">Price:<?php echo $price?></P>
 <br> <br>
 <label style="font-size:160%;">Quanitiy:<input type="number"  name="qy"></label>
 <br> <br><br><br>
 <input type="submit" name="buy" value="buy it now" class="btn-secondary" style="height:50px; width:120px">
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <input type="submit" name="cart" value="shopping cart" class="btn-secondary" style="height:50px; width:120px">
 </div>
          
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
    header('location:'.SITEURL.'order.php?goods_id='.$id.'&qty='.$qy);
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
 <div style="clear:both;display:flex;bottom:0px;">       
       
           </div>      
<?php include('partials-front/footer.php'); ?>  
