<?php include('partials-front/menu.php'); ?>
<?php include('partials-front/my-login-check.php'); ?>

<link rel="stylesheet" href="css/sc.css">
<div class="shopping-cart">
    <!-- Title -->
    <div class="title">
    Shopping Cart
    </div>

    <!-- Query the Product -->
    <?php
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

        //Get the DEtails of the SElected Food
        $sql_u = "SELECT * FROM tbl_users WHERE id=$user_id";
        $res_u = mysqli_query($conn, $sql_u);
        $count_u = mysqli_num_rows($res_u);

        if($count_u){
            //Query to Get all CAtegories from Database
            $sql = "SELECT tbl_cart.id, tbl_cart.qty, tbl_goods.title, tbl_goods.description, tbl_goods.price, tbl_goods.image_name, tbl_cart.goods_id
            FROM (tbl_cart JOIN tbl_goods ON tbl_cart.goods_id=tbl_goods.id) 
            WHERE tbl_cart.user_id=$user_id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count>0){
                // The user's shopping cart is not empty.
                while($row=mysqli_fetch_assoc($res))
                {   
                    //$user_id is already defined
                    $cart_id = $row['id'];
                    $qty = $row['qty'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $total = $qty * $price;
                    $goods_id = $row['goods_id'];
                    //Chcek whether image name is available or not

                    if($image_name!="")
                    {
                        //Display the Image
                    }
                    else
                    {
                        //DIsplay the MEssage
                        echo "<div class='error'>Image not Added.</div>";
                    }
                    
                    // Display the item
                    ?>
                    <div class="item">
                    <div class="buttons">
                    <span class="delete-btn" onclick="location.href='<?php echo SITEURL; ?>my-delete-cart.php?cart_id=<?php echo $cart_id; ?>'"></span>
                    <span class="cart-btn" onclick="location.href='<?php echo SITEURL; ?>order.php?goods_id=<?php echo $goods_id; ?>&qty=<?php echo $qty; ?>'"></span>
                    </div>

                    <div class="image">
                    <img src="<?php echo SITEURL; ?>images/vegetable/<?php echo $image_name;  ?>" >
                    </div>

                    <div class="description">
                    <span><?php echo $title; ?></span>
                    <span><?php echo $description; ?></span>
                    <!-- <span>White</span> -->
                    </div>

                    <div class="unit-price">$<?php echo number_format($price,2);  ?></div>
                    
                    <div class="quantity">
                    <button class="minus-btn" type="button" name="button" onclick="location.href='<?php echo SITEURL; ?>my-update-cart.php?op=sub&cart_id=<?php echo $cart_id; ?>'">
                        <img src="images/minus.svg" alt="" />
                    </button>
                    <input type="text" name="name" value=<?php echo $qty?>>
                    <button class="plus-btn" type="button" name="button" onclick="location.href='<?php echo SITEURL; ?>my-update-cart.php?op=add&cart_id=<?php echo $cart_id; ?>'">
                        <img src="images/plus.svg" alt="" />
                    </button>
                    </div>

                    <div class="total-price">$<?php echo number_format($total,2);  ?></div>
                    </div>

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

</div>

<?php include('partials-front/footer.php'); ?>