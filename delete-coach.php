<?php
require ('db_connect.php');
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM user WHERE userId=$id";
    $result = mysqli_query($conn,$sql);
    if($result){
        header('Location: admin-coach.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>