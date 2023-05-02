
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport", initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;
height: 400px;
width: 350px;
border-radius: 25px;
background: linear-gradient(-45deg, #66ff66,#00e600,#00b300,#ccffeb,#006600);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;

}
@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

input[type=text], input[type=password] {
  width: 80%;
  padding: 12px 20px;
  margin: 8px 8px 8px 8px;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 15px;
  align-items: center;
  
}

button {
  background-color: #0341fc;
  color: white;
  padding: 12px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 80%;
  border-radius: 15px;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: 80%;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}
.myLogo{
    width: 60px; 
    height: 60px;
    margin-top: 30px;
}


span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

</style>
</head>
<body>
<title>USC Community Extension Services</title>
<center>
<img class="myLogo" src="University_of_San_Carlos_logo.png" align="center"></img>

<form action="/Login.php" method="post">
  

  <div class="container">
    <label for="uname"><b></b></label>
    <input type="hidden"  name="Empname">
    <input type="text" placeholder="Username" name="user_name" required>
    <br>
    <label for="psw"><b></b></label>
    <input type="password" placeholder="Password" name="pass1" required>
    <br> 
   
    <button type="submit" name="submit">Login</button><br>
    <button type="reset" name="reset" class="cancelbtn">Cancel</button>        
    <br>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me <label> &nbsp  &nbsp<a href="frmforgotpassword.php">Forgot Password?</a></label>
    </label><br>
    <label>Don't have an account?&nbsp &nbsp<a href="frmregister.php">Register here</a></label>
    
  </div>
</form>
</center>
</body>
</html>
<?php
include("footer.php");
?>