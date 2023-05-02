<style>
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
.scrollit {
    overflow:scroll;
    height:450px;
    /* overflow-x: hidden; */
}
@media screen and (max-width: 800px){
.scrollit {
    overflow:scroll;
    height:350px;
    /* overflow-x: hidden; */
}
    

}

.cust{

  /* width: 100%;
  padding: 12px 20px;
  margin: 0px 0px;
  display: flex;
  justify-content: center;
  border: 1px solid #ccc;
  box-sizing: border-box */
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
    <title>Announcement</title>
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
            $selectQuery = "SELECT AN.ann_id,AN.ann_name,AN.ann_details,AN.dateposted,U.firstName,U.lastName,AN.status,U.userType FROM tblannouncement AN LEFT JOIN tblusers U ON AN.uid=U.user_id WHERE AN.status=True ORDER BY AN.dateposted DESC";
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
                // echo 'Announcement: <font color="blue">'.$row['ann_name'].'</font><br>';
                // echo 'Announcement Details: '.$row['ann_details'].'<br>';
                // echo 'Date Posted: <font color="maroon"> '.$row['dateposted'].'<br></font>';  
                // echo 'Posted by: <font color="blue">'.$row['firstName']." ".$row['lastName'].'</font><br>';
                // echo '<a href="DeleteAnnouncement.php?ann_id='. $row["ann_id"].'"><img src="delete1.jpg"></img></a>';
                // echo '</tr></tbody>'; 
                // echo '<br><br>==================================</div>'; 
                echo '<div class="dialogbox">';
                      echo '<div class="body">';
                        echo '<span class="tip tip-left"></span>';
                        echo '<div class="message">';
                        echo '<span><font color="blue" size="2" valign="left">'.$row['firstName']." ".$row['lastName'].'</font><br>';
                        echo 'Posted on <font color="maroon"> '.$row['dateposted'].'<br></font>';
                        echo '<font color="green">'.$row['userType'].'</font><br>';
                        echo '<font color="green"><b>'.$row['ann_name'].'</b><br></font>';
                        echo '<font color="black">'.$row['ann_details'].'</font><br>';
                        echo '<a href="DeleteAnnouncement.php?ann_id='. $row["ann_id"].'"><img src="delete1.jpg"></img></a>';
                      echo '</span>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                }else{
                    // echo '<br><tbody><div class="box"><tr>';
                    // //echo '<td>'.$row['event_id'].'</td>'; 
                    // echo 'Announcement: <font color="blue">'.$row['ann_name'].'</font><br>';
                    // echo 'Announcement Details: '.$row['ann_details'].'<br>';
                    // echo 'Date Posted: <font color="maroon"> '.$row['dateposted'].'<br></font>';  
                    // echo 'Posted by: <font color="blue">'.$row['firstName']." ".$row['lastName'].'</font><br>';
                    // echo '</tr></tbody>'; 
                    // echo '<br><br>==================================</div>'; 
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
                  }
   
            }?>
      </p>
    </div>
  </body>
</table>
</html>

     
    
        </div>
        </center>