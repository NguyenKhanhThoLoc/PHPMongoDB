<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="dashboard d-flex justify-content-between">
        <div class="sidebar bg-dark vh-100">
            <h1 class="bg-primary p-4"><a href="./mainpage.php" class="text-light text-decoration-none">Dashboard</a></h1>
            <div class="menues p-4 mt-5">
                <div class="menu">
                    <a href="createpost.php" class="btn btn-info text-light text-decoration-none"><strong>Add New Post</strong></a>
                </div>
                <div class="menu mt-5">
                    <a href="profile.php" class="btn btn-info">View Profile</a>
                </div>
                <div class="menu mt-5">
                    <a href="logout.php" class="btn btn-info">Logout</a>
                </div>
                
            </div>
        </div>

<div class="posts-list w-100 p-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:15%;">Publication Date</th>
                <th style="width:15%;">Title</th>
                <th style="width:45%;">Article</th>
                <th style="width:25%;">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            	//this pulls the MongoDB driver from vendor folder
            	require_once  'vendor/autoload.php';

            	//connect to MongoDB Database
            	$databaseConnection = new MongoDB\Client;

            	//connecting to specific database in mongoDB
            	$myDatabase = $databaseConnection->myDB;

            	//connecting to our mongoDB Collections
            	$postCollection = $myDatabase->post;

            	$userEmail = $_SESSION['email'];

            	$data = array(
            		"email" => $userEmail,
            	);
            
            	//fetch user from MongoDB Users Collection
            	$fetch = $postCollection->find($data);

                foreach($fetch as $data) {
            ?>
            <tr>
            <td><?php echo $data["date"]?></td>
            <td><?php echo $data["title"]?></td>
            <td><?php echo $data["summary"]?></td>
            <td>
                <a class="btn btn-info" href="./page/view.php?id=<?php echo $data["_id"]?>">View</a>
                <a class="btn btn-warning"  href="./page/edit.php?id=<?php echo $data["_id"]?>">Edit</a>
                <a class="btn btn-danger" href="./page/delete.php?id=<?php echo $data["_id"]?>">Delete</a>
            </td>
            </tr>    
            <?php
            }
            ?>    
        </tbody>
    </table>
</div>

<?php
include("./templates/footer.php");
?>