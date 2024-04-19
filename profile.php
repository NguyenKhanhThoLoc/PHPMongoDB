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
$avatarUrl = "./file/default.jpg";
?>
<body>
	<div class="container mt-3">
	  <div class="row">
	    <div class="col-md-6">
	      <h2>Profile Details</h2>
	      <table class="table table-striped">
	        <tbody>
			   <tr>
					<?php
						$avatarData = $fetch['avatar'];
						$imageData = $avatarData['data'];
						$mimeType = $avatarData['mimeType'];
					?>
                    <th scope="row">Avatar:</th>
                        <td>
                            <img src="data:<?php echo $mimeType; ?>;base64,<?php echo $imageData; ?>" alt="Profile Avatar" style="width: 100px; height: 100px; object-fit: cover;">
                        </td>
                    </tr>
	          <tr>
	            <th scope="row">Firstname:</th>
	            <td><?php echo $fetch['Firstname']; ?></td>
	          </tr>
	          <tr>
	            <th scope="row">Lastname:</th>
	            <td><?php echo $fetch['Lastname']; ?></td>
	          </tr>
	          <tr>
	            <th scope="row">Email:</th>
	            <td><?php echo $fetch['Email']; ?></td>
	          </tr>
	          <tr>
	            <th scope="row">Phone Number:</th>
	            <td><?php echo $fetch['Phone Number']; ?></td>
	          </tr>
	        </tbody>
	      </table>
	      <div class="text-end">
	        <a href="edit-profile.php?id=<?php echo $fetch['_id']; ?>" class="btn btn-primary me-2">Edit</a>
			<a href="mainpage.php" class="btn btn-primary me-2">MainPage</a>
	        <a href="logout.php" class="btn btn-outline-secondary">Logout</a>
	      </div>
	    </div>
	  </div>
	</div>
</body>
</html>

<?php } ?>