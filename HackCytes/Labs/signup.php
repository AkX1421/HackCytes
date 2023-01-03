<?php
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$user = $_POST['user'];
	$pass = $_POST['password'];


	// Database connection
	$conn = new mysqli('sql306.hyperphp.com','hp_33272278','v3fbkn17','hp_33272278_hackcytes');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into users(first_name,last_name,user,password) 
        values(?, ?, ?, md5(?))");
		$stmt->bind_param("ssss", $first_name, $last_name, $user, $pass);
		$execval = $stmt->execute();
	
		header("Location:login.php");
		$stmt->close();
		$conn->close();
	}
?>
