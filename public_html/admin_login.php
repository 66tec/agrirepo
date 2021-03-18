<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM admin_login WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	//   $rowid = mysqli_fetch_row($result,MYSQLI_ASSOC);


    //   $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        //  session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         $_SESSION['login_id'] = $id1;
         
         header("location: admin_dashboard.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="admin_login.css">
<link rel="stylesheet" href="header.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
	<title>Login Page</title>
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



if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
   // username and password sent from form 
   
   $myusername = mysqli_real_escape_string($mysqli,$_POST['user']);
   $mypassword = mysqli_real_escape_string($mysqli,$_POST['pass']);
   $a="axc"; 


   $sql = "SELECT id FROM admin_login WHERE username = '$myusername' and password = '$mypassword'";

   $result = mysqli_query($mysqli,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $count = mysqli_num_rows($result);
   
//    $uuu = mysqli_num_rows($result);

    //If result matched $myusername and $mypassword, table row must be 1 row
     
   if($count == 1) {
     // session_register("myusername");
      $_SESSION['login_user'] = $myusername;
       $a=$_SESSION['login_user'];
      header("location: ./admin_dashboard.php");
    //   publi/c $a=$myusername;
   }else {
	echo "<script>alert('Your Login Name or Password is invalid');</script>";
	echo "<script>location.replace('./admin_login.php');</script>";

	   
      $error = "Your Login Name or Password is invalid";
   }
}
?>


<body>
	<div class="a">
	<div class="container">


			<div class="d-flex justify-content-center h-100">
				<div class="card">
					<div class="card-header">
						<h3>Admin Panel</h3>
					
					</div>
					<div class="card-body">
						<form method="POST">
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input name="user" type="text" class="form-control" placeholder="username">

							</div>
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input name="pass" required type="password" class="form-control" placeholder="password">
							</div>

							<div class="form-group">
								<input name="login" required type="submit" value="Login" class="btn float-right login_btn">
							</div>
						</form>
					</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="app.js"></script>
</body>

</html>