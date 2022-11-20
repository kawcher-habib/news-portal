<?php 
include "config.php";
		$user_id = $_GET['id'];
		$deleteData = "DELETE from user where user_id= '{$user_id}'";
		if(mysqli_query($conn, $deleteData)){
			header("Location: http://localhost/news-template/admin/users.php");
		}

?>
