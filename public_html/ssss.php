[1:02 AM, 3/3/2021] Rafay Plug: <!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <title>Smart Reservation.pk</title>
    <link rel="stylesheet" href="../src/style.css">
    <link rel="stylesheet" href="../src/a_of_d.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
  

            
  <?php

if (isset($_GET['Chamber_id']) && $_GET['Chamber_id']!='') {
    include('config.php');
    $id=$_GET['Chamber_id'];
    //echo "connected";   
    $q = "SELECT * FROM chamber WHERE Chamber_id=".$id."";
    $result = mysqli_query($db, $q);
    $res = mysqli_fetch_all($result,MYSQLI_ASSOC);


 } 


?>

<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <title>Student Admission</title>
    <link rel="stylesheet" href="../src/style.css">
    <link rel="stylesheet" href="../src/add_res.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>

            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        
                    </div>
                </div>
                <!-- <div class="customers">                    
                    <div class="contact-left">
                        <h3>Current Information</h3>
                        <form action="">
                            <div class="input-row$row">
                                <div class="input-group">
                                    <label for="">St_code:</label>
                                    <input type="text" placeholder="0008751">
                                </div>
                                <div class="input-group">
                                    <label for="">Gr_Ncc</label>
                                    <input type="text" placeholder="C002261">
                                </div>
                                <div class="input-group">
                                    <label for="">Ac_Ncc</label>
                                    <input type="text" placeholder="00257">
                                </div>
                            </div>
                            <div class="input-row$row">
                                <div class="input-group">
                                    <label for="">Class:</label>
                                      <select name="cars" id="cars">
                                        <option value="volvo">1</option>
                                        <option value="saab">2</option>
                                        <option value="opel">3</option>
                                        <option value="audi">4</option>
                                        <option value="audi">5</option>
                                        <option value="audi">6</option>
                                        <option value="audi">7</option>
                                        <option value="audi">8</option>
                                        <option value="audi">9</option>                                        
                                      </select>
                                </div>
                                <div class="input-group">
                                    <label for="">Section:</label>
                                      <select name="" id="">
                                        <option value="">A</option>
                                        <option value="">B</option>
                                        <option value="">C</option>
                                        <option value="">D</option>
                                                                               
                                      </select>
                                </div>
                                <div class="input-group">
                                    <label for="">Shift:</label>
                                      <select name="" id="">
                                        <option value="">Morning</option>
                                        <option value="">Evening</option>
                                                                               
                                      </select>
                                </div>
                            </div>
                            <div class="input-row$row">
                                <div class="input-group">
                                    <label for="">Section:</label>
                                      <select name="" id="">
                                        <option value="">Primary</option>
                                        <option value="">Secondary</option>
                                                                               
                                      </select>
                                </div>
                        </form>
                    </div>
                </div>
<hr> -->


                <div class="customers">                    
                    <div class="contact-left">
                        <h3>Student Details</h3>
   <?php
      foreach($res as $row){
  
  ?>                  
                        <form action="">
                            <div class="input-row">
                                <div class="input-group">
                                    <label for="">Student Name</label>
                                    <input value="<?php echo $row['Chamber_id']; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="">Father/Guardian Name</label>
                                    <input value="<?php echo $row['Name']; ?>">                                </div>
                                <div class="input-group">
                                    <label for="">Gender:</label>
                                    <input value="<?php echo $row['Crop']; ?>">
                                </div>
                            </div>
                      <!-- <textarea name="" id="" cols="20" rows="3" value="<?php echo $row['msg_sms']; ?>"></textarea>
                            <a href="notification.php"><button>Submit</button></a>
                             -->
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