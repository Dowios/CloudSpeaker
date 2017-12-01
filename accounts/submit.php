<?php

session_start();

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password="142857sql"; // Mysql password 
$db_name="cloudspeaker"; // Database name 
$tbl_name="accounts"; // Table name 

// Connect to server and select databse.
$con = mysqli_connect("localhost",$username,$password,$db_name);
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// username and password sent from form 
$myusername=$_POST['username']; 
$myemail=$_POST['email']; 
$mypassword=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$myemail = stripslashes($myemail);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($con,$myusername);
$myemail = mysqli_real_escape_string($con,$myemail);
$mypassword = mysqli_real_escape_string($con,$mypassword);
$sql="INSERT INTO $tbl_name (id, username, email, password) VALUES ('', '$myusername', '$myemail', '$mypassword')";
mysqli_query($con,$sql);

// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION["myusername"] = $myusername;
$_SESSION["myemail"] = $myemail;
$_SESSION["mypassword"] = $mypassword;
//session_register("myusername");
//session_register("mypassword"); 
header("location:../example/forum.php");
?>