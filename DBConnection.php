<?php
$url='localhost';
$username='root';
$password='';
$conn=mysqli_connect($url,$username,$password,"epiz_33767114_uscces");
if(!$conn){
 die('Could not Connect My Sql:' .mysql_error());
}
?>