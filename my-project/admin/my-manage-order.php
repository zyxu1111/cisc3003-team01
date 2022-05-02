<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br /><br /><br />

        <?php 
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <br><br>
        <!-- success and error message -->
        <?php 

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-order-found']))
            {
                echo $_SESSION['no-order-found'];
                unset($_SESSION['no-order-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        
        ?>

        <table class="tbl-full">
            <tr>
                <th>Order No.</th>
                <th>Username</th>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Manage</th>
            </tr>

            <?php 
                //Get all the orders from database
                // $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // DIsplay the Latest Order at First
                $sql = "SELECT `tbl_order`.id order_id, `tbl_users`.username,`tbl_goods`.title ,`tbl_goods`.price, `tbl_order`.qty, order_date, 
                status, customer_name, customer_contact, customer_email, customer_address
                FROM (`tbl_users` INNER JOIN `tbl_order` ON `tbl_users`.id=`tbl_order`.user_id) INNER JOIN 
                `tbl_goods` ON `tbl_order`.goods_id=`tbl_goods`.id
                ORDER BY order_id DESC";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count the Rows
                $count = mysqli_num_rows($res);

                // $sn = 1; //Create a Serial Number and set its initail value as 1

                if($count>0)
                {
                    //Order Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get all the order details
                        $order_id = $row['order_id'];
                        // $user_id = $row['user_id'];
                        // $goods_id = $row['goods_id'];
                        $username = $row['username'];
                        $item_title = $row['title'];
                        $price= $row['price'];
                        $qty = $row['qty'];
                        $total = $price * $qty;
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        
                        ?>

                            <tr>
                                <td><?php echo $order_id; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $item_title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo number_format($total,2); ?></td>
                                <td><?php echo $order_date; ?></td>

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

                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/my-order-detail.php?order_id=<?php echo $order_id; ?>" class="btn-secondary">View Detail</a>
                                </td>
                            </tr>

                        <?php

                    }
                }
                else
                {
                    //Order not Available
                    echo "<tr><td colspan='12' class='error'>No orders found.</td></tr>";
                    $_SESSION['no-order-found'] = "<div class='error'>Orders not available.</div>";
                }
            ?>


        </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>