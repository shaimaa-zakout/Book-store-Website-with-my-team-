<?php

$dbserver = 'localhost';
$dbUsername = 'root';
$dbpassowrd = '';
$dbName = 'online_store';
$conn = mysqli_connect($dbserver, $dbUsername, $dbpassowrd, $dbName); //??
if (!$conn) {
    echo "Connecting error :" . mysqli_connect_error();
}
 //class Db {
//
//    public $servername;
//    public $connect;
//    public $username;
//    public $dbname;
//    public $tablename;
//    public $password;
//
//    function __construct($tablename, $dbname = "online _store", $password = "", $username = "root", $servername = "localhost") {
//        $this->username = $username;
//        $this->dbname = $dbname;
//        $this->tablename = $tablename;
//        $this->password = $password;
//        $this->servername = $servername;
//        //  connection with database 
//        $this->connect = mysqli_connect($servername, $username, $password);
//        if (!$this->connect) {
//            die("erorr " . mysqli_connect_error());
//        }
//    }
//
//    public function getData() {
//        $sql = "SELECT * FROM $this->tablename";
//        $result = mysqli_query($this->connect, $sql);
//        if (mysqli_num_rows($result) > 0) {   //في حالة كان هناك صفوف فعلا رجع نتيجة الكويري
//            return $result;
//        }
//    }
//
//    public function deletData($whereCluse) {
//        $sql = "DELETE FROM $this->tablename  WHERE $whereCluse";
//        mysqli_query($this->connect, $sql);
////          if (mysqli_num_rows($result) > 0) {    
////            return $result;
////        }
//    }
//
//    public function UpdateData($Qurye, $whereCluse) {
//        $sql = "UPDATE $this->tablename SET $Qurye WHERE $whereCluse";
//        mysqli_query($this->connect, $sql);
//    }
//
//    public function AddData($Qurye, $selectAtt) {
//        $sql = "INSERT INTO $this->tablename ($selectAtt) VALUES ($Qurye)";
//        mysqli_query($this->connect, $sql);
//    }
//
//}

?>