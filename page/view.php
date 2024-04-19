<?php
include("../templates/header.php");
?>

<div class="post w-100 bg-light p-5">
  <?php
    $id = $_GET["id"];
    session_start();
    //this pulls the MongoDB driver from vendor folder
    require_once  '../vendor/autoload.php';

    //connect to MongoDB Database
    $databaseConnection = new MongoDB\Client;

    //connecting to specific database in mongoDB
    $myDatabase = $databaseConnection->myDB;

    //connecting to our mongoDB Collections
    $postCollection = $myDatabase->post;

    $objectId = new MongoDB\BSON\ObjectId($id);

    $data = array(
        "_id" => $objectId,
    );
    $fetch = $postCollection->findOne($data);
  ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-8">
        <h2><?php echo $fetch['title']; ?></h2>
        <p class="text-muted mb-3"><?php echo $fetch['date']; ?></p>
        <p><?php echo $fetch['content']; ?></p>
        <a href="../mainpage.php" class="btn btn-primary btn-sm me-2" style="width: 100px;">MainPage</a>
      </div>
    </div>
  </div>
</div>

<?php
include("../templates/footer.php");
?>