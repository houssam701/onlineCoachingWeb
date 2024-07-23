<?php
require ('db_connect.php');
if(isset($_GET['deleteid'])){
    $user_id = $_GET['deleteid'];
    $sql = "DELETE FROM requests WHERE user_id=$user_id";
    $result = mysqli_query($conn,$sql);
    if($result){
        header('Location: coach.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>
