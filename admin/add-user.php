<?php include "header.php";
 include "config.php";
 if ($_SESSION['user_role'] == '0') {
        header("Location: ${hostName}/admin/post.php");
    }
    
if (isset($_POST['save'])) {
   
    $fName = mysqli_real_escape_string($conn, $_POST['fname']);
    $lName = mysqli_real_escape_string($conn, $_POST['lname']);
    $userName = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $validationSql = "SELECT username FROM user where username= '$userName'";
    $result = mysqli_query($conn, $validationSql);

    if (mysqli_num_rows($result) > 0) {
       echo "<p style='color:red; text-align:center; margin: 10px 0px'>User Already Existing</p>";
    }else{
        $sql = "INSERT INTO user(first_name, last_name, username, password, role) VALUES('$fName', '$lName', '$userName','$password','$role')";
        mysqli_query($conn, $sql);
        header("Location: {$hostName}/admin/users.php");
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0">Normal User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>