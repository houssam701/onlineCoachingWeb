<?php
// save.php
session_start();
require('db_connect.php');

if(isset($_POST['id'])) {
    $coachId = $_POST['id'];
    $user_id = $_SESSION['user_id'];
    $status_id =1;
    $sql2 = "SELECT * FROM requests where user_id='$user_id'";
    $result2 = mysqli_query($conn, $sql2);
    if($result2->num_rows == 0){
    $sql="INSERT INTO requests (coach_id,status_id,user_id) VALUES ('$coachId','$status_id','$user_id')";
    if (mysqli_query($conn, $sql)) { 
        echo "Request has been send!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    }else{
        echo "You already send a Request!";
    } 
} 
?>