<?php
include('session.php');
?>
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
    //    echo "connected";
   }
 
 
 
     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST["submit"])){
     $Name = mysqli_real_escape_string ($mysqli,$_POST['Name']);
     $Crop = mysqli_real_escape_string ($mysqli,$_POST['Crop']);
     $Amount = mysqli_real_escape_string ($mysqli,$_POST['Amount']);
     $Phone = mysqli_real_escape_string ($mysqli,$_POST['Phone']);
    //  $pass2 = mysqli_real_escape_string ($mysqli,$_POST['pass2']);
    //  if($pass!=$pass2)
    //  {
    //      echo "<script>alert('Enter same password');</script>";
    //  }
     {
            $result=mysqli_query ($mysqli,"SELECT * FROM `chamber`");
        
            if (mysqli_num_rows($result) < 0) {
             echo "<script>alert('Could Not Perform the Query');</script>";
           }
       
       
           else {
             $sql = "INSERT INTO chamber (`Name`, `Crop`, `Amount`, `Phone`, `Login_id`) VALUES ('$Name', '$Crop', '$Amount', '$Phone' , '$login_sessionid')";
             if ($mysqli->query($sql) === TRUE)
              {
               echo "<script>alert('Purchase Chamber sucessfully');</script>";
               header("location: ./indexfinal.php");
             
             } else {
                 
             //   echo  $mysqli->error;
 
             }
         }
           
     }
 }
        
     ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bootstrap Dashboard by Bootstrapious.com</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="./style12.css">
    <link rel="stylesheet" href="./streamingchamber.css">


    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css12/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css12/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css12/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css12/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <div class="side-navbar-wrapper">
            <!-- Sidebar Header    -->
            <div class="sidenav-header d-flex align-items-center justify-content-center">
                <!-- User Info-->
                <!-- <?php
                        echo substr("Hello world", 6);
                        ?> -->

                <div class="sidenav-header-inner text-center"><i style="font-size: xxx-large; color: #33b35a ;" class="fa fa-user-circle img-fluid rounded-circle" aria-hidden="true"></i>
                    <h2 class="h5">Welcome <?php echo $login_session; ?></h2>
                </div>
                <!-- Small Brand information, appears on minimized sidebar-->
                <div class="sidenav-header-logo"><a href="indexfinal.php" class="brand-small text-center"> <strong><?php echo strtoupper(substr($login_session, 0, 1))
                                                                                                                ?></strong><strong class="text-primary">D</strong></a></div>
            </div>
            <!-- Sidebar Navigation Menus-->
            <div class="main-menu">
                <h5 class="sidenav-heading">Main</h5>
                <ul id="side-main-menu" class="side-menu list-unstyled">
                    <li><a href="indexfinal.php"> <i class="icon-home"></i>Dashboard </a></li>
                    <li><a href="services.php"> <i class="icon-form"></i>Services </a></li>
                    <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bar-chart"></i>Live Streaming </a>
                        <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                            <li><a href="streamingchamber.php">Chamber</a></li>
                            <li><a href="streaminginvest.php">Invesment</a></li>
                            <li><a href="streamingfarm.php">Farming</a></li>
                        </ul>
                    </li>
                    <li><a href="logout.php"> <i class="icon-grid"></i>Logout </a></li>
                    <!-- <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li> -->
                    <!-- <li><a href="login.html"> <i class="icon-interface-windows"></i>Login page                             </a></li>
            <li> <a href="#"> <i class="icon-mail"></i>Demo
                <div class="badge badge-warning">6 New</div></a></li>
          </ul>
        </div>
        <div class="admin-menu">
          <h5 class="sidenav-heading">Second menu</h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled"> 
            <li> <a href="#"> <i class="icon-screen"> </i>Demo</a></li>
            <li> <a href="#"> <i class="icon-flask"> </i>Demo
                <div class="badge badge-info">Special</div></a></li>
            <li> <a href=""> <i class="icon-flask"> </i>Demo</a></li>
            <li> <a href=""> <i class="icon-picture"> </i>Demo</a></li>
          </ul> -->
            </div>
        </div>
    </nav>
    <div class="page">
        <!-- navbar-->
        <header class="header">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-holder d-flex align-items-center justify-content-between">
                        <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="indexfinal.php" class="navbar-brand">
                                <div class="brand-text d-none d-md-inline-block"><span><?php echo $login_session; ?> &nbsp; </span><strong class="text-primary">Dashboard</strong></div>
                            </a></div>
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

                            <!-- Messages dropdown-->
                            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                                <!-- Notifications dropdown-->
                                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-warning">12</span></a>
                                    <ul aria-labelledby="notifications" class="dropdown-menu">
                                        <li><a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                    <div class="notification-content"><i class="fa fa-envelope"></i>You have 6 new messages </div>
                                                    <div class="notification-time"><small>4 minutes ago</small></div>
                                                </div>
                                            </a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                    <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                                                    <div class="notification-time"><small>4 minutes ago</small></div>
                                                </div>
                                            </a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                    <div class="notification-content"><i class="fa fa-upload"></i>Server Rebooted</div>
                                                    <div class="notification-time"><small>4 minutes ago</small></div>
                                                </div>
                                            </a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                    <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                                                    <div class="notification-time"><small>10 minutes ago</small></div>
                                                </div>
                                            </a></li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view all notifications </strong></a></li>
                                    </ul>


                                    <!-- Messages dropdown-->

                            </ul>
                            <!-- Log out-->
                            <li class="nav-item"><a href="logout.php" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main>
        <div class="newArrivals">
     
     <h1 class="ari">Required Information </h1>
 </div>
 
        <table style=" margin: 0 auto;" >
        <form method="POST" >
        <tr>
        <td>

  <div class="form-group">
    <label for="exampleDropdownFormEmail2">Name</label>
    <input type="text" class="form-control" name="Name" id="exampleDropdownFormEmail2" placeholder="Name Of Chamber">
  </div>
  <div class="form-group">
    <!-- <label for="exampleDropdownFormPassword2">Crop</label> -->
    <!-- <input type="text" class="form-control" name="crop" id="exampleDropdownFormPassword2" placeholder="Crop name"> -->

    <div class="form-group">
  <label for="sel1">Crop</label>
  <select style="font-size: 13px;" class="form-control" name="Crop" id="sel1">
  <option selected>Open this select menu</option>
    <option>Salad Leave</option>
    <option>Tomato</option>
    <option>Mint</option>
    <option>Onion</option>
  </select>
</div>

  </div>
  <div class="form-group">
    <label for="exampleDropdownFormEmail2">Amount</label>
    <input type="number" class="form-control" name="Amount" id="exampleDropdownFormEmail2" placeholder="Amount">
  </div>
  <div class="form-group">
    <label for="exampleDropdownFormPassword2">Phone</label>
    <input type="text" class="form-control" name="Phone" id="exampleDropdownFormPassword2" placeholder="Phone">
  </div>
  <br>
  <button  type="submit" style="color: blanchedalmond;" class="btn btn-dark form-control" name="submit">Submit</button>
<!-- </form> -->
        </td>
        </tr>
        
        
        
        
        </form>
        
        </table>
        
        
         
        </main>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
        <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
        <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="js/charts-home.js"></script>
        <!-- Main File-->
        <script src="js/front.js"></script>
</body>

</html>