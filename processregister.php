<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
  }

  form {
    border: 3px solid #f1f1f1;
  }

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

<?php
 include_once 'DBConnection.php';
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
        $fname =  &$_REQUEST['firstName'];
        $lname = &$_REQUEST['lastName'];
        $email =  &$_REQUEST['emailAdd'];
        $username = &$_REQUEST['user_name'];
        $pass1 = &$_REQUEST['pass1'];
        $pass2= &$_REQUEST['pass2'];
        $usertype = &$_REQUEST['typeOfUser'];

        $sql = "SELECT * FROM tblusers WHERE emailAdd='$email'";
        $result = mysqli_query($conn, $sql);

        $sql1 = "SELECT * FROM tblusers WHERE user_name='$username'";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result) >0) {
          echo "<center><font color=red><b>There is already existing account associated with this email address associated</b></font></center>";
          include("frmregister.php");       
        }elseif(mysqli_num_rows($result1) >0){
          echo "<center><font color=red><b>Username is not available. Please select another username</b></font></center>";
          include("frmregister.php");
          
        } else if (strpos($email, 'usc.edu.ph') === false) {
            echo "<center><font color=red><b>Invalid email address. Please use an email address with @usc.edu.ph domain.</b></font></center>";
            include("frmregister.php");
        }
        else{
          if($_POST['emailAdd']==" "){
            echo "<center><font color=red><b>Please Complete all fields.</b></font></center>";
            include("frmregister.php");
          }else{
          if($pass1!=$pass2){
                 echo "<center><font color=red><b>Password mismatched!</b></font></center>";
                 include("frmregister.php");
          } 
         else
         {
          // $otp = rand(100000,999999);
          // $_SESSION['otp'] = $otp;
          // $_SESSION['mail'] = $email;
          // require "Mail/phpmailer/PHPMailerAutoload.php";
          // $mail = new PHPMailer;

          // $mail->isSMTP();
          // $mail->Host='smtp.gmail.com';
          // $mail->Port=587;
          // $mail->SMTPAuth=true;
          // $mail->SMTPSecure='tls';

          // $mail->Username='xameae@gmail.com';
          // $mail->Password='bwiinozvolukwnfw';

          // $mail->setFrom('xameae@gmail.com', 'OTP Verification');
          // $mail->addAddress($email);

          // $mail->isHTML(true);
          // $mail->Subject="Your verify code";
          // $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
          // <br><br>
          // <p>With regrads,</p>
          // <b>Programming with Lam</b>
          // https://www.youtube.com/channel/UCKRZp3mkvL1CBYKFIlxjDdg";

          //         if(!$mail->send()){
          //             ?>
          //                 <script>
          //                     alert("<?php echo "Register Failed, Invalid Email "?>");
          //                 </script>
          //             <?php
          //         }else{
          //             ?>
          //             <script>
          //                 alert("<?php echo "Register Successfully, OTP sent to " . $email ?>");
          //                 window.location.replace('verification.php');
          //             </script>
          //             <?php
          //         }
              $sql = "INSERT INTO tblusers(user_name,firstName,lastName,pass1,pass2,userType,emailAdd) VALUES ('$username','$fname',
             '$lname',md5('$pass1'),md5('$pass2'),'$usertype','$email')";
          
                 if(mysqli_query($conn, $sql)){
               
                     include("index.php");
                     echo '<div class="displayReg">'; 
                     echo "User: " .$fname." Successfully registered<br>";
                     echo "Name: ".$fname." ".$lname."<br>";
                     echo "Email: ". $email."<br>";
                     echo "Username: ".$username."<br>";
                     echo "User Type: ".$usertype."<br>";
              
                
                 } else{
                     echo "ERROR: Hush! Sorry $sql."
                     . mysqli_error($conn);
                     
                    echo '</div>'; 
         }
          
         // Close connection
         mysqli_close($conn);
         }
    
       
    }

        }





   
 ?>