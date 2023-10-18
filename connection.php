<?php 
class Coonnection{
   private $servername= 'localhost';
   private $username= 'root';
   private $password= '';
   private $dbname= 'blog';
   public $conn;

   function __construct(){
       $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
       if ($this->conn->connect_error){
           echo "connection failed ";
       }else{
           // echo "connected ";
       }
   }
   function dd($data){
    var_dump($data);
    die();
   }

}

?>