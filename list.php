<?php 

include_once "./db.php";
$obj = new Model();

 if (isset($_POST['update'])){
  $im=$_POST['im'];

    if(isset($_FILES['image'])){
        $target_dir="images/" . basename($_POST['im']);
        if(file_exists($target_dir)){
            unlink($target_dir);
        }
        $file_name=$_FILES['image']['name'];
        $file_tmp=$_FILES['image']['tmp_name'];
       $im=$file_name;
       move_uploaded_file($file_tmp, "images/" . $file_name);
    }
    $obj->updateRecord($_POST,$im);
 }//if isset close

 if (isset($_GET['deleteid'])){
    $delid=$_GET['deleteid'];
    $obj->deleteRecord($delid);
 }//if isset close

 if (isset($_GET['viewid'])){
    $viewid=$_GET['viewid'];
    $obj->ViewRecord($viewid);
 }//if isset close
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
    
        img{
max-width: 200px;
        }
    </style>
</head>
<body>
<?php
if(isset($_GET['editid'])){?>
    <?php
    $editid=$_GET['editid'];
    $myrecord=$obj->displayRecordById($editid);
    ?>
    <div class="container">
   <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Blog Name </label>
                <input type="text" name="name" value="<?php echo $myrecord['bname']; ?>" placeholder="Enter Your Name " class="form-control ">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="des" class="form-control " > <?php echo $myrecord['bdes']; ?></textarea>
            </div>
            <div class="form-group">
                <label> Select image to upload:</label>
                <input  type="file" name="image" class="form-control " value="<?php echo $myrecord['images']; ?>">
            </div>


            <div class="d-flex">
            <input type="hidden" name="hid" value="<?php echo $myrecord['id']; ?>">
            <input type="hidden" name="im" value="<?php echo $myrecord['images']; ?>">
            <input type="submit"  name="update" value="update" class="btn btn-primary ">
</div>
        </form>
   </div>
<?php } ?>


<table class="table table-bordered">
            <tr class="text-center">
                <th>S.No</th>
                <th>Blog Name</th>
                <th>Description</th>
                <th>Image </th>
                <th>Action</th>

            </tr>
            <?php
            //Display Records 
            $data=$obj->displayRecord();
            $sno=1;
            foreach($data as $value){
              ?>
            <tr class="text-center">
                <td><?php echo $sno++; ?></td>
                <td><?php echo $value['bname']; ?></td>
                <td width="40%"><?php echo $value['bdes']; ?></td>
                <td><img src="./images/<?php echo $value['images']; ?>" alt="img" class="img-fluid"></img></td>
                <td>
                    <a href="list.php?editid=<?php echo $value['id']; ?>" class="btn btn-info">Edit</a>
                    <a href="list.php?deleteid=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
                    <a href="view.php?viewid=<?php echo $value['id']; ?>" class="btn btn-success">View</a>
                    <a href="create.php" class="btn btn-warning">Insert</a>
                </td>
            </tr>
            <?php
            }

            ?>
        </table> 
     
     

</body>
</html>