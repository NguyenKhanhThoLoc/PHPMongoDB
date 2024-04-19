<?php 
include("../templates/header.php");
?>

<?php
$id = $_GET['id'];
if($id){
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

}else{
    echo "No post found";
}
?>
    <div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
        <form action="../actions/update-post.php" method="post">
          <div class="form-field mb-4">
            <input type="text" class="form-control" name="title" id="" placeholder="Enter Title:" value="<?php echo $fetch['title']; ?>">
          </div>
          <div class="form-field mb-4">
            <textarea name="summary" class="form-control" id="" cols="30" rows="10" placeholder="Enter Summary:"><?php echo $fetch['summary']; ?></textarea>
          </div>
          <div class="form-field mb-4">
            <textarea name="content" class="form-control" id="" cols="30" rows="10" placeholder="Enter Post:"><?php echo $fetch['content']; ?></textarea>
          </div>
          <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
          <input type="hidden" name="id" value="<?php echo $fetch['_id']; ?>">
          <div class="form-field">
            <input type="submit" class="btn btn-primary" value="Update" name="update">
            <a href="../mainpage.php" class="btn btn-primary me-2">MainPage</a>
          </div>
        </form>
    </div>
<?php 
include("../templates/footer.php");
?>