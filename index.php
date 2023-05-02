
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>USC CES</title>
   <link rel="stylesheet" href="login_form.css">

</head>
<body>
   
<div class="form-container">
   <form action="Login.php" method="post">
      <h3>login now</h3>
      <input type="hidden" name="user_name" required placeholder="Enter your username">
      <input type="email" name="emailAdd" required placeholder="Enter your Email Address">
      <input type="password" name="pass1" required placeholder="Enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <input type="checkbox" checked="checked" name="remember"> Remember me <label> &nbsp  &nbsp<a href="frmforgotpassword.php">Forgot Password?</a></label>
      <p>don't have an account? <a href="frmregister.php">register now</a></p>
   </form>

</div>

</body>
</html>