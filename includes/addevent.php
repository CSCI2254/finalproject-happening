<?php
include("dbconn.php");
$msg = "";

$EventName = $_POST['name'];
$GroupName = $_POST['group'];
$Location=$_POST['location'];
$Link=$_POST['link'];
$Media=$_POST['media'];
$Startdate = $_POST['datestart'];
$Enddate = $_POST['dateend'];
$Description = $_POST['description'];

$username = $_POST['username'];
$pass = $_POST['password'];

$password = sha1($pass);

$dbc= connect_to_db("takc");

$query = "SELECT U_ID, PRIV from users where USERNAME='".$username."' AND PASSWORD='".$password."';";

$result = perform_query($dbc, $query);

if(!(mysqli_num_rows($result) == 0)){

	while($obj = $result->fetch_object()) {   //assigning values for user
	
		$U_ID = $obj->U_ID;
		$priv = $obj->PRIV;


	}
	if ($priv='unverified'){  // not verified user
		$msg .= "Your user has not yet been verified";
	}
	else{
		// Check if link already exists & 
		//if event w/ that name on that day
		$query = "SELECT * FROM events WHERE LINK='$Link' OR EVENTNAME='$EventName' AND STARTDATE = '$Startdate';";
		$result = perform_query($dbc, $query);

		if (mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    		$msg .= "event already exists";
		} else {
			$verifed=0;
			if ($priv = 'admin')
				$verified = 1;
			else        //user
				$verified = 0;
			//check user id and privledges, if admin approved = 1, if user approved = 0
    		$query = "insert into events 
    			(NAME, ORGANIZER, LOCATION, DESCRIPTION, MEDIAURL, STARTDATE, ENDDATE, LINK, APPROVED, U_ID) values 
    			('$EventName', '$GroupName', '$Location', '$Description', '$Media', '$Startdate', '$Enddate', '$Link', $verified, $U_ID);";
   		 $result = perform_query( $dbc, $query);
    		$msg .= "success";
		}
	}
}
else {         //you are not a user
	$msg .="You are not a user";
}
	echo $msg;

	disconnect_from_db( $dbc, $result );
?>