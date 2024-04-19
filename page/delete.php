<?php
$id = $_GET["id"];
require_once  '../vendor/autoload.php';

//connect to MongoDB Database
$databaseConnection = new MongoDB\Client;

//connecting to specific database in mongoDB
$myDatabase = $databaseConnection->myDB;

//connecting to our mongoDB Collections
$postCollection = $myDatabase->post;

if ($id) {
  $filter = array("_id" => new MongoDB\BSON\ObjectID($id));

  $deleteResult = $postCollection->deleteOne($filter);

  if ($deleteResult->getDeletedCount() === 1) {
    session_start();
    $_SESSION["delete"] = "Post deleted successfully";
    header("Location: ../mainpage.php");
  } else {
    echo "Post not found";
  }
} else {
  echo "Post ID not provided";
}
$client->close();
?>