<?php
//if(isset($_POST['name'])){
$subject = $_POST['subject'];


//}

  $conn = new mysqli("localhost:3307","root","","my_tutor");
  if($conn->connect_error){
    die("failed to connect : ".$con->connect_error);
  }else{
    $sql = "SELECT *  FROM search WHERE subject='$subject' ";

	    $result = $conn->query($sql);

	    if ($result->num_rows > 0) {
    	// output data of each row

	    while($row = $result->fetch_assoc()) {?>
		    <div class="col-md-3">

		 

			<p><span> Teacher Name : </span><?php echo $row["name"] ?></p>
			<p><span> Subject: </span><?php echo $row["subject"] ?></p>
			<p><span> Location:</span> <?php echo $row["location"] ?></p>
			

		

		    </div>

            <?php 
         }
      } 
  }

  ?>