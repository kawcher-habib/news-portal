<?php
        include "config.php";
        $getId = $_GET['id'];
        $sql = "DELETE from user where user_id = '$getId'";
        $result = mysqli_query($conn, $sql) or die("Query Failed". mysqli_connect_error());
        if($result){
            header("Location: {$hostName}/admin/users.php");
        }else{
            echo "Your Code not working";
        }

?>