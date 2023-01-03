<?php
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];


	// Database connection
	$conn = new mysqli('localhost:3307','root','','feedback');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into reaction(fullname, email, phone, message) 
        values(?, ?, ?, ?)");
		$stmt->bind_param("sssi", $fullname, $email, $phone, $message);
		$execval = $stmt->execute();
	
		header("Location:first.html");
		$stmt->close();
		$conn->close();
	}
?>