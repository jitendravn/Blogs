<?php
session_start();

include_once "./db.php";
$obj = new Model();

if (isset($_POST['update'])) {
  $im = $_POST['im'];

  if (isset($_FILES['image']['name'])) {
    $target_dir = "images/" . basename($_POST['im']);
    if (file_exists($target_dir)) {
      unlink($target_dir);
    }
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    // $im=$file_name;
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    } else {
      $im = $file_name;
      move_uploaded_file($file_tmp, "images/" . $file_name);
    }
    // move_uploaded_file($file_tmp, "images/" . $file_name);
  }
  $obj->updateRecord($_POST, $im);
} //if isset close

if (isset($_GET['deleteid'])) {
  $delid = $_GET['deleteid'];
  $obj->deleteRecord($delid);
} //if isset close

if (isset($_GET['viewid'])) {
  $viewid = $_GET['viewid'];
  $obj->ViewRecord($viewid);
} //if isset close
if (isset($_GET['login'])) {
  session_unset();
  session_destroy();
  header('location:logins.php');
}

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
  header('location:logins.php');
}

if (isset($_GET['likeid'])) {

  $blogid = $_GET['likeid'];
  $email = $_SESSION['email'];
  $obj->likeUpdateRecord($blogid);
  $obj->insertLikesRecord($email, $blogid);
} //if isset close


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Operation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    img {
      max-width: 200px;
    }
  </style>

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create.php">Insert</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logins.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registers.php">Register</a>
          </li>

        </ul>
        <form class="d-flex" role="search">
          <a class="btn btn-outline-success" href="logins.php?login=true" type="submit">Logout</a>
        </form>
      </div>
    </div>
  </nav>

  <?php
  if (isset($_GET['editid'])) { ?>
    <?php
    $editid = $_GET['editid'];
    $myrecord = $obj->displayRecordById($editid);
    ?>
    <div class="container">
      <form action="" method="post" enctype="multipart/form-data" onsubmit="return validation()">
        <div class="form-group">
          <label>Blog Name </label>
          <input type="text" id="name" name="name" value="<?php echo $myrecord['bname']; ?>" placeholder="Enter Your Name " class="form-control " required>
          <div id="nameWarn" class="form-text text-danger"></div>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea type="text" id="des" name="des" class="form-control " required> <?php echo $myrecord['bdes']; ?></textarea>
          <div id="nameWarn" class="form-text text-danger"></div>
        </div>
        <div class="form-group">
          <label> Select image to upload:</label>
          <input type="file" name="image" class="form-control " value="<?php echo $myrecord['images']; ?>" accept="image/*">
          <img src="images/<?php echo $myrecord['images']; ?>" alt="images">
        </div>


        <div class="d-flex">
          <input type="hidden" name="hid" value="<?php echo $myrecord['id']; ?>">
          <input type="hidden" name="im" value="<?php echo $myrecord['images']; ?>">
          <input type="submit" name="update" value="update" class="btn btn-primary ">
        </div>
      </form>
    </div>
  <?php } ?>


  <table class="table table-bordered table-striped">

    <?php
    //Display Records 
   
    $data = $obj->displayRecord();
    $sno = 1;
    foreach ($data as $value) {
      
      $id = $value['id'];
      $email = $_SESSION['email'];
      $check = $obj->checkEmailid($email, $id);
     $a = false;
if ($check != null) {
  $a = true;
}
      
    ?>


      <div class="container">
        <div class="card mb-4 text-center" style="max-width: 100%;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="./images/<?php echo $value['images']; ?>" class="img-fluid rounded-start" alt="..." width="80%">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"><?php echo $value['bname']; ?></h5>
                <p class="card-text"><?php echo $value['bdes']; ?></p>


                <div class="container mt-5 d-flex justify-content-around">
                  <a href="list.php?editid=<?php echo $value['id']; ?>" class="btn btn-dark">Edit</a>
                  <a class="btn btn-warning" onclick="alert()">Delete</a>
                  <a href="view.php?viewid=<?php echo $value['id']; ?>" class="btn btn-success">View</a>
                  
                  <p><?php echo $value['likes']; ?></p>
            
                  <?php 
                  if(!$a){
                    echo '<a href="list.php?likeid='.$value['id'].'" class="btn btn-outline-danger">
                    <span class="bi bi-hand-thumbs-up"> Like</span>
                    </a>';
                  }else{
                    echo '<a href="" class="btn btn-outline-danger">
                    <span class="bi bi-hand-thumbs-down"> UnLike</span>
                  </a>';
                  }
                  
                  ?>
                  
                  

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

    <?php
    }

    ?>
  </table>

  <script>
    function alert() {
      // define a new variable
      if (confirm("This is Delete!")) {
        window.location = `list.php?deleteid=<?php echo $value['id']; ?>`;
      }
    }

    const validation = (e) => {
      const name = document.insertForm.name.value;
      const des = document.insertForm.des.value;

      document.getElementById('nameWarn').innerHTML = "";
      document.getElementById('desWarn').innerHTML = "";

      document.getElementById('name').classList.remove('outline');
      document.getElementById('des').classList.remove('outline');

      if (name.length > 50 || name == "") {
        document.getElementById('name').classList.add('outline');
        document.getElementById('nameWarn').innerHTML = "Name must not greater than 50 characters and cannot blank.";
        return false;
      }
      if (des.length <= 20 || des == null) {
        document.getElementById('des').classList.add('outline');
        document.getElementById('desWarn').innerHTML = "Description must be greater than 20 characters and cannot be blank.";
        return false;
      }

    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>