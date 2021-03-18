<?php
include('session1.php');

$chamber = $_SERVER['QUERY_STRING'];

// $page = $_SERVER['PHP_SELF'];
$sec = "15";
header("Refresh: $sec; url='./stream_chamber.php?$chamber'");
// echo "Watch the page reload itself in 10 second!";
?>
<?php


$host = 'localhost';
$uname = 'root';
$pword = '';
$mysqli = 'demo';


$mysqli = mysqli_connect($host, $uname, $pword, $mysqli);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// echo $login_sessionid;
//  $q = "select * from chamber ";

$chamber = $_SERVER['QUERY_STRING'];


$q = "SELECT * FROM stream_chamber WHERE Chamber_id='$chamber' ORDER BY Stream_id DESC 
    LIMIT 1";
$result = mysqli_query($mysqli, $q);
$res = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($res as $row) {

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
                    <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong><?php echo strtoupper(substr($login_session, 0, 1))
                                                                                                                    ?></strong><strong class="text-primary">D</strong></a></div>
                </div>
                <!-- Sidebar Navigation Menus-->
                <div class="main-menu">
                    <h5 class="sidenav-heading">Main</h5>
                    <ul id="side-main-menu" class="side-menu list-unstyled">
                        <li><a href="admin_dashboard.php"> <i class="icon-home"></i>Dashboard </a></li>
                        <li><a href="admin_clientinfo.php"> <i class="icon-form"></i>Client Details </a></li>
                        <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bar-chart"></i>Live Streaming </a>
                            <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                                <li><a href="admin_streamingchamber.php">Chamber</a></li>
                                <li><a href="admin_streaminginvest.php">Invesment</a></li>
                                <li><a href="admin_streamingfarm.php">Farming</a></li>
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
                                <!-- Log out-->
                                <li class="nav-item"><a href="logout.php" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <main>
                <!-- <h6>Take Our Services</h6> -->
                <div class="newArrivals">
                    <h1 class="ari">Live Streaming Of Chamber ID = <?php echo $chamber; ?></h1>
                    <h5 style="text-align: center; margin-top: -40px;">(Last Updated on <?php echo $row['Time']; ?>)</h5>
                    <br>
                </div>



                <table class="table">




                    <div class="input-row">
                        <div class="input-group">
                            <label for="">Date</label>
                            <label style="margin-left: 40px;"><b> <?php echo $row['Date']; ?></b></label>
                        </div>
                        <div class="input-group">
                            <label for="">Time</label>
                            <label style="margin-left: 40px;"><b> <?php echo $row['Time']; ?></b></label>
                        </div>
                        <div class="input-group">
                            <label for="">Temperature</label>
                            <label style="margin-left: 40px;"><b> <?php echo $row['Temperature']; ?>℃</b></label>
                        </div>
                        <div class="input-group">
                            <label for="">Humanidity</label>
                            <label style="margin-left: 40px;"><b> <?php echo $row['Humanidity']; ?>%</b></label>
                        </div>
                        <div class="input-group">
                            <label for="">Moisture</label>
                            <label style="margin-left: 40px;"><b> <?php echo $row['Moisture']; ?>%</b></label>
                        </div>
                        <div class="input-group">
                            <label for="">Intensity</label>
                            <label style="margin-left: 40px;"><b> <?php echo $row['Intensity']; ?>%</b></label>
                        </div>


                    </div>








                    <!-- <a href="notification.php"><button style="background-color: #F0420A">Delete</button></a> -->


                <?php } ?>

                


            </main>
        </div>
        <!-- JavaScript files-->
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