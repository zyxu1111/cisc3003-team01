
<?php include('partials-front/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>My Shopping Cart</h1>

        <br /><br />
        <!-- success and error message -->
        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        
        ?>
        <br><br>

        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/my-add-category.php" class="btn-primary">Add Category</a>

        <br /><br /><br />

    <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Item Title</th>
                <th>Item Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>

        <?php 
            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];

                //Get the DEtails of the SElected Food
                $sql_u = "SELECT * FROM tbl_users WHERE id=$user_id";
                $res_u = mysqli_query($conn, $sql_u);
                $count_u = mysqli_num_rows($res_u);

                if($count_u){
                    //Query to Get all CAtegories from Database
                    $sql = "SELECT tbl_cart.qty, tbl_goods.title, tbl_goods.description, tbl_goods.price, tbl_goods.image_name 
                    FROM (tbl_cart JOIN tbl_goods ON tbl_cart.goods_id=tbl_goods.id) 
                    WHERE tbl_cart.user_id=$user_id";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    //Create Serial Number Variable and assign value as 1
                    $sn=1;

                    //Check whether we have data in database or not
                    if($count>0){
                        // The user's shopping cart is not empty.
                        while($row=mysqli_fetch_assoc($res))
                        {   
                            //$user_id is already defined
                            $qty = $row['qty'];
                            $title = $row['title'];
                            $description = $row['description'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $total = $qty * $price;

        ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $title; ?></td>

                            <td>

        <?php  
                                    //Chcek whether image name is available or not
                                    if($image_name!="")
                                    {
                                        //Display the Image
                                        ?>
                                        
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >
                                        
                                        <?php
                                    }
                                    else
                                    {
                                        //DIsplay the MEssage
                                        echo "<div class='error'>Image not Added.</div>";
                                    }
                                ?>

                            </td>

                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/my-update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Item</a>
                                <a href="<?php echo SITEURL; ?>admin/my-delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Item</a>
                            </td>
                        </tr>

        <?php

                        }
                    }
                    else{
                        //The user's shopping cart is empty.
                        
                        echo
                        '<tr>
                            <td colspan="6"><div class="error">您的购物车空空如也</div></td>
                        </tr>';
 
                    }
                }
                else{
                    echo "ERROR";
                }


            }
            else{
                echo "ERROR";
            }
      
        ?>

                    

                    
    </table>
    </div>
    
</div>

<?php include('partials-front/footer.php'); ?>