<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
?>
<style>
.welcome{
  margin-top: 8px;
  margin-bottom: 2px;
  font-size: 12px;
}
.scrollit {
    overflow:scroll;
    height:450px;
    /* overflow-x: hidden; */
}

th{
    background-color: #d9d9d9;
}
.cust{
     font-family: 'helvetica neue',helvetica,arial,'lucida grande',sans-serif;
     border-collapse: collapse;
  }
  .cust td{
     border: solid 1px #000000;
     padding: 3px;
     font-size: 12px;
     text-align: center;
  }
  .cust tr:nth-child(even){
     background-color: #FFFFFF;
     color: #D9E9FF;
  }
  .cust tr:nth-child(odd){
     background-color: #FFFFFF;
     color: #0060C7;
  }
  .cust tr{
     background-color: #FFFFFF;
     color: #D9E9FF;
  }
  .cust tr:hover{
     background-color: #b3ffb3;
     color: #000000;
  }
  .cust th{
     border: solid 1px #000000;
     padding: 10px;
     color: #000000;
     background-color: #d9d9d9;
     text-align: center;
     font-size: 12px;
  }
  a:link, a:visited {
  /* background-color: #f44336; */
  color: black;
  }
  @media screen and (max-width: 800px) {
    .cust td{
     border: solid 1px #000000;
     padding: 1px;
     font-size: 8px;
     text-align: center;
  }
  .cust tr:nth-child(even){
     background-color: #468ccf;
     color: #D9E9FF;
  }
  .cust tr:nth-child(odd){
     background-color: #00e600;
     color: #0060C7;
  }
  .cust tr{
     background-color: #468ccf;
     color: #D9E9FF;
  }
  .cust tr:hover{
     background-color: #FFFFFF;
     color: #000000;
  }
  .cust th{
     border: solid 1px #000000;
     padding: 4px;
     color: #0039e6;
     background-color: #ffa31a;
     text-align: center;
     font-size: 8px;
  }
  .scrollit {
    overflow:scroll;
    height:450px;
    /* overflow-x: hidden; */
}
.welcome{
  margin-top: 8px;
  margin-bottom: 2px;
  font-size: 12px;
}
}
.imgicon{
  height: 15px;
  width: 15px;
  margin-left: 5px;
}


</style>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="ViewEvents.css" />  -->
    <title>Files Submitted</title>
  </head>
<center>
          <input type="hidden" name="action">
<?php
$action=&$_GET['action'];
?>
  <?php
  $selectQuery1 = "SELECT EV.event_id,EV.event_name,EV.event_details,EV.date_start,
                            EV.timestart,EV.date_end,EV.timeend,U.firstName,U.lastName,SU.file_attached,
                            SU.Points 
                            FROM tblsubmission SU LEFT JOIN tblevent EV ON SU.event_id=EV.event_id 
                            LEFT JOIN tblusers U ON U.user_id=SU.uid WHERE IsCancelled=False AND EV.event_id=".$_GET['event_id']."";
          // $selectQuery = "SELECT S.file_id,S.file_desc,S.file_details,S.file_attached,S.file_attachedA,S.file_attachedB,S.file_attachedC,S.date_posted,U.firstName,U.lastName,S.Points,S.rateby_id,S.isApproved  FROM tblsubmission S LEFT JOIN tblusers U ON S.uid=U.user_id ORDER BY S.date_posted DESC";
          $result1 = mysqli_query($conn,$selectQuery1);
          if($result1){
             $eventname='No Participants';
          }
          $count=0;
          while($row1 = mysqli_fetch_assoc($result1)){
            $count+=1;
                  $pnts=$row1['Points'];
                  $event_id=$row1['event_id'];
                  if($row1['event_name']==''){
                      $eventname='No Participants';
                  }else{
                      $eventname=$row1['event_name'];
                  }
          }
          ?>

