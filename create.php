<?php
// Include model.php here
include 'db.php';
$obj=new Model(); 
    

// Insert Record
 if (isset($_POST['submit'])){
   
    if(isset($_FILES['image'])){
        $file_name=$_FILES['image']['name'];
        $file_tmp=$_FILES['image']['tmp_name'];
       $img=$file_name;
       move_uploaded_file($file_tmp, "images/" . $file_name);
    }
    $obj->insertRecord($_POST,$img);
 }//if isset close

 if(isset($_POST['list'])){
    require('list.php');
 }

//  if (isset($_POST['update'])){
//     $obj->updateRecord($_POST);
//  }//if isset close

//  if (isset($_GET['deleteid'])){
//     $delid=$_GET['deleteid'];
//     $obj->deleteRecord($delid);
//  }//if isset close



 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Website</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body>
    <br>
    <h2 class="text-center text-info">Blog Website</h2>
    <br>
   <div class="container">
   <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Blog Name </label>
                <input type="text" name="name" placeholder="Enter Your Name " class="form-control ">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="des"  class="form-control " ></textarea>
            </div>
            <div class="form-group">
                <label> Select image to upload:</label>
                <input  type="file" name="image" class="form-control ">
            </div>


            <div class="d-flex">
                <input type="submit" name="submit" class="btn btn-primary ">
                <!-- <input type="submit" name="update" value="Update" class="btn btn-primary "> 
                <input type="submit" name="delete" value="Delete" class="btn btn-primary "> -->
                <a href="list.php" class="btn btn-warning">All List</a>
                <!-- <input type="submit" name="view" value="View" class="btn btn-primary "> -->
            </div>
            
                
           

        </form>
   </div>
</body>

</html>