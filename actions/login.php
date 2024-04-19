<?php

session_start();

//this pulls the MongoDB driver from vendor folder
require_once  '../vendor/autoload.php';

//connect to MongoDB Database
$databaseConnection = new MongoDB\Client;

//connecting to specific database in mongoDB
$myDatabase = $databaseConnection->myDB;

//connecting to our mongoDB Collections
$userCollection = $myDatabase->users;


if(isset($_POST['login'])){

	$email = $_POST['email'];
    $password = sha1($_POST['password']);


$data = array(
	"Email" => $email,
);
    // Kiểm tra xem đã có người dùng đăng nhập hay chưa
    if (isset($_SESSION['email'])) {
        $message = "Tài khoản khác (".$_SESSION['email'].") đang đăng nhập. Vui lòng đăng xuất trước.";
    } else {
        // Thử truy xuất người dùng từ MongoDB
        $fetch = $userCollection->findOne($data);

		if ($fetch) {
			// Check if password matches
			if ($fetch['Password'] != $password) {
			  $message = "Password Error!";
			} else {
			  // Create session for newly logged-in user
			  $_SESSION['email'] = $fetch['Email'];
	  
			  // Redirect to main page
			  header('Location: ../mainpage.php');
			  exit();
			}
		} else {
			// Set error message for account not found
			$message = "Account not found!";
		}
    }
}

// Hiển thị thông báo nếu cần thiết
if (isset($message)) {
    ?>
    <center><h4 style="color: red;"><?php echo $message; ?></h4></center>
    <center><a href="../index.php">Try again</a></center>
    <?php
}

