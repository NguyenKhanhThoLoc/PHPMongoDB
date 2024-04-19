<?php
session_start();

require_once  '../vendor/autoload.php';

//connect to MongoDB Database
$databaseConnection = new MongoDB\Client;

//connecting to specific database in mongoDB
$myDatabase = $databaseConnection->myDB;

//connecting to our mongoDB Collections
$postCollection = $myDatabase->post;

if(isset($_POST["update"])){
    $userEmail = $_SESSION["email"];
    $title = $_POST["title"];
    $summary = $_POST["summary"];
    $content = $_POST["content"];
    $date = $_POST["date"];
    $id = $_POST["id"];
}

    $data = [
        '$set' => [
            "_id" => new MongoDB\BSON\ObjectID($id),
            "email" => $userEmail,
            "date" => $date,
            "title" => $title,
            "summary" => $summary,
            "content" => $content,
        ],
    ];

    
    $filter = array("_id" => new MongoDB\BSON\ObjectID($id));


    $insert = $postCollection->updateOne($filter, $data);
if($insert){
    ?>
    <center><h4 style="color: green;">Successfully</h4></center>
    <div class="form-field">
        <a href="../mainpage.php" class="btn btn-primary me-2">MainPage</a>
    </div>
    <?php

}else{
    ?>
    <center><h4 style="color: green;">Unsuccessfully</h4></center>
    <?php
}
?>