<?php
include('config.php');
{
session_start();
    
    {   
       $admin_check = $_SESSION['admin_user'];
       
       $ses_sql = mysqli_query($db,"select username from login where username = '$admin_check' ");
       $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
       $login_session1 = $row['username'];
    
    echo $login_session1;
?>
<!-- <script>alert <?php //echo $login_session1;?></script> -->
<?php
    
       $count=0;
    
    $q = "SELECT * FROM `chamber`; ";
    
    
     $query = mysqli_query($db,$q);
    
     while($row3 = mysqli_fetch_array($query,MYSQLI_ASSOC)){
    $count=$count+1;
    // $login_session_chamberid= $row3['Chamber_id'];
     
    }
    
    
       
       $chamber_count_total = $count;
    
       $count1=0;
       $q1 = "SELECT * FROM `invest`; ";
    
    
       $query = mysqli_query($db,$q1);
      
       while($row4 = mysqli_fetch_array($query,MYSQLI_ASSOC)){
      $count1=$count1+1;
       }
      
      
         
         $chamber_invest_total = $count1;
    
         $count11=0;
       $q11 = "SELECT * FROM `farm`; ";
    
    
       $query = mysqli_query($db,$q11);
      
       while($row4 = mysqli_fetch_array($query,MYSQLI_ASSOC)){
      $count11=$count11+1;
       }
      
      
         
         $chamber_farm_total = $count11;
       }
    }
       session_write_close();
    