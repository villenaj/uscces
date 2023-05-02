<style>
.scrollit {
    /* overflow:scroll;
    height:450px; */
    /* overflow-x: hidden; */
 
}



.tip {
  width: 0px;
  height: 0px;
  position: absolute;
  background: transparent;
  border: 10px solid #ccc;
}
.tip-left {
  top: 10px;
  left: -25px;
  border-top-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;  
}
.body .message {
  min-height: 30px;
  border-radius: 3px;
  font-family: Arial;
  font-size: 10px;
  line-height: 1.5;
  color: #797979;

}
.dialogbox .body {
  position: relative;
  max-width: 300px;
  height: auto;
  margin: 20px 10px;
  padding: 5px;
  background-color: #DADADA;
  border-radius: 3px;
  border: 5px solid #ccc;
 ;
}
@media screen and (max-width: 500px) {
  .sidebar{
  margin-top: 50px;
}

}

</style>

<?php
    include("MainPage.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="ViewEvents.css" />  -->
    <title>Events</title>
  </head>
<center>
<div class="scrollit">
  <body class="parent-cont">
    <div class="sidebar">
      <p>
      <?php
            include("DBConnection.php");
            
            if(mysqli_connect_errno()){
                    echo mysqli_connect_error();
                    exit();
            }else{
            $selectQuery = "SELECT EV.event_id,EV.event_name,EV.event_details,EV.date_start,EV.timestart,EV.date_end,EV.timeend,U.firstName,U.lastName FROM tblevent EV LEFT JOIN tblusers U ON EV.user_id=U.user_id WHERE IsCancelled=False ORDER BY EV.date_start DESC";
            $result = mysqli_query($conn,$selectQuery);
            if(!$result){
              die(mysqli_error($conn));
            }
            if(mysqli_num_rows($result) > 0){
            }else{
                $msg = "No Record found";
                }
            }
     ?>
 
            <?php
             $userType=$_SESSION['userType'];
             $user_id=$_SESSION['user_id'];
            while($row = mysqli_fetch_assoc($result)){
              
               if($_SESSION['userType']=="CESCo" || $_SESSION['userType']=="CESRep"){
                    // echo '<tbody><div class="box"><tr>';
                    // //echo '<td>'.$row['event_id'].'</td>'; 
                    // echo 'Event: <font color="blue">'.$row['event_name'].'</font><br>';
                    // echo 'Venue/Details: '.$row['event_details'].'<br>';
                    // echo 'Date & Time Start: <font color="maroon">'.$row['date_start'].":".$row['timestart'].'</font><br>';  
                    // echo 'Date & Time End: <font color="maroon">'.$row['date_end'].":".$row['timeend'].'</font><br>';
                    // echo 'Posted by: <font color="blue">'.$row['firstName']." ".$row['lastName'].'</font><br>';
                    // echo '<a href="DeleteEvent.php?event_id='. $row["event_id"].'"><img src="delete1.jpg"></img></a>';
                    // echo '</tr></tbody>'; 
                    // echo '<br><br>==================================<br></div>'; 
                     echo '<div class="dialogbox">';
                      echo '<div class="body">';
                        echo '<span class="tip tip-left"></span>';
                        echo '<div class="message">';
                        echo '<span>Event: <font color="green">'.$row['event_name'].'</font><br>';
                        echo 'Venue/Details: '.$row['event_details'].'<br>';
                        echo 'Date & Time Start: <font color="maroon">'.$row['date_start'].":".$row['timestart'].'</font><br>';
                        echo 'Date & Time End: <font color="maroon">'.$row['date_end'].":".$row['timeend'].'</font><br>';
                        echo 'Posted by: <font color="blue">'.$row['firstName']." ".$row['lastName'].'</font><br>';
                        // echo '<a href="DeleteEvent.php?event_id='. $row["event_id"].'"><img src="delete1.jpg"></img></a>';
                        echo '<a href="MainPage.php?pageid=ViewSub&&event_id='. $row["event_id"].'">View Registered Participants</a>';
                        echo '</span>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                }
                  else{
                    // echo '<tbody><div class="box"><tr>';
                    // //echo '<td>'.$row['event_id'].'</td>'; 
                    // echo 'Event: <font color="blue">'.$row['event_name'].'</font><br>';
                    // echo 'Venue/Details: '.$row['event_details'].'<br>';
                    // echo 'Date & Time Start: <font color="maroon">'.$row['date_start'].":".$row['timestart'].'</font><br>';  
                    // echo 'Date & Time End: <font color="maroon">'.$row['date_end'].":".$row['timeend'].'</font><br>';
                    // echo 'Posted by: <font color="blue">'.$row['firstName']." ".$row['lastName'].'</font>';
                    // echo '</tr></tbody>'; 
                    // echo '<br><br>==================================<br></div>'; 
                     echo '<div class="dialogbox">';
                      echo '<div class="body">';
                        echo '<span class="tip tip-left"></span>';
                        echo '<div class="message">';
                        echo '<span>Event: <font color="green">'.$row['event_name'].'</font><br>';
                        echo 'Venue/Details: '.$row['event_details'].'<br>';
                        echo 'Date & Time Start: <font color="maroon">'.$row['date_start'].":".$row['timestart'].'</font><br>';
                        echo 'Date & Time End: <font color="maroon">'.$row['date_end'].":".$row['timeend'].'</font><br>';
                        echo 'Posted by: <font color="blue">'.$row['firstName']." ".$row['lastName'].'</font>';
                        echo '</span>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                  }  
                
            }?>
      </p>
    </div>
  </body>
</html>
</div>
</center>