<?php
require ('db_connect.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM user WHERE userId=$id";
    $result = mysqli_query($conn,$sql);
    if($result){
        header('Location: admin-user.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>