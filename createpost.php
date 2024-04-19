<?php

session_start();

if(!isset($_SESSION['email'])){
	header('Location: index.php');
	exit();
}
else{
    /*
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
    */
?>

<?php 
include("./templates/header.php");
?>
        <div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
            <form action="./actions/create-post.php" method="post">
                <div class="form-field mb-4">
                    <input type="text" class="form-control" name="title" id="" placeholder="Enter Title:">
                </div>
                <div class="form-field mb-4">
                    <textarea name="summary"  class="form-control" id="" cols="30" rows="10" placeholder="Enter Summary:"></textarea>
                </div>
                <div class="form-field mb-4">
                    <textarea name="content" class="form-control" id="" cols="30" rows="10" placeholder="Enter Post:"></textarea>
                </div>
                <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

                <div class="form-field">
                    <input type="submit" class="btn btn-primary" value="Submit" name="create">
                    <a href="mainpage.php" class="btn btn-primary me-2">MainPage</a>
                </div>
            </form>
        </div>
<?php 
include("./templates/footer.php");
?>
<?php } ?>