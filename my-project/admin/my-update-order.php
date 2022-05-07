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
        <h1>Update Order</h1>
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

        <form action="" method="POST">
        
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
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>


        <?php 
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                // $order_id = $_POST['id'];
                $qty = $_POST['qty'];

                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                //Update the Values
                $sql2 = "UPDATE tbl_order SET 
                    qty = $qty,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$order_id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether update or not
                //And REdirect to Manage Order with Message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/my-manage-order.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/my-manage-order.php');
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>