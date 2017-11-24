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
$mypassword=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($con,$myusername);
$mypassword = mysqli_real_escape_string($con,$mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysqli_query($con,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION["myusername"] = $myusername;
$_SESSION["mypassword"] = $mypassword;
//session_register("myusername");
//session_register("mypassword"); 
header("location:../forum/forum.php");
}
else {
echo "Wrong Username or Password";
}
?>