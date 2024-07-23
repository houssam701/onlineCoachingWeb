<?php
session_start();
require('db_connect.php');
if(!isset($_SESSION['coach_id'])){
    header("Location: login.php");
    }
if(isset($_GET['deleteid'])){
$course_id = $_GET['deleteid'];
$ssql="SELECT * FROM courses WHERE courseId=$course_id";
$res=mysqli_query($conn,$ssql);
$row = mysqli_fetch_assoc($res);
$video_id1 =$row['video_id'];
$coach_id=$_SESSION['coach_id'];
$sql2 = "DELETE FROM video WHERE videoId=$video_id1";
$result2=mysqli_query($conn,$sql2);
if($result2){
 $sql = "DELETE from courses where courseId=$course_id";
    $result = mysqli_query($conn,$sql);
    if($result){
        header('Location: course-add.php');
    }else{
        die(mysqli_error($conn));
    }
}else{
    die(mysqli_error($conn));
}


   
}
?>