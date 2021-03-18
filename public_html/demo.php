<?php
// include('streamingchamber.php');
include('session.php');
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


//   $q = "SELECT Chamber_id FROM `chamber` WHERE Login_id='$login_sessionid'; ";
//   $query = mysqli_query($mysqli,$q);
//   $row = mysqli_fetch_array($query);

$chamber = $_SERVER['QUERY_STRING'];
echo $_SERVER['QUERY_STRING'];



// echo $login_session_chamberid;

$q = "SELECT * FROM stream_chamber WHERE Chamber_id='$chamber' ORDER BY Stream_id DESC 
    LIMIT 1";
$result = mysqli_query($mysqli, $q);
$res = mysqli_fetch_all($result, MYSQLI_ASSOC);




//  } 

?>

<!DOCTYPE php>
<php lang="en">

    <head>

        <link rel="stylesheet" href="./stylez.css">
        <link rel="stylesheet" href="./add_res.css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
        <title>Student Admission</title>
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    </head>

    <body>
        <main>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">

                    </div>
                </div>

                <?php
                foreach ($res as $row) {

                ?>
                    <form action="">
                        <div class="input-row">
                            <div class="input-group">
                                <label for="">Date</label>
                                <input value="<?php echo $row['Date']; ?>">
                            </div>
                            <div class="input-group">
                                <label for="">Time</label>
                                <input value="<?php echo $row['Time']; ?>">
                            </div>
                            <div class="input-group">
                                <label for="">Temperature:</label>
                                <input value="<?php echo $row['Temperature']; ?>">
                            </div>
                        </div>








                        <!-- <a href="notification.php"><button style="background-color: #F0420A">Delete</button></a> -->
                    </form>

                <?php } ?>
            </div>
            </div>
            </div>
        </main>
        <!-- </div> -->
    </body>
</php>