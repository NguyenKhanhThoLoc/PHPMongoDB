<?php

session_start();

if(!isset($_SESSION['email'])){
	header('Location: index.php');
	exit();
}
else{

	//this pulls the MongoDB driver from vendor folder
	require_once  'vendor/autoload.php';

	//connect to MongoDB Database
	$databaseConnection = new MongoDB\Client;

	//connecting to specific database in mongoDB
	$myDatabase = $databaseConnection->myDB;

	//connecting to our mongoDB Collections
	$userCollection = $myDatabase->users;

	$userEmail = $_SESSION['email'];

	
	$data = array(
		"Email" => $userEmail,
	);

	//fetch user from MongoDB Users Collection
	$fetch = $userCollection->findOne($data);
?>
<?php
include("./templates/header.php");
?>
<body>
	<div class="container mt-3">
	    <div class="row justify-content-center">
	      <div class="col-md-6">
	        <h2>Edit Profile</h2>
	        <form action="actions/edit-profile.php" method="POST" enctype="multipart/form-data">
  			  <div class="mb-3">
  			    <label for="avatar" class="form-label">Avatar:</label>
  			    <div class="d-flex align-items-center">
  			      <img src="data:<?php 
					$avatarData = $fetch['avatar'];
					$imageData = $avatarData['data'];
					$mimeType = $avatarData['mimeType'];
					echo $mimeType; ?>;base64,<?php echo $imageData;
				  ?>" alt="Profile Avatar" style="width: 100px; height: 100px; object-fit: cover;" class="me-3">
  			      <input type="file" class="form-control" id="avatar" name="avatar" accept="image/jpeg,image/png,image/gif">
  			    </div>
  			  </div>
	          <div class="mb-3">
	            <label for="fname" class="form-label">Firstname</label>
	            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fetch['Firstname']; ?>" required>
	          </div>
	          <div class="mb-3">
	            <label for="lname" class="form-label">Lastname</label>
	            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $fetch['Lastname']; ?>" required>
	          </div>
	          <div class="mb-3">
	            <label for="phoneNo" class="form-label">Phone No</label>
	            <input type="text" class="form-control" id="phoneNo" name="phoneNo" value="<?php echo $fetch['Phone Number']; ?>" required>
	          </div>
	          <input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $fetch['_id']; ?>" />
	          <button type="submit" name="update" id="update" class="btn btn-primary">Update Info</button>
	        </form>
	      </div>
	    </div>
	  </div>
	
	  <div class="text-center mt-3">
	    <a href="profile.php">Profile Page</a>
	  </div>
</body>
</html>
<?php } ?>