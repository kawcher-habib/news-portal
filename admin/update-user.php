<?php include "header.php";
include "config.php";
if ($_SESSION['user_role'] == '0') {
        header("Location: ${hostName}/admin/post.php");
    }
if(isset($_POST['submit'])){
    
    $getId =  $_POST['user_id'];
    $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
    $userName = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $sql = "SELECT username from user where username = '$userName'";
    $result = mysqli_query($conn, $sql) or die('Query Failed'. mysqli_connect_error());
    if(mysqli_num_rows($result) > 0){
        echo "<p style='color:red; text-align:center; margin: 10px 0px'>User Already Existing</p>";
    }else{
        
        $updateSql = "UPDATE user SET first_name='{$fname}', last_name='{$lname}', username='{$userName}', role='{$role}' where user_id = '$getId'";
        $updateResult = mysqli_query($conn, $updateSql);
        if($updateResult){
            header("Location: {$hostName}/admin/users.php");
        }else{
            echo "Query Is Failed";
        }
    }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>

            </div>
            <div class="col-md-offset-4 col-md-4">
                <?php
               $getId = $_GET['id'];
                $sql = "SELECT * from user where user_id = '$getId'";
                $result = mysqli_query($conn, $sql) or die("Query Failed" . mysqli_connect_error());
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {


                ?>
                        <!-- Form Start -->
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo "{$row['user_id']}" ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo "{$row['first_name']}" ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo "{$row['last_name']}" ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo "{$row['username']}" ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="">
                                    <option value="">
                                        <?php if ($row['role'] == 1) {
                                            echo "Admin";
                                            echo '<option value="0">Normal User</option>';
                                        } else {
                                            echo "Normal User";
                                            echo ' <option value="1">Admin</option>';
                                        } ?>
                                    </option>
                                   
                                   


                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                <?php

                    }
                }

                ?>

                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>