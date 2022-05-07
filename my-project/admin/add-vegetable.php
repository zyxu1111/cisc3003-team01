<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add vegetable</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

    <div>
<form action=" " method="POST" enctype="multipart/form-data">
<table>
<br>
<tr>
<td>
Title 
</td>
<td>
<input type="text" name="title" placeholder="the name of vegetable">
</td>
</tr>
<br>

<br>
<tr>
<td>Description:</td>
<td>
<textarea name="description" cols="30" rows="5" placeholder="the description of vegetable"></textarea>
</td>
</tr>
<br>

<br>
<tr>
<td>Price </td>
<td>
<input type="number"  name="price" min="0.00" step="0.01">
</td>
</tr>
<br>

<br>
<tr>
<td>Image</td>
<td>
<input type="file" name="image">
</td>
</tr>
<br>

<br>
 <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 

                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            
                            ?>

                        </select>
                    </td>
                </tr>
<br>

<br>
<tr>
<td>Featured: </td>
<td>
<input type="radio" name="featured" value="Yes"> Yes 
<input type="radio" name="featured" value="No"> No
 </td>
 </tr>
 <br>
 
 <br>
<tr>
<td>Active: </td>
<td>
<input type="radio" name="active" value="Yes"> Yes 
<input type="radio" name="active" value="No"> No
 </td>
 </tr>
 <br>
 

<tr>
<td colspan="2">
<input type="submit" value="Add Vegetable" name="submit" class="btn">
</td>
</tr>

</table>
</form>

                     

        
  <?php 

if(isset($_POST['submit']))
{ 
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    if(isset($_POST['featured'])){
        $featured=$_POST['featured'];}
        else{$featured="No";}
        if(isset($_POST['active'])){$active=$_POST['active'];}
        else{$active="No";}

                if(isset($_FILES['image']['name']))
                {

                    $image_name = $_FILES['image']['name'];

                    if($image_name!="")
                    {

                        $ext = end(explode('.', $image_name));
                        $image_name = "Vegetable-Name-".$title.".".$ext; 
                        $upload = move_uploaded_file($_FILES['image']['tmp_name'], "../images/vegetable/".$image_name);
                        // if($upload==false)
                        // {
                        //     $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        //     header('location:'.SITEURL.'admin/add-vegetable.php');
                        //     die();
                        // }

                    }

                }
                else
                {
                    $image_name = ""; 
                }
                // $sql4="SELECT * FROM tbl_goods";
                // $res4 = mysqli_query($conn, $sql4);
                // $count = mysqli_num_rows($res4);
                // var_dump($count);
                // if($count>0)
                // { 
                // $sql3="SELECT max(id) FROM tbl_goods";
                // $res3 = mysqli_query($conn, $sql3);
                // $res3 = $res3->fetch_array();
                // $quantity = intval($res3[0]);
                // $temp=$quantity+1;
                // }
                // else
                // {
                //     $temp=1;
                // }
                $sql2 = "INSERT INTO tbl_goods SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                {
 
                    $_SESSION['add'] = "<div class='success'>Vegetable Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-vegetable.php');
                }
                else
                {
 
                    $_SESSION['add'] = "<div class='error'>Failed to Add Vegetable.</div>";
                   header('location:'.SITEURL.'admin/manage-vegetable.php');
                }

                
            }

        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
        
        
        
        
        
        
        
        
        
        
        
        
        