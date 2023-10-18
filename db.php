<?php
include_once('connection.php');
//$conn=new Connection();
// Database Connection
class Model extends Coonnection
{
    // private $servername= 'localhost';
    // private $username= 'root';
    // private $password= '';
    // private $dbname= 'blog';
    // private $conn;

    // function __construct(){
    //     $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
    //     if ($this->conn->connect_error){
    //         echo "connection failed ";
    //     }else{
    //         // echo "connected ";
    //     }
    // }
    // function define for insert records
    public function insertRecord($post, $img)
    {
        $bname = mysqli_real_escape_string($this->conn, $post['name']);
        $bdes = mysqli_real_escape_string($this->conn, $post['des']);
        $images = mysqli_real_escape_string($this->conn, $img);
        $likes = mysqli_real_escape_string($this->conn, $post['likes']);

        $sql = "INSERT INTO blogs(bname,bdes,images,likes)VALUES('$bname','$bdes','$images','$likes')";
        $result = $this->conn->query($sql);
        if ($result) {
            header('location:list.php');
            exit();
        } else {
            echo '<script>alert("Data is not Fetched")</script>';
            // echo "Error" .$sql. "<br>" .$this->conn->error;
        }
    }


    public function displayRecordById($editid)
    {
        $sql = "SELECT * FROM blogs WHERE id='$editid'";
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    public function ViewRecord($viewid)
    {
        $sql = "SELECT * FROM blogs WHERE id='$viewid'";
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    public function updateRecord($post, $im)
    {
        //$bname = $post['name'];
        //$bdes = $post['des'];   
        $bname = mysqli_real_escape_string($this->conn, $post['name']);
        $bdes = mysqli_real_escape_string($this->conn, $post['des']);
        //   $images = $im['image'];
        $editid = $post['hid'];
        $sql = "UPDATE blogs SET bname='$bname',bdes='$bdes',images='$im' WHERE id='$editid'";
        $result = $this->conn->query($sql);
        if ($result) {

            header('location:list.php');
            exit();
        } else {
            echo '<script>alert("Data is not Fetched")</script>';
            //  echo "Error" .$sql. "<br>" .$this->conn->error;
        }
    }

    public function deleteRecord($delid)
    {

        $sql = "DELETE FROM blogs WHERE id='$delid'";
        $result = $this->conn->query($sql);
        if ($result) {
            header('location:list.php');
            exit();
        } else {
            echo '<script>alert("Data is not Fetched")</script>';
            //    echo "Error " .$sql . "<br>" .$this->conn->error;
        }
    }

    public function displayRecord()
    {
        $sql = "SELECT * FROM blogs";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }


    //  public function useridRecord($page)
    // {
    //     $limit =3;
    //     $offset = ($page - 1) * $limit;
    //     $sql = "SELECT * FROM blogs ORDER id LIMIT {$offset},{$limit}";
    //     $result = $this->conn->query($sql);
    //     if ($result > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
    //         return $data;
    //     }
    // }



    public function registerInsertRecord($post)
    {
        $username = mysqli_real_escape_string($this->conn, $post['username']);
        $password = password_hash($post['password'], PASSWORD_DEFAULT);
        $email = mysqli_real_escape_string($this->conn, $post['email']);


        $sql = "INSERT INTO registers(username,password,email)VALUES('$username','$password','$email')";
        $result = $this->conn->query($sql);
        if ($result) {

            //    header('location:list.php');
            return true;
        } else {
            echo mysqli_error($this->conn);
            echo '<script>alert("Data is not Fetched")</script>';
            echo "Error" . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    public function loginRecord($email)
    {
        $sql = "SELECT * FROM  registers WHERE email='$email'";
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // var_dump($row);
            return $row;
        } else {

            echo '<div class="alert alert-success" role="alert">
                Your Email and Password are Not Right.
                </div>';
        }
    }

    public function likeUpdateRecord($likeid)
    {
        $likes = mysqli_real_escape_string($this->conn, $likeid);
        //$editid=['hid'];
               $sql = "UPDATE blogs SET likes=`likes`+1 WHERE id='$likeid'";
        $result = $this->conn->query($sql);
        if ($result) {
            // header('location:list.php');
            // exit();
        } else {
            echo '<script>alert("Data is not Fetched")</script>';
            // echo "Error" .$sql. "<br>" .$this->conn->error;
        }
    }

    public function insertLikesRecord($email, $blogid)
    {

        $already_liked_query = "SELECT * from likes WHERE email='$email' AND blogid='$blogid'";
        $already_liked = $this->conn->query($already_liked_query);
          
        if ($already_liked->num_rows < 1) {
            $sql = "INSERT INTO likes(email,blogid) VALUES('$email','$blogid')";
            $result = $this->conn->query($sql);
            if ($result) {
                header('location:list.php');
            } else {
                echo '<script>alert("Data is not Fetched")</script>';
                // print_r($result);
                // exit();
                // echo "Error" .$sql. "<br>" .$this->conn->error;
            }
        }
    }

    public function checkEmailid($email, $id)
    {
        $sql = "SELECT * FROM likes WHERE email='$email' AND blogid='$id'";
        $result = mysqli_query($this->conn, $sql);
        if ($result->num_rows == 1) {
            return true;
            // return $row;
        }
        return false;
    }
    public function pageRecords($page)
    {
        $limit =3;
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM blogs LIMIT {$offset},{$limit} ";
        $result = $this->conn->query($sql);
        $data=[];
        if ($result->num_rows > 0) {
            // $limit =3;
            // $total_page=ceil($total_records / $limit) ;
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            
        }
        return $data;
    }

}
