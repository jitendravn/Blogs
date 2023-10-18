<?php
include 'db.php';
$obj=new Model(); 
// Insert Record
//$showAlert=false;
if (isset($_POST['submit'])){
   
    $register = $obj->registerInsertRecord($_POST);
    if($register){
        session_start();
        $_SESSION['login']=true;
        $_SESSION['username']=$_POST['username'];
        $_SESSION['email']=$_POST['email'];
       header('location:list.php');
        
    }
   
 }//if isset close
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container py-5 justify-content-center col-md-6">
    <h1 class="text-center">Registers</h1>
        <form name="insertForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validation()">
        <?php 
// if($showAlert){
//     echo '<div class="alert alert-success" role="alert">
//     Your Account is Now Created.
//     </div>';
// }

?>
            <div class="form-group">
                <label> Username </label>
                <input type="text" id="username" name="username" placeholder="Enter Your Name " class="form-control ">
                <div id="usernameWarn" class="form-text text-danger"></div>
            </div>
            <div class="form-group">
                <label> Email </label>
                <input type="text" id="email" name="email" placeholder="Enter Your Email ID " class="form-control ">
                <div id="emailWarn" class="form-text text-danger"></div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Your Password " class="form-control "></input>
                <div id="passWarn" class="form-text text-danger"></div>
            </div>
            <div class="form-group">
                <label>Repeat Password</label>
                <input type="password" id="cPassword" name="password2" placeholder="Repeat Password " class="form-control "></input>
                <div id="passWarn" class="form-text text-danger"></div>
            </div>


            <div class="d-flex py-4 col-md-6">
                
                <input type="submit" name="submit" class="btn btn-primary  col-md-6 ">
            </div>




        </form>
    </div>

    <script>
        const validation = (e) => {
            const username = document.insertForm.username.value;
            const password = document.insertForm.password.value;
            const email = document.insertForm.email.value;
            const firstpassword = document.insertForm.password.value;
            const secondpassword = document.insertForm.password2.value;
            const x = document.insertForm.email.value;
            const atposition = x.indexOf("@");
            const dotposition = x.lastIndexOf(".");
            document.getElementById('usernameWarn').innerHTML = "";
            document.getElementById('passWarn').innerHTML = "";
            document.getElementById('emailWarn').innerHTML = "";
            document.getElementById('username').classList.remove('outline');
            document.getElementById('password').classList.remove('outline');

            if (name == null || username == "") {
                document.getElementById('username').classList.add('outline');
                document.getElementById('usernameWarn').innerHTML = "Name can't be blank";
                return false;
            }
            
            if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {

                document.getElementById('emailWarn').classList.add('outline');
                document.getElementById('emailWarn').innerHTML = ("Please enter a valid e-mail address \n atpostion:" + atposition + "\n dotposition:" + dotposition);
                return false;
            }
            if (password.length < 6 || password == null) {
                document.getElementById('password').classList.add('outline');
                document.getElementById('passWarn').innerHTML = "Password must be at least 6 characters long.";
                return false;
            }


            if (firstpassword != secondpassword || firstpassword=="" || secondpassword=="") {
                document.getElementById('passWarn').classList.add('outline');
                document.getElementById('passWarn').innerHTML = "password must be same!";
                return false;

            }

            



           


        }
    </script>

    <!-- Pills content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>