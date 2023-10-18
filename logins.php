<?php 
// Include model.php here
include 'db.php';
$obj=new Model(); 
// Insert Record
if (isset($_POST['submit'])){
    $password=$_POST['password'];
    $email =$_POST['username'];
    $login = $obj->loginRecord($email);
  
    if($login != null && password_verify($password,$login['password'])){
        session_start();
        $_SESSION['login']=true;
        $_SESSION['username']=$_POST['username'];
        $_SESSION['email']=$_POST['email'];
        // echo "true";
        header('location:list.php');
    }
 }//if isset close
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">



</head>
<body>


    
        <div class="container py-5 justify-content-center col-md-6"">
            <h1 class="text-center">Login</h1>
        <form name="insertForm" action="" method="post"  onsubmit="return validation()" >
                <div class="form-group">
                    <label>Email or Username </label>
                    <input type="text" id="username" name="username" placeholder="Enter Your Name " class="form-control ">
                    <div id="usernameWarn" class="form-text text-danger"></div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" id="password" name="password" placeholder="Enter Your Password "  class="form-control " ></input>
                    <div id="passWarn" class="form-text text-danger"></div>
                </div>
                <div class="d-flex justify-content-between py-4 col-md-3  ">
                <input type="submit" name="submit" class="btn btn-primary ">
                <a class="btn btn-primary" href="registers.php">Register</a>
                </div>

            </form>
        </div>

<script>
        const validation = (e)=>{
            const username = document.insertForm.username.value;
            const password = document.insertForm.password.value;
          
            document.getElementById('usernameWarn').innerHTML = "";
            document.getElementById('passWarn').innerHTML = "";
         
            document.getElementById('username').classList.remove('outline');
            document.getElementById('password').classList.remove('outline');
           
            if(name==null || username==""){
                document.getElementById('username').classList.add('outline');
                document.getElementById('usernameWarn').innerHTML = "Name can't be blank";
                return false;
            }
            if(password.length<6 || password==null){
                document.getElementById('password').classList.add('outline');
                document.getElementById('passWarn').innerHTML = "Password must be at least 6 characters long.";
                return false;
            }
           
        }
  </script>    

<!-- Pills content -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>