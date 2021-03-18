<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="signup.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Signup Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<?php
 


$host = 'localhost';
$uname = 'root';
$pword = '';
$mysqli = 'demo';


$mysqli = mysqli_connect($host,$uname,$pword,$mysqli);
// Check connection
if (mysqli_connect_errno())
  {

	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else{

  }



    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST["signup"])){
    $user = mysqli_real_escape_string ($mysqli,$_POST['user']);
    $email = mysqli_real_escape_string ($mysqli,$_POST['email']);
    $phone = mysqli_real_escape_string ($mysqli,$_POST['phone']);
    $pass = mysqli_real_escape_string ($mysqli,$_POST['pass']);
    $pass2 = mysqli_real_escape_string ($mysqli,$_POST['pass2']);
	if($pass!=$pass2)
	{
		echo "<script>alert('Enter same password');</script>";
	}
	else{
           $result=mysqli_query ($mysqli,"SELECT * FROM `login`");
       
           if (mysqli_num_rows($result) < 0) {
            echo "<script>alert('Could Not Perform the Query');</script>";
          }
      
      
          else {
            $sql = "INSERT INTO login (`username`, `password`, `Email`, `phone`) VALUES ('$user', '$pass', '$email', '$phone')";
            if ($mysqli->query($sql) === TRUE) {
              echo "<script>alert('New record created successfully');</script>";
			  header("location: ./login.php");
            
            } else {
				
            //   echo  $mysqli->error;
			  ?>
			  <script>alert("Name Already Exist");</script>
		  <?php

            }
        }
          
    }
}
       
    ?>

<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign Up</h3>
				<!-- <div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div> -->
			</div>
			<div class="card-body">
				<form method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input name="user" required type="text" class="form-control" placeholder="username">
						
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-phone"></i></span>
						</div>
						<input name="phone" required type="tel" class="form-control" placeholder="Phone">
						
					</div>
					
					<!-- <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-users"></i></span>
						</div>
						<select class="custom-select" id="inputGroupSelect01">
						  <option selected>Choose...</option>
						  <option value="1">Admin</option>
						  <option value="2">User</option>
						</select>
					  </div> -->
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-envelope"></i></span>
						</div>
						<input name="email" required type="email" class="form-control" placeholder="Email">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input name="pass" required type="password" class="form-control" placeholder="Password">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input name="pass2" required type="password" class="form-control" placeholder="Re-Enter">
					</div>
					
					<div class="form-group">
						<input name="signup" type="submit" value="Sign Up" class="btn float-right login_btn">
					</div>
				</form>
			</div>

	</div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="app.js"></script>
</body>
</html>