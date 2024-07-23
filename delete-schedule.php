<?php
require ('db_connect.php');
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];
    $sql = "DELETE from schedule where class_id=$id";
    $result = mysqli_query($conn,$sql);
    if($result){
        header('Location: admin-schedule.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>