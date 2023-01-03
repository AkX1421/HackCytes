<?php
$cn = mysqli_connect("localhost:3307", "root", "", "form");
?>

<!doctype html>
<html lang="en">

<head>
<title>Vishwakarma University</title>
	<link rel="icon" href="logo.png">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
		header {
			background-image: url("Images/back.jpg");
			background-repeat: no-repeat;
			background-position: center;
			background-attachment: fixed;
			background-size: cover;
			height: 600px;
		}

		div {
			text-align: center;
		}

		.uplinks {
			margin: 2%;
			text-align: center;
			color: #48067e;
		}

		.uplinks:hover {
			color: #e27115;
			text-decoration: underline;
		}

		.typewrite {
			text-decoration: none;
		}

		.width {
			width: 10%;
		}

		.width2 {
			width: 50%;
		}

		.image {
			width: 100%;
			height: 100%;
			padding: 20px;
			margin: 10px;
		}

		.text {
			margin: 5%;
			padding: 1%;
		}

		.image2 {
			width: 100%;
			height: 600px;
			padding: 20px;
			margin: 10px;
		}

		.footlink {
			font-size: 50px;
			display: inline-block;
			transition: transform .01s;
			margin: 2%
		}

		.whats:hover {
			color: #25D366;
			transform: scale(2.5);
		}

		.face:hover {
			color: #3b5998;
			transform: scale(2.5);
		}

		.insta:hover {
			color: #E1306C;
			transform: scale(2.5);
		}

		.tele:hover {
			color: #0088cc;
			transform: scale(2.5);
		}

		.enve:hover {
			color: #D44638;
			transform: scale(2.5);
		}

		.mobi:hover {
			color: #833AB4;
			transform: scale(2.5);
		}

		.design {
			padding-top: 200px;
			padding-left: 40px;
		}

		.height {
			height: 600px;
		}


/*============================
Form CSS
==============================*/

.section-title h3 {
    background: #563D7C;
    padding: 10px;
    color: #fff;
    font-size: 30px;
    text-align: center;
    margin-bottom: 25px;
}

h3#et {
    text-transform: inherit;
}

.section-title .col-md-12 {
    margin: 0;
    padding: 0;
}

form label {
    text-transform: capitalize;
    font-size: 16px;
    margin: 0;
    display: inline-block;
}

form {
    margin-bottom: 35px;
}

form input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #dddd;
    outline: none;
    border-radius: 10px;
    margin-bottom: 20px;
}

.left-side-form {
    margin-right: 25px;
}

.right-side-form {
    margin-left: 25px;
}

select {
    width: 25%;
    padding: 10px;
    border: 1px solid #dddd;
    text-transform: capitalize;
    border-radius: 10px;
    margin-bottom: 20px;
    outline: none;
}

input[type="radio"] {
    margin: 0 8px;
    margin-bottom: 70px;
}

input[type="submit"] {
    background: #563D7C;
    border: none;
    color: #fff;
    padding: 10px 50px;
    border-radius: 10px;
    outline: none;
}

h5 span.error,
span.error {
    font-size: 16px;
    color: #BE4B49;
    margin-left: 5%;
}

.errorMessage {
    display: block;
    color: #BE4B49;
    font-size: 18px;
    text-transform: capitalize;
    margin-bottom: 15px;
}

.successMessage {
    display: block;
    color: #00770D;
    font-size: 18px;
    text-transform: capitalize;
    margin-bottom: 15px;
}

</style>

</head>

<body>
<header>
		<p class="w3-left w3-xlarge uplinks"><a href="login.html" style="text-decoration: none">Login</a></p>
		<p class="w3-left w3-xlarge uplinks"><a href="register.html" style="text-decoration: none">Sign Up</a></p>
		<p class="w3-left w3-xlarge uplinks"><a href="first.html" style="text-decoration: none">Home</a></p>

		<div class="w3-center w3-text-black width2">
			<h1 class="design">

				<a href="" class="w3-xxxlarge typewrite">Fill out the<br> Form below!&nbsp;</a>
				</a>
			</h1>
		</div>>

	</header>
	<br><br>
    
    

    <!--=========================== Content-area ============================-->
    <div class="content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                   
