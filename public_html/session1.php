<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from admin_login where username = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['username'];


   $ses_sql1 = mysqli_query($db,"select id from admin_login where username = '$user_check' ");
   $row1 = mysqli_fetch_array($ses_sql1,MYSQLI_ASSOC);
   $login_sessionid = $row1['id'];
   
  
  
   ?>
  
  <!-- <tr class="table-row">
   <td class="table-cell">  <?php// echo $row['Chamber_id'];  ?> </td>
   <td class="table-cell">  <?php// echo $row['Name'];  ?> </td>
   <td class="table-cell">  <?php// echo $row['Crop'];  ?> </td>
   <td class="table-cell">  <?php// echo $row['Amount'];  ?> </td> -->

   <?php
  
   // $login_session_chamberid= $row['Chamber_id'];
   // }
//    $q = "SELECT id FROM `chamber` WHERE Login_id='$login_sessionid' and Name=''; ";
//  $query = mysqli_query($db,$q);
//  $row2 = mysqli_fetch_array($query,MYSQLI_ASSOC);
//    $login_session_chamberid=$row2['Chamber_id'];


   $count=0;

$q = "SELECT * FROM `chamber`; ";


 $query = mysqli_query($db,$q);

 while($row3 = mysqli_fetch_array($query,MYSQLI_ASSOC)){
$count=$count+1;
// $login_session_chamberid= $row3['Chamber_id'];
 
}


   
   $chamber_count = $count;

   $count1=0;
   $q1 = "SELECT * FROM `invest`; ";


   $query = mysqli_query($db,$q1);
  
   while($row4 = mysqli_fetch_array($query,MYSQLI_ASSOC)){
  $count1=$count1+1;
   }
  
  
     
     $chamber_invest = $count1;

     $count11=0;
   $q11 = "SELECT * FROM `farm`; ";


   $query = mysqli_query($db,$q11);
  
   while($row4 = mysqli_fetch_array($query,MYSQLI_ASSOC)){
  $count11=$count11+1;
   }
  
  
     
     $chamber_farm = $count11;


   
   if(!isset($_SESSION['login_user'])){
      header("location:admin_login.php");
      die();
   }
?>