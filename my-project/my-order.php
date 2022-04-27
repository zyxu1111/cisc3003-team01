
<?php include('partials-front/menu.php'); ?>
<?php include('partials-front/my-login-check.php'); ?>

<?php 
    //CHeck whether food id is set or not
    if(!isset($_SESSION['user_id']))
    {
        header('location:'.SITEURL.'my-login.php');
    }
    elseif(!isset($_GET['goods_id']))
    {
        //Redirect to homepage
        header('location:'.SITEURL);
    }
    else
    {
            //Get the Food id and details of the selected food
            $user_id = $_SESSION['user_id'];
            $goods_id = $_GET['goods_id'];

            //Get the DEtails of the SElected Food
            $sql = "SELECT * FROM tbl_goods WHERE id=$goods_id";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count the rows
            $count = mysqli_num_rows($res);

            $sql_u = "SELECT * FROM tbl_users WHERE id=$user_id";
            //Execute the Query
            $res_u = mysqli_query($conn, $sql_u);
            //Count the rows
            $count_u = mysqli_num_rows($res);

            //CHeck whether the data is available or not
            if($count and $count_u)
            {
                //GEt the Data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //Food not Availabe or user does not exist
                //REdirect to Home Page
                header('location:'.SITEURL);
                
            }
    }
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                    
                        //CHeck whether the image is available or not
                        if($image_name=="")
                        {
                            //Image not Availabe
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            //Image is Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                    
                    ?>
                    
                </div>

                <div class="goods-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="goods" value="<?php echo $title; ?>">

                    <p class="goods-price">$<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="<?php echo (isset($_GET['qty'])? $_GET['qty']: 1); ?>" required>
                    
                </div>

            </fieldset>
            
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php 

            //CHeck whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                // Get all the details from the form

                $goods = $_POST['goods'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty; // total = price x qty 

                $order_date = date("Y-m-d h:i:sa"); //Order DAte

                $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];


                //Save the Order in Databaase
                //Create SQL to save the data
                $sql2 = "INSERT INTO tbl_order SET 
                    user_id = '$user_id',
                    goods_id = '$goods_id',
                    goods = '$goods',
                    price = '$price',
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                ";

                //echo $sql2; die();

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether query executed successfully or not
                if($res2)
                {
                    //Query Executed and Order Saved
                    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                    header('location:'.SITEURL);
                }
                else
                {
                    //Failed to Save Order
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                    header('location:'.SITEURL);
                }

            }
        
        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>