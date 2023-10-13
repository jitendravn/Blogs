<?php 

include_once "./db.php";
$obj = new Model();

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
    <title>Blog Website</title>--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<style>
img{
max-width: 200px;
        }
</style>

 
<body>
<?php
if(isset($_GET['viewid'])){
    $editid=$_GET['viewid'];
    $myrecord=$obj->ViewRecord($viewid);
    ?>    
    <div class="card mx-auto text-center" style="width:30% ;">
  <img src="./images/<?php echo $myrecord['images']; ?>" class="card-img-top img-thumbnail" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $myrecord['bname']; ?></h5>
    <p class="card-text"><?php echo $myrecord['bdes']; ?></p>
    <a href="list.php" class="btn btn-primary">Go To List Page</a>
  </div>
</div>
<?php
        }
        ?> 
         <!-- jQuery library -->--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
