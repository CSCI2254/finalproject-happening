<?php
include("dbconn.php");
$msg = "";

$Firstname = $_POST['firstname'];
$Lastname = $_POST['lastname'];
$Username=$_POST['username'];
$Register_email=$_POST['email'];
$Password1=$_POST['password'];

$PWEncrypt = sha1($Password1);

$dbc= connect_to_db("takc");

// Need to check if user already exists

$insertsql = "INSERT INTO users (FIRSTNAME, LASTNAME, USERNAME, EMAIL, PASSWORD, PRIV) VALUES ('$Firstname','$Lastname','$Username', '$Register_email','$PWEncrypt', 'unverified');";
$result = perform_query( $dbc, $query);
echo $msg;
disconnect_from_db( $dbc, $result );
?>