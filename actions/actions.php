<?php

//this pulls the MongoDB driver from vendor folder
require_once  '../vendor/autoload.php';

//connect to MongoDB Database
$databaseConnection = new MongoDB\Client;

//connecting to specific database in mongoDB
$myDatabase = $databaseConnection->myDB;

//connecting to our mongoDB Collections
$userCollection = $myDatabase->users;
// if($userCollection){
// 	echo "Collection ".$userCollection." Connected";
// }
// else{
// 	echo "Failed to connect to Database/Collection";
// }
$insert = null;
$checkmatchpass = true;
if(isset($_POST['signup'])){
	if($_POST['password'] !== $_POST['repeatpassword']){
		$checkmatchpass = false;
	}
	else{
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$phoneNo = $_POST['phoneNo'];
    	$password = sha1($_POST['password']);

		$filter = ['Email' => $email];
		$existingUser = $userCollection->findOne($filter);

		if(!$existingUser){
			$data = array(
				"Firstname" => $fname,
				"Lastname" => $lname,
				"Email" => $email,
				"Phone Number" => $phoneNo,
				"Password" => $password,
				"avatar" => array(
                    "data" => base64_encode(file_get_contents("../file/default.jpg")), // Encode default avatar image
                    "mimeType" => "image/jpeg" // Assuming default image is JPEG (adjust if needed)
                )
			);
			//insert into MongoDB Users Collection
			$insert = $userCollection->insertOne($data);
	}
	}	
}


if($insert && $checkmatchpass){
	?>
		<center><h4 style="color: green;">Successfully Registered</h4></center>
		<center><a href="../index.php">Login</a></center>
	<?php
}
else if(!$checkmatchpass){
	?>
	<center><h4 style="color: red;">Registration Failed! Password repeat not match.</h4></center>
	<center><a href="../signup.php">Try Again</a></center>
	<?php
}
else {
	?>
	<center><h4 style="color: red;">Registration Failed! Email already exists</h4></center>
	<center><a href="../signup.php">Try Again</a></center>
	<?php
}