<?php
					$sname = "";
					$gname = "";
					$contact = "";
					$email = "";
					$address = "";
					$course = "";
					$gender = "";
				
					
					$esname = "";
					$egname = "";
					$econtact = "";
					$eemail = "";
					$eaddress = "";
					$ecourse = "";
					$egender = "";
					
					
					if(isset($_POST['submit']))
					{
					$sname = $_POST['sname'];
					$gname = $_POST['gname'] ;
					$contact = $_POST['contact'];
					$email = $_POST['email'];
					$address = $_POST['address'];
					$course = $_POST['course'];
				
						
					if(isset($_POST['gender']))
					$gender = $_POST['gender'];
						
					
						
						$er = 0;
						
						if($sname == "")
						{
							$er++;
							$esname = "*Required";
						}
						else{
							$sname = test_input($sname);
							if(!preg_match("/^[a-zA-Z ]*$/",$sname)){
							$er++;
							$esname = "*Only letters and white space allowed";
						}
						}

						if($gname == "")
						{
							$er++;
							$egname = "*Required";
						}
						else{
							$gname = test_input($gname);
							if(!preg_match("/^[a-zA-Z ]*$/",$gname)){
							$er++;
							$egname = "*Only letters and white space allowed";
						}
						}

						if($contact == "")
						{
							$er++;
							$econtact = "*Required";
						}
						else{
							$contact = test_input($contact);
							if(!preg_match("/^[+0-9]*$/",$contact)){
							$er++;
							$econtact = "*Only numbers are allowed";
							}
							
						}

						if($email == "")
						{
							$er++;
							$eemail = "*Required";
						}
						else
						{
							$email = test_input($email);
							if(!filter_var($email, FILTER_VALIDATE_EMAIL))
							{
								$er++;
								$eemail = "*Email format is invalid";
							}
							
						}

						if($address == "")
						{
							$er++;
							$eaddress = "*Required";
						}

						if($course == "")
						{
							$er++;
							$ecourse = "*Required";
						}

						

						 if (empty($gender)) {
						 	$er++;
						    $egender = "*Gender is required";
						  } else {
						    $gender = test_input($gender);
						  }

						
						
						if($er == 0)
						{					
							$sql = "INSERT INTO entity(sname, gname, contact, email, address, course, gender) VALUES (
							'".mysqli_real_escape_string($cn, strip_tags($sname))."',
							'".mysqli_real_escape_string($cn, strip_tags($gname))."', 
							'".mysqli_real_escape_string($cn, strip_tags($contact))."', 
							'".mysqli_real_escape_string($cn, strip_tags($email))."', 
							'".mysqli_real_escape_string($cn, strip_tags($address))."', 
							'".mysqli_real_escape_string($cn, strip_tags($course))."', 
							'".mysqli_real_escape_string($cn, strip_tags($gender))."'
							)";
							
							if(mysqli_query($cn , $sql))
							{
								print '<span class = "successMessage">Data saved into system.</span>';
								$sname = "";
								$gname = "";
								$contact = "";
								$email = "";
								$address = "";
								$course = "";
								$gender = "";
							
									
							}
							else
							{
								print '<span class= "errorMessage">'.mysqli_error($cn).'</span>';
							}
						}
						else
						{
							print '<span class = "errorMessage">Please fill all the required fields correctly.</span>';
						}
					}
					
					function test_input($data) {
					  $data = trim($data);
					  $data = stripslashes($data);
					  $data = htmlspecialchars($data);
					  return $data;
					}
					
//================================ PHP End =============================	
?>

<div class="form-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h3>Form</h3>
				</div>

				<div class="row">
					<div class="col-md-12">
						<form action="" method="post">
							<div class="row">
								<div class="col-md-6">
									<div class="left-side-form">
										<h5><label for="sname">First name</label>
										<span class="error"><?php print $esname; ?></span></h5>
										<p><input type="text" name="sname" value="<?php print $sname; ?>"></p>

										<h5><label for="gname">Last name</label><span class="error">
												<?php print $egname; ?></span></h5>
										<p><input type="text" name="gname" value="<?php print $gname; ?>"></p>

										<h5><label for="contact">Contact</label><span class="error">
												<?php print $econtact; ?></span></h5>
										<p><input type="text" name="contact" value="<?php print $contact; ?>"></p>

										<h5><label for="email">Email</label><span class="error">
												<?php print $eemail; ?></span></h5>
										<p><input type="text" name="email" value="<?php print $email; ?>"></p>

										<h5><label for="address">Address</label><span class="error">
												<?php print $eaddress; ?></span></h5>
										<p><textarea name="address"><?php print $address; ?></textarea></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="right-side-form">
										<h5><label for="class">Course</label><span class="error">
												<?php print $ecourse; ?></span></h5>
										<p><input type="text" name="course" value="<?php print $course; ?>"></p>


										<h5><label for="gender">Gender</label></h5>
										<input type="radio" name="gender" value="male"><span>Male</span>
										<input type="radio" name="gender" value="female"><span>Female</span>
										<input type="radio" name="gender" value="others"><span>Others</span>
										<span class="error">
											<?php print $egender; ?></span>

								
										
										<p><input type="submit" name="submit" value="Submit"></p>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

   

    <div>

		<p class="w3-xxxlarge w3-center"><span class="foot">&nbsp;&nbsp;</span></p>
		<div class="w3-pale-red">
			<br>
			<p class="w3-xxxlarge w3-center">
				<span class="foot">Contact Us</span>
			</p>
			<div class="w3-xxxlarge w3-center">
				<div class="w3-center footlink whats"><a href="https://wa.me/+919511846735" style="text-decoration: none"><i
							class="fa fa-whatsapp"></i></a></div>
				<div class="w3-center footlink face"><a href=https://www.facebook.com/vishwakarmauniversity/"" style="text-decoration: none"><i
							class="fa fa-facebook"></i></a></div>

				<div class="w3-center footlink tele"><a href="https://www.linkedin.com/school/vishwakarmauniversity/?originalSubdomain=in" style="text-decoration: none"><i
							class="fa fa-linkedin"></i></a></div>
				<div class="w3-center footlink insta"><a href="https://www.instagram.com/vishwakarmauniversity/" style="text-decoration: none"><i
							class="fa fa-instagram"></i></a></div>
				<div class="w3-center footlink mobi"><a href="tel:+919511846735" style="text-decoration: none"><i
							class="fa fa-mobile"></i></a></div>
			</div>
			<br>
		</div>
	</div>

</body>

</html>
