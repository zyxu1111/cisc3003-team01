<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update User</h1>

        <br><br>

        <?php 
            //1. Get the ID of Selected User
            $id=$_GET['id'];

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM tbl_users WHERE id=$id";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have data or not
                if($count==1)
                {
                    // Get the Details
                    //echo "User Available";
                    $row=mysqli_fetch_assoc($res);

                    $nickname = $row['nickname'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to Manage Page
                    header('location:'.SITEURL.'admin/manage-users.php');
                }
            }
        
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Nickname: </td>
                    <td>
                        <input type="text" name="nickname" value="<?php echo $nickname; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update User" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 

    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button CLicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $nickname = $_POST['nickname'];
        $username = $_POST['username'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE tbl_users SET
        nickname = '$nickname',
        username = '$username' 
        WHERE id='$id'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>User Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-users.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Delete User.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-users.php');
        }
    }

?>


<?php include('partials/footer.php'); ?>