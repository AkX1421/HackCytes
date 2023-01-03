<?php
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];


	// Database connection
	$conn = new mysqli('localhost:3307','root','','register');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into login(fullname,password,email, phone) 
        values(?, ?, ?, ?)");
		$stmt->bind_param("sssi", $fullname, $password, $email, $phone);
		$execval = $stmt->execute();
	
		header("Location:login.html");
		$stmt->close();
		$conn->close();
	}
?>