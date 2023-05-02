<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
* {
  box-sizing: border-box;
  /* font: 1em sans-serif; */
  /* background-color: #ea952f; */
}
.welcome{
  margin-top: 8px;
  margin-bottom: 2px;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 2px;
  height: 450px; 
}

/* Clear floats after the columns */

.scrollit {
    overflow:scroll;
    height:500px;
    /* overflow-x: hidden; */
}
/* th{
    background-color: #ea952f;
} */
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

@media screen and (max-width: 600px){
	h2 {
    font-size: 10px;

}
/* .p1, .p2, .p3{
    font-size: 8px;

} */
.scrollit {
    overflow:scroll;
    height:550px;
    /* overflow-x: hidden; */
}
}
@media screen and (max-width: 800px){
	h2 {
    font-size: 14px;

}
/* .p1, .p2, .p3{
    font-size: 14px;

} */
.scrollit {
    overflow:scroll;
    height:500px;
    /* overflow-x: hidden; */
}
.welcome{
  margin-top: 8px;
  margin-bottom: 2px;
  font-size: 12px;
}
    

}
.buttonsub {
  background-color: #2eb82e;
  color: white;
  padding: 3px 2px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 30%;
  height: 10%
}
.buttonsub:hover {
  opacity: 0.8;
}
#calendar {
    width: 700px;
    margin: 0 auto;
}
.response {
    height: 60px;
}

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
}
</style>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>
</head>
<body>

<title>Events & Announcements</title>

<div class="row">
  <div class="column">
    <h2>Events</h2>
    <p>
    <div class="scrollit">
<table id="customers" class="cust" border=1>

  <body class="parent-cont">
    <div class="sidebar">
      <p>
      <?php
            include("DBConnection.php");
            
            if(mysqli_connect_errno()){
                    echo mysqli_connect_error();
                    exit();
            }else{
            $selectQuery = "SELECT EV.event_id,EV.event_name,EV.event_details,DATE_FORMAT(EV.date_start,'%Y-%b-%d %a %h:%i') AS date_start,EV.timestart,EV.date_end,EV.timeend,U.firstName,U.lastName,EV.user_id FROM tblevent EV LEFT JOIN tblusers U ON EV.user_id=U.user_id WHERE IsCancelled=False ORDER BY EV.date_start DESC";
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
                while($row = mysqli_fetch_assoc($result)){
                    $eventid=$row['event_id'];
                    echo '<div class="dialogbox">';
                      echo '<div class="body">';
                        echo '<span class="tip tip-left"></span>';
                        echo '<div class="message">';
                        echo '<span>Event: <font color="green">'.$row['event_name'].'</font><br>';
                        echo 'Venue/Details: '.$row['event_details'].'<br>';
                        echo 'Date & Time Start: <font color="maroon">'.$row['date_start'].":".$row['timestart'].'</font><br>';
                        echo 'Date & Time End: <font color="maroon">'.$row['date_end'].":".$row['timeend'].'</font><br>';
                        echo 'Posted by: <font color="blue">'.$row['firstName']." ".$row['lastName'].'</font><br>';
                        
                        $selectchecktype = "SELECT * FROM tblusers WHERE user_id=$user_id AND userType='Student'";
                        $resultchecktype = mysqli_query($conn,$selectchecktype);
                    

                        $selectcheck = "SELECT * FROM tblsubmission WHERE event_id=".$row['event_id']." AND uid=$user_id";
                        $resultcheck = mysqli_query($conn,$selectcheck);
                        
                        if(mysqli_num_rows($resultchecktype) > 0){
                         if(mysqli_num_rows($resultcheck) > 0){
                        echo '<a href="MainPage.php?pageid=FileSubmitForm&&event_id='. $row["event_id"].'"><font color="#ff3300">Already Registered to this event</font></a>';
                        }else{
                        echo '<a href="MainPage.php?pageid=JoinForm&&event_id='. $row["event_id"].'"><button class="buttonsub" type="submit" name="btnJoin"/>Join Event</a>';
                        }
                        }else{
                          //  echo ' <a href="ViewEvents.php"><font color="#ff3300">View Events</font></a>';
                          echo '<a href="MainPage.php?pageid=ViewSub&&event_id='. $row["event_id"].'"><font color="#ff3300">View Participants</font></a>';
                        }

                       
 
                        echo '</span>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                // echo '<div class="box1"><br><tbody><tr>';
                // //echo '<td>'.$row['event_id'].'</td>'; 
                // echo '<p class="p1">Event: <font color="green">'.$row['event_name'].'</font><br>';
                // echo 'Venue/Details: '.$row['event_details'].'<br>';
                // echo 'Date & Time Start: <font color="maroon">'.$row['date_start'].":".$row['timestart'].'</font><br>';  
                // echo 'Date & Time End: <font color="maroon">'.$row['date_end'].":".$row['timeend'].'</font><br>';
                // echo 'Posted by: <font color="blue">'.$row['firstName']." ".$row['lastName'].'</font>';
                // echo '</p></tr></tbody>'; 
                // echo '<p class="p3"><br>================================</p><br></div>'; 
            }
            
            
            ?>
      </p>
    </div>
    
  </body>
</table>
</html>
        </div>
    </p>
  </div>
  <div class="column">
    <h2>Announcements</h2>
    <p>
    <div class="scrollit">
<table id="customers" class="cust" border=1>

  <body class="parent-cont">
    <div class="sidebar">
      <p>
      <?php
            include("DBConnection.php");
            
            if(mysqli_connect_errno()){
                    echo mysqli_connect_error();
                    exit();
            }else{
            $selectQuery = "SELECT AN.ann_name,AN.ann_details,DATE_FORMAT(AN.dateposted,'%Y-%b-%d %a %h:%i %p') AS dateposted,U.firstName,U.lastName,AN.status,U.userType FROM tblannouncement AN LEFT JOIN tblusers U ON AN.uid=U.user_id WHERE AN.status=True ORDER BY AN.dateposted DESC";
            $result = mysqli_query($conn,$selectQuery);
            if(mysqli_num_rows($result) > 0){
            }else{
                $msg = "No Record found";
                }
            }

            
     ?>

            <?php
                while($row = mysqli_fetch_assoc($result)){
                 
                echo '<div class="dialogbox">';
                      echo '<div class="body">';
                        echo '<span class="tip tip-left"></span>';
                        echo '<div class="message">';
                        echo '<span><font color="blue" size="2" valign="left">'.$row['firstName']." ".$row['lastName'].'</font><br>';
                        echo 'Posted on <font color="maroon"> '.$row['dateposted'].'<br></font>';
                        echo '<font color="green">'.$row['userType'].'</font><br>';
                        echo '<font color="green"><b>'.$row['ann_name'].'</b><br></font>';
                        echo '<font color="black">'.$row['ann_details'].'</font>';
                      echo '</span>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';



                // echo '<div class="box2"><br><tbody><tr>';
                // //echo '<td>'.$row['event_id'].'</td>'; 
                // echo '<p class="p2">Announcement: <font color="green">'.$row['ann_name'].'</font><br>';
                // echo 'Details: '.$row['ann_details'].'<br>';
                // echo 'Date Posted: <font color="maroon"> '.$row['dateposted'].'<br></font>';  
                // echo 'Posted by: <font color="blue">'.$row['firstName']." ".$row['lastName'].'</font><br>';
                // echo '</p></tr></tbody>'; 
                // echo '<p class="p3"><br>================================</p><br></div>'; 
            }?>
      </p>
    </div>
  </body>
</table>
</html>
        </div>
    </p>
  </div>
</div>
</body>
</html>


<?php
 include("footer.php");
?>