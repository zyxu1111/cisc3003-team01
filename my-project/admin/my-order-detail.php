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
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Order Detail</h1>
        <br><br>


        <?php 
        
            //CHeck whether id is set or not
            if(isset($_GET['order_id']))
            {
                //GEt the Order Details
                $order_id=$_GET['order_id'];

                //Get all other details based on this id
                //SQL Query to get the order details
                $sql = "SELECT `tbl_order`.id order_id, `tbl_users`.username,`tbl_goods`.title ,`tbl_goods`.price, `tbl_order`.qty, order_date, 
                status, customer_name, customer_contact, customer_email, customer_address, user_id, goods_id
                    FROM (`tbl_users` INNER JOIN `tbl_order` ON `tbl_users`.id=`tbl_order`.user_id) INNER JOIN 
                    `tbl_goods` ON `tbl_order`.goods_id=`tbl_goods`.id
                    WHERE `tbl_order`.id = $order_id";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);

                if($count)
                {
                    //Detail Availble
                    $row=mysqli_fetch_assoc($res);
                    $user_id = $row['user_id'];
                    $goods_id = $row['goods_id'];
                    $username = $row['username'];
                    $item_title = $row['title'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address= $row['customer_address'];

                    
                }
                else
                {
                    //DEtail not Available/
                    //Redirect to Manage Order
                    header('location:'.SITEURL.'admin/my-manage-order.php');
                }
            }
            else
            {
                //REdirect to Manage ORder PAge
                header('location:'.SITEURL.'admin/my-manage-order.php');
            }
        
        ?>

        
        <table class="tbl-30">
            <tr>
                <td>Order No.</td>
                <td><b> <?php echo $order_id; ?> </b></td>
            </tr>
            <tr>
                <td>User ID</td>
                <td><b> <?php echo $user_id; ?> </b></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><b> <?php echo $username; ?> </b></td>
            </tr>
            <tr>
                <td>Item ID</td>
                <td><b> <?php echo $goods_id; ?> </b></td>
            </tr>
            <tr>
                <td>Item Title</td>
                <td><b> <?php echo $item_title; ?> </b></td>
            </tr>

            <tr>
                <td>Price</td>
                <td>
                    <b> $ <?php echo $price; ?></b>
                </td>
            </tr>

            <tr>
                <td>Quantity</td>
                <td>
                    <b><?php echo $qty; ?></b>
                </td>
            </tr>

            <tr>
                <td>Total</td>
                <td>
                    <b> $ <?php echo number_format($price * $qty,2); ?></b>
                </td>
            </tr>

            <tr>
                <td>Order Date</td>
                <td>
                    <b><?php echo $order_date; ?></b>
                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>
                <?php 
                    // Ordered, On Delivery, Delivered, Cancelled

                    if($status=="Ordered")
                    {
                        echo "<label>$status</label>";
                    }
                    elseif($status=="On Delivery")
                    {
                        echo "<label style='color: orange;'>$status</label>";
                    }
                    elseif($status=="Delivered")
                    {
                        echo "<label style='color: green;'>$status</label>";
                    }
                    elseif($status=="Cancelled")
                    {
                        echo "<label style='color: red;'>$status</label>";
                    }
                ?>
                </td>
            </tr>

            <tr>
                <td>Customer Name: </td>
                <td>
                    <b> <?php echo $customer_name; ?></b>
                </td>
            </tr>

            <tr>
                <td>Customer Contact: </td>
                <td>
                    <b> <?php echo $customer_contact; ?></b>
                </td>
            </tr>

            <tr>
                <td>Customer Email: </td>
                <td>
                    <b> <?php echo $customer_email; ?></b>
                </td>
            </tr>

            <tr>
                <td>Customer Address: </td>
                <td>
                    <b> <?php echo $customer_address; ?></b>
                </td>
            </tr>

            <tr>
                <td colspan=2>
                    <a href="<?php echo SITEURL; ?>admin/my-manage-order.php" class="btn-primary">Back</a>
                    <a href="<?php echo SITEURL; ?>admin/my-update-order.php?order_id=<?php echo $order_id;?>" class="btn-secondary">Update</a>
                    <a href="<?php echo SITEURL; ?>admin/my-delete-order.php?order_id=<?php echo $order_id;?>" class="btn-danger">Delete</a>
                </td>
            </tr>
        </table>


    </div>
</div>

<?php include('partials/footer.php'); ?>