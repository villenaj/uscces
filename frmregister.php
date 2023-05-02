<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>USC CES</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="register_form.css">

</head>
<body>
   
<div class="form-container">

   <form action="processregister.php" method="post">
      <h3>register now</h3>
      <input type="hidden"  name="Empname">
      <input type="text" placeholder="First Name" name="firstName" required>
      <input type="text" placeholder="Last Name" name="lastName" required>
      <input type="email" placeholder="Email" onfocusout="ValidateEmail(document.formreg.emailAdd)" id="emailAdd" name="emailAdd" required>
      <input type="text" placeholder="Username" name="user_name" required>
       <input type="password" placeholder="Password" name="pass1" required>
     <input type="password" placeholder="Confirm Password" name="pass2" required>
      <select name="typeOfUser" id="users">
            <option value="Student">Student</option>
            <option value="CESRep">CES Representative</option>
            <option value="CESCo">CES Coordinator</option>
            </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="index.php">login now</a></p>
   </form>

</div>

</body>
</html>