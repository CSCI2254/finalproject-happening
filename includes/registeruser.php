<?php
include("dbconn.php");
$Firstname = $_POST['firstname'];
$Lastname = $_POST['lastname'];
$Username=$_POST['username'];
$Register_email=$_POST['email'];
$Password1=$_POST['password'];

$PWEncrypt = sha1($Password1);
$dbc= connect_to_db("takc");


$insertsql = "INSERT INTO users (FIRSTNAME, LASTNAME, USERNAME, EMAIL, PASSWORD, PRIV) VALUES ('$Firstname','$Lastname','$Username', '$Register_email','$PWEncrypt', 'unverified')";
<<<<<<< Updated upstream
$result = perform_query( $dbc, $query);
echo $result;
disconnect_from_db( $dbc, $result );
=======
$result = perform_query($dbc, $insertsql);
if (gettype($result)==="object") mysqli_free_result($result);
mysqli_close($dbc);
>>>>>>> Stashed changes
