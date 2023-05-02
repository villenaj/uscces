<!DOCTYPE html>
<html>
<head>
<meta name="viewport", initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;} 
form {border: 3px solid #f1f1f1;}

img.avatar {
  width: 40%;
  border-radius: 50%;
}
.myLogo{
    width: 60px; 
    height: 60px;
    margin-top: 5px;
}
html, body {
  width: 100%;
  height:100%;
}

.MainHeader {
    /* background: linear-gradient(-45deg, #ee7752, #4ceb34, #34eb65, #3486eb); */
    background: #ffff;
    background-size: 400% 400%;
    height: 70px;
    animation: gradient 15s ease infinite;
    margin-top: 2px;
    padding-top:15px;

}
@media (max-width:600px) {
  .MainHeader {
  font-size: 12px;
  }}

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
</style>
</head>
<body>
<img class="myLogo" src="University_of_San_Carlos_logo.png" align="left"></img>
<h2 class="MainHeader"><font valign="center">&nbsp University of San Carlos Community Extension Services</font></h2>



