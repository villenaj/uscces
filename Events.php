
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport">
<style>

.displayReg {
  width: 100%;
  padding: 12px 20px;
  margin: 0px 0px;
  display: flex;
  justify-content: center;
  border: 1px solid #ccc;
  box-sizing: border-box;
}


</style>
</head>
<body>

<div class="scrollit">
<table id="customers">
<tbody>
<?php
include("DBConnection.php");
?>





<?php
 
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
         
        // Taking all 7 values from the form data(input)
        $eventname =  &$_REQUEST['event'];
        $uid = &$_REQUEST['user_id'];
        $dateFrom =  &$_REQUEST['dateFrom'];
        $dateTo = &$_REQUEST['dateTo'];
        $timestart = &$_REQUEST['timestart'];
        $timeend= &$_REQUEST['timeend'];
        $details = &$_REQUEST['details'];
         
        // Performing insert 
        // here our table name is tblusers
   if($_REQUEST['event']=="" ){
           
           echo "<center><font color=red><b>Please Complete all fields.</b></font></center>";
   }else{
        
             $sql = "INSERT INTO tblevent(user_id,event_name,date_start,date_end,timestart,timeend,event_details) VALUES ('$uid','$eventname',
            '$dateFrom','$dateTo','$timestart','$timeend','$details')";
         if(!$sql){
          die(mysqli_error($conn));
        }
                if(mysqli_query($conn, $sql)){
                    include("MainPage.php");
               
                    echo '<div class="displayReg">'; 
                    echo "Event Name: " .$eventname."<br>";
                    echo "Start: ".$dateFrom." ".$timestart."<br>";
                    echo "End: ". $dateTo." ".$timeend."<br>";
                    echo "Details: ".$details."<br>";
                    echo "<a href='ViewEvents.php'>View Events</a>";
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=MainPage.php?pageid=Home\">";
             
               
                } else{
                    echo "ERROR: Hush! Sorry $sql."
                    . mysqli_error($conn);
                    
                   echo '</div>'; 
        }
         
        // Close connection
        mysqli_close($conn);
        }
   
      
   
 ?>
