<?php 
session_start();
require('db_connect.php');
$user_id = $_GET['updateid'];

$sql = "UPDATE requests SET status_id='2' WHERE user_id=$user_id";
$result=mysqli_query($conn,$sql);

if($result){
header('Location: coach.php');
}else
{
    die(mysqli_error($conn));
}
?>