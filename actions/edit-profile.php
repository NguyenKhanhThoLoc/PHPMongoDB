<?php

session_start();

// This pulls the MongoDB driver from the vendor folder
require_once '../vendor/autoload.php';

// Connect to MongoDB Database
$databaseConnection = new MongoDB\Client;

// Connect to specific database in MongoDB
$myDatabase = $databaseConnection->myDB;

// Connect to our MongoDB Collections
$userCollection = $myDatabase->users;


if (isset($_POST['update'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phoneNo = $_POST['phoneNo'];
    $hidden_id = $_POST['hidden_id'];

    // Handle avatar upload (if any)
    $avatarData = null;
	$test = $_FILES['avatar'];

    if (isset($_FILES['avatar'])) {
        $avatarFile = $_FILES['avatar'];
        // Validate file type (adjust as needed)
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($avatarFile['type'], $allowedMimeTypes)) {
            echo "Error: Invalid image format. Please upload a JPEG, PNG, or GIF.";
            exit;
        }

        // Get file extension
        $fileExt = pathinfo($avatarFile['name'], PATHINFO_EXTENSION);

		//echo '<script>console.log("Giá trị của $fname:", ', json_encode($fileExt), ');</script>';
        // Generate a unique filename
        $fileName = uniqid() . "." . $fileExt;

		//echo '<script>console.log("Giá trị của $fname:", ', json_encode($fileName), ');</script>';

        // Upload the file to a designated directory
        $uploadPath = "../file/" . $fileName;
        if (move_uploaded_file($avatarFile['tmp_name'], $uploadPath)) {
            $avatarData = [
                "data" => base64_encode(file_get_contents($uploadPath)),
                "mimeType" => $avatarFile['type'],
            ];
        } else {
            echo "Error: Failed to upload avatar.";
            exit;
        }
    }

    $updateData = ['$set' => array(
        "Firstname" => $fname,
        "Lastname" => $lname,
        "Phone Number" => $phoneNo,
    )];

    if ($avatarData) {
        $updateData['$set']['avatar'] = $avatarData; // Update avatar data
    }

    // Update user data in MongoDB
    $update = $userCollection->updateOne(['_id' => new \MongoDB\BSON\ObjectID($hidden_id)], $updateData);

    if ($update) {
        header('Location: ../profile.php');
    } else {
        ?>
        <center><h4 style="color: red;">Update Failed</h4></center>
        <center><a href="../edit-profile.php?id=<?php echo $hidden_id; ?>">Try Again</a></center>
        <?php
    }
}

?>