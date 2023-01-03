<?php
//if(isset($_POST['name'])){
$fullname = $_POST['fullname'];
$password = $_POST['password'];

//}

  $con = new mysqli("localhost:3307","root","","register");
  if($con->connect_error){
    die("failed to connect : ".$con->connect_error);
  }else{
    $stmt = $con->prepare("select * from login where fullname = ?");
    
    $stmt->bind_param("s",$fullname);
    $stmt->execute();

    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows > 0) {
      $data = $stmt_result-> fetch_assoc();
      if($data['password'] === $password){
      header("Location: dept.html");
      
      }

     else{
      echo  "<script>
      
      window.location='login.html';
      alert('Invalid Name or Password');
      
      
      </script>";
      
     }
    }
  }

  ?>