<div class="scrollit">
  <a href='ViewEvents.php'>View Events</a>
<table id="customers" class="cust" border=1>
  <form name="frmtable" method="post">
  <?php
    if($count>0){
      echo '<tr><td colspan="6"  style="text-align:left"><input type="number" name="Points" id="Points" min=0>';
      echo '<input type="submit" name="btnupdate" id="btnupdate" value="Credit Points">';
      echo '</td></tr>';
    }else{

    }
  ?>
  

  <tr><td colspan="6" style="text-align:left"><?php echo '<font color="red">Event/Activity:</font> <font color="blue">'.$eventname.'</font>'; ?></td></tr>
  <tr>  
                
                <th>Seq.</th>
                <th>Name</th>
                <th>Actual Attendance</th>
                <th>Attachment/Reflection</th>
                <th>Points</th>
                <th>Evaluate</th>
                <!-- <th>Date Submitted</th>
                <th>Submitted By:</th>
                <th>Points</th>
                <th>Status</th>
                <th>Rated by:</th> -->
                <!-- <th>Downloads:</th> -->
               
 </tr>
 
  <body class="parent-cont">
    <div class="sidebar">
      <p>
      <?php
       include("DBConnection.php");
      $userType=$_SESSION['userType'];
      $user_id=$_SESSION['user_id'];
      if($_SESSION['userType']=="Student"){
        if(mysqli_connect_errno()){
          echo mysqli_connect_error();
          exit();
          }else{
          // $selectQuery = "SELECT S.file_id,S.file_desc,S.file_details,S.file_attached,S.date_posted,U.firstName,U.lastName,S.Points,S.rateby_id,S.isApproved FROM tblsubmission S LEFT JOIN tblusers U ON S.uid=U.user_id WHERE U.user_id=$user_id  ORDER BY S.date_posted DESC";
          $selectQuery = "SELECT EV.event_id,EV.event_name,EV.event_details,EV.date_start,
                            EV.timestart,EV.date_end,EV.timeend,U.firstName,U.lastName,SU.file_attached,SU.uid,
                            SU.attendance,SU.Points
                            FROM tblsubmission SU LEFT JOIN tblevent EV ON SU.event_id=EV.event_id 
                            LEFT JOIN tblusers U ON U.user_id=SU.uid WHERE U.user_id=$user_id  ORDER BY SU.date_posted DESC"; 
          $result = mysqli_query($conn,$selectQuery);
          if(mysqli_num_rows($result) > 0){
          }else{
          $msg = "No Record found";
        }
      }
    }
      else{
        if(mysqli_connect_errno()){
          echo mysqli_connect_error();
          exit();
          }else{
          $selectQuery = "SELECT EV.event_id,EV.event_name,EV.event_details,EV.date_start,
                            EV.timestart,EV.date_end,EV.timeend,U.firstName,U.lastName,SU.file_attached,SU.uid,
                            SU.attendance,SU.Points
                            FROM tblsubmission SU LEFT JOIN tblevent EV ON SU.event_id=EV.event_id 
                            LEFT JOIN tblusers U ON U.user_id=SU.uid WHERE IsCancelled=False AND EV.event_id=".$_GET['event_id'].""; 
          // $selectQuery = "SELECT S.file_id,S.file_desc,S.file_details,S.file_attached,S.file_attachedA,S.file_attachedB,S.file_attachedC,S.date_posted,U.firstName,U.lastName,S.Points,S.rateby_id,S.isApproved  FROM tblsubmission S LEFT JOIN tblusers U ON S.uid=U.user_id ORDER BY S.date_posted DESC";
          $result = mysqli_query($conn,$selectQuery);
          if(!$result){
            die(mysqli_error($conn));
          }
          if(mysqli_num_rows($result) > 0){
          }else{
          $msg = "No Record found";
        }
      }
      }       
     ?>
    
            <?php
            $dir="uploads/";
            $count=0;
                while($row = mysqli_fetch_assoc($result)){
                  $count+=1;
                  $eventid=$row['event_id'];
                  $uid=$row['uid'];
                  $points=$row['Points'];
                   if ($row['attendance'] == 1){
                    $status = "checked";
                    }elseif($row['attendance'] == 0){
                    $status = "";
                  }
                echo '<tbody><tr>';
                echo '<td>'.$count.'</td>';
                echo '<td><font color="black"><font color="black"><a href="MainPage.php?pageid=ViewSub&action=select&event_id='.$eventid.'&uid='.$uid.'">'.$row['firstName']." ".$row['lastName'].'</a></font></td>';
                echo '<td><input type="checkbox" name="attendance" id="viewed" value="'.$row['attendance'].'" '.$status.'></td>';
                // echo '<td><a href="UpdateSubmission.php?file_id='. $row["file_id"].'">'.$row['file_desc'].'</a></td>';
                // echo '<td>'.$row['file_desc'].'</td>';
                // echo '<td><font color="black">'.$row['file_details'].'</font></td>';
                // echo '<td><font color="black"><a href='.$dir.$row['file_attached'].'>'.$row['file_attached'].'</font></a><br><a href="Download.php?path='.$dir.$row['file_attached'].'">Download</a></td>';
                echo '<td><font color="black"><a href='.$dir.$row['file_attached'].'>'.$row['file_attached'].'</font></a><br><a href="Download.php?path='.$dir.$row['file_attached'].'">';
                if($row['file_attached']===""){
                  echo "";
                 }else{
                   echo "Download";}
                echo '</a></td>';

                // echo '<td><font color="black"><a href='.$dir.$row['file_attachedB'].'>'.$row['file_attachedB'].'</font></a><br><a href="Download.php?path='.$dir.$row['file_attachedB'].'">';
                // if($row['file_attachedB']===""){
                //   echo "";
                //  }else{
                //    echo "Download";}
                // echo '</a></td>';
                // echo '<td><font color="black"><a href='.$dir.$row['file_attachedC'].'>'.$row['file_attachedC'].'</font></a><br><a href="Download.php?path='.$dir.$row['file_attachedC'].'">'; 
                // if($row['file_attachedC']===""){
                //   echo "";
                //  }else{
                //    echo "Download";}
                // echo '</a></td>';
                // echo '<td><font color="black"><font color="black">'.$row['date_posted'].'</font></td>';
                
                // echo '<td><font color="blue">'.$row['uid'].'</font></td>';

                // if($_SESSION['userType']=="Student"){
                //   echo '<td><font color="#e62e00">"--"</font></td>';
                  
                // }
                //   else{
                //     echo '<td><font color="#e62e00">'.$row['Points'].'</font></td>';
                //   }


                // echo '<td>'.$row['isApproved'].'</td>';    
                
                // echo '<td>'.$row['rateby_id'].'</td>';
                // echo '<td><a href="Download.php?path='.$dir.$row['file_attached'].'">Download File</a></td>';
                // echo '<td><input type="checkbox" name="points"></td>';
                // echo '<td><input type="number" name="points" min=0 value='.$points.'></td>';
                echo '<td>'.$points.'</td>';
                echo '<td><a href="MainPage.php?pageid=ViewSub&action=update&event_id='.$eventid.'&uid='.$uid.'" onclick="enable()"><img src="confirm.png" class="imgicon"></img></a>
                <a href="MainPage.php?pageid=ViewSub&action=cancel&event_id='.$eventid.'&uid='.$uid.'"><img src="delete.png" class="imgicon"></img></a><br></td>';
                echo '</form></tr></tbody>'; 
            }?>

            <?php
            $pointsMe = &$_POST['Points'];
            if(($_GET['pageid'] == 'ViewSub') && isset($_POST['btnupdate']) && isset($_GET['event_id'])){
            // $my_checkbox = (empty($_POST['attendance'])) ? 1 : 0;
            // $points=$_POST['points'];
            if(isset($_GET['uid'])!=""){
            $sqls = "UPDATE tblsubmission SET isApproved='Approved',Points='$pointsMe',rateby_id='$user_id' WHERE event_id =".$_GET['event_id']." AND uid=".$_GET['uid']."";
            $result12 = $conn->query($sqls);
            $resultB12 =mysqli_affected_rows($conn); 
            date_default_timezone_set('Asia/Manila');
            $dateposted = date("Y-m-d H:i:s");
            $postedby= $_SESSION['user_id'];
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=MainPage.php?pageid=ViewSub&event_id=".$eventid."\">";
            }else{
            echo "<font color=red>Please select student name!</font>";
            }
           
          }
        ?>
            <?php
            $pointsMe1 = &$_POST['Points'];
            if(($_GET['pageid'] == 'ViewSub') && ($_GET['action'] == 'update') && isset($_GET['event_id'])  && isset($_GET['uid'])){
            // $my_checkbox = (empty($_POST['attendance'])) ? 1 : 0;
            // $points=$_POST['points'];
            $sqls = "UPDATE tblsubmission SET attendance=1 WHERE event_id =".$_GET['event_id']." AND uid=".$_GET['uid']."";
            $result12 = $conn->query($sqls);
            $resultB12 =mysqli_affected_rows($conn); 
            date_default_timezone_set('Asia/Manila');
            $dateposted = date("Y-m-d H:i:s");
            $postedby= $_SESSION['user_id'];
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=MainPage.php?pageid=ViewSub&event_id=".$eventid."&uid=".$_GET['uid']."\">";
          }
        ?>
         <?php
            //  $points = &$_GET['points'];
            if(($_GET['pageid'] == 'ViewSub') && ($_GET['action'] == 'cancel') && isset($_GET['event_id'])  && isset($_GET['uid'])){
            // $my_checkbox = (empty($_POST['attendance'])) ? 1 : 0;
            $sqlsD = "UPDATE tblsubmission SET attendance=0,isApproved='For Approval',Points=0 WHERE event_id =".$_GET['event_id']." AND uid=".$_GET['uid']."";
            $result12D = $conn->query($sqlsD);
            $resultB12D =mysqli_affected_rows($conn); 
            date_default_timezone_set('Asia/Manila');
            $dateposted = date("Y-m-d H:i:s");
            $postedby= $_SESSION['user_id'];
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=MainPage.php?pageid=ViewSub&event_id=".$eventid."&uid=".$_GET['uid']."\">";
          }
        ?>
        <?php
            //  $points = &$_GET['points'];
            if(($_GET['pageid'] == 'ViewSub') && ($_GET['action'] == 'select') && isset($_GET['event_id'])  && isset($_GET['uid'])){
            // $my_checkbox = (empty($_POST['attendance'])) ? 1 : 0;
            // $sqlsD = "UPDATE tblsubmission SET attendance=0,Points=0 WHERE event_id =".$_GET['event_id']." AND uid=".$_GET['uid']."";
            // $result12D = $conn->query($sqlsD);
            // $resultB12D =mysqli_affected_rows($conn); 
            // date_default_timezone_set('Asia/Manila');
            // $dateposted = date("Y-m-d H:i:s");
            // $postedby= $_SESSION['user_id'];
            echo '<td colspan="6"  style="text-align:left"><input type="text" name="uid" value='.$_GET["uid"].' min=0></td>';
           // echo "<meta http-equiv=\"refresh\" content=\"0;URL=MainPage.php?pageid=ViewSub&event_id=".$eventid."&uid=".$_GET['uid']."\">";
          }
        ?>
        
        <script type="text/javascript">
  function enable(){
    document.getElementById("btnupdate").disabled = true;   

    
}
  </script>
</form>
</html>
</div>
</center>
