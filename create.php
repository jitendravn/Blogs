<?php
// Include model.php here
include 'db.php';
$obj=new Model(); 
    

// Insert Record
 if (isset($_POST['submit'])){
   
    if(isset($_FILES['image'])){
        $file_name=$_FILES['image']['name'];
        $file_tmp=$_FILES['image']['tmp_name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}else{
       $img=$file_name;
       move_uploaded_file($file_tmp, "images/" . $file_name);
    }
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>   

<link rel="stylesheet" href="/DataTables/datatables.css" />
 
<script src="/DataTables/datatables.js"></script>

</head>

<body>
    <br>
    <h2 class="text-center text-info">Blog Website</h2>
    <br>
     <div class="container">
            
    <form name="insertForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validation()" >
                <div class="form-group">
                    <label>Blog Name </label>
                    <input type="text" id="name" name="name" placeholder="Enter Your Name " class="form-control ">
                    <div id="nameWarn" class="form-text text-danger"></div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea type="text" id="des" name="des"  class="form-control " ></textarea>
                    <div id="desWarn" class="form-text text-danger"></div>
                </div>
                <div class="form-group">
                    <label> Select image to upload:</label>
                    <input  type="file" name="image" class="form-control " >
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
   <script>
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