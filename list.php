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
      // $im=$file_name;
       $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}else{
       $im=$file_name;
       move_uploaded_file($file_tmp, "images/" . $file_name);
    }
      // move_uploaded_file($file_tmp, "images/" . $file_name);
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
    <div class="container my-5">
        <h1>Insert Data : <a href="create.php" class="btn btn-warning">Insert</a></h1>
    
    </div>
<?php
if(isset($_GET['editid'])){?>
    <?php
    $editid=$_GET['editid'];
    $myrecord=$obj->displayRecordById($editid);
    ?>
    <div class="container">
   <form action="" method="post" enctype="multipart/form-data" onsubmit="return validation()"  >
            <div class="form-group">
                <label>Blog Name </label>
                <input type="text" id="name"  name="name" value="<?php echo $myrecord['bname']; ?>" placeholder="Enter Your Name " class="form-control " required>
                <div id="nameWarn" class="form-text text-danger"></div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea type="text"  id="des" name="des" class="form-control " required > <?php echo $myrecord['bdes']; ?></textarea>
                <div id="nameWarn" class="form-text text-danger"></div>
            </div>
            <div class="form-group">
                <label> Select image to upload:</label>
                <input  type="file" name="image" class="form-control " value="<?php echo $myrecord['images']; ?>" accept="image/*">
                <img src="images/<?php echo $myrecord['images']; ?>" alt="images">
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
                    <a class="btn btn-danger" onclick="alert()">Delete</a>
                    <a href="view.php?viewid=<?php echo $value['id']; ?>"  class="btn btn-success">View</a>
                  
                </td>
            </tr>
            <?php
            }

            ?>
        </table> 
     
        <script>

function alert() {
  // define a new variable
  if(confirm("This is Delete!")){
    window.location = `list.php?deleteid=<?php echo $value['id']; ?>`;
  }
}

const validation = (e)=>{
            const name = document.insertForm.name.value;
            const des = document.insertForm.des.value;
          
            document.getElementById('nameWarn').innerHTML = "";
            document.getElementById('desWarn').innerHTML = "";
         
            document.getElementById('name').classList.remove('outline');
            document.getElementById('des').classList.remove('outline');
           
            if(name.length>50 || name==""){
                document.getElementById('name').classList.add('outline');
                document.getElementById('nameWarn').innerHTML = "Name must not greater than 50 characters and cannot blank.";
                return false;
            }
            if(des.length<=20 || des==null){
                document.getElementById('des').classList.add('outline');
                document.getElementById('desWarn').innerHTML = "Description must be greater than 20 characters and cannot be blank.";
                return false;
            }
           
        }
  </script>    

</body>
</html>