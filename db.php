<?php

// Database Connection
class Model{
    private $servername= 'localhost';
    private $username= 'root';
    private $password= '';
    private $dbname= 'blog';
    private $conn;

    function __construct(){
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        if ($this->conn->connect_error){
            echo "connection failed ";
        }else{
            echo "connected ";
        }
    }
    // function define for insert records
    public function insertRecord($post,$img){
        $bname = $post['name'];
        $bdes = $post['des'];   
        $images = $img;

        $sql="INSERT INTO blogs(bname,bdes,images)VALUES('$bname','$bdes','$images')";
        $result =$this->conn->query($sql);
        if($result){
            header('location:list.php');
        }else{
            echo "Error" .$sql. "<br>" .$this->conn->error;
        }
    }

   
    public function displayRecordById($editid){
        $sql="SELECT * FROM blogs WHERE id='$editid'";
        $result=$this->conn->query($sql);
        if($result->num_rows==1){
            $row =$result->fetch_assoc();
            return $row;
        }
    }

    public function ViewRecord($viewid){
        $sql="SELECT * FROM blogs WHERE id='$viewid'";
        $result=$this->conn->query($sql);
        if($result->num_rows==1){
            $row =$result->fetch_assoc();
            return $row;
        }
    }

    public function updateRecord($post,$im){
      $bname = $post['name'];
      $bdes = $post['des'];   
    //   $images = $im['image'];
        $editid= $post['hid'];
        $sql="UPDATE blogs SET bname='$bname',bdes='$bdes',images='$im' WHERE id='$editid'";
        $result =$this->conn->query($sql);
        if($result){
            header('location:list.php');
        }else{
            echo "Error" .$sql. "<br>" .$this->conn->error;
        }
    }

    public function deleteRecord($delid){
      
        $sql = "DELETE FROM blogs WHERE id='$delid'";
        $result=$this->conn->query($sql);
         if($result){
            header('location:list.php');

      }else{
            echo "Error " .$sql . "<br>" .$this->conn->error;
           }
   }

   public function displayRecord(){
       $sql = "SELECT * FROM blogs";
       $result=$this->conn->query($sql);
       if($result->num_rows > 0){
         while($row=$result->fetch_assoc()){
            $data[]=$row;
            
        }
        return $data;
    }
   }


}





?>
