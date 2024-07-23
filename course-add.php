<?php
session_start();
require('db_connect.php');
if(!isset($_SESSION['coach_id'])){
header("Location: login.php");
}
$coach_id=$_SESSION['coach_id'];
$coach_name = $_SESSION['coach_name'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {


$file_type = mime_content_type($_FILES['video']['tmp_name']);
if ($file_type == "video/mp4" || $file_type == "video/avi" || $file_type == "video/mov" || $file_type == "video/mpeg") {

$file=$_FILES['video'];
$file_name=$file['name'];   
$tempname =$file['tmp_name'];
$folder = 'coach-videos/'.$file_name;

$sql = "INSERT INTO video (content) VALUES (?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s",$folder);

if(mysqli_stmt_execute($stmt)){
  $video_id =mysqli_insert_id($conn);
  $muscle = $_POST["muscle"];
  $exercise =  $_POST["Exercise"];
  $instructions =  $_POST["instructions"];
  $sql2 = "INSERT INTO courses (coach_id ,video_id ,name,instructions,muscle) VALUES(?, ?, ?, ?, ?)";
  $stmt2 = mysqli_prepare($conn, $sql2);
  mysqli_stmt_bind_param($stmt2, "iisss",$coach_id,$video_id,$exercise,$instructions,$muscle);
  if(mysqli_stmt_execute($stmt2)){
    move_uploaded_file($tempname,$folder);
    header("Location: course-add.php");
  }else{
    die(mysqli_error($conn));
    echo "<script>alert('not done')</script>";
  }
  }else{
    echo "Error executing query: " . $stmt->error;
  }
}else{
  echo "<script>alert('Please enter a video!')</script>";

}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/course-add.css">
    <title>Adding Course</title>
</head>
<body>
     <!-- begining of navbar -->
     <nav>
        <ul class="sidebar">
          <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
          <li><a style="font-family:Brush Script MT, Brush Script Std, cursive ;color:red" >Welcome Coach</a></li>
          <li><a href="coach.php">Home</a></li>
          <li><a href="course-add.php">Course</a></li>
          <li><a href="Logout-coach.php">Logout</a></li>
        </ul>
        <ul>
          <li id="logo"><img src="./images/c4gym-high-resolution-logo-transparent.png" style=" width: 80px;height: 80px;"></li>
          <li class="hideOnMobile"><a href="" style="font-family:Brush Script MT, Brush Script Std, cursive ;color:red" >Welcome Coach</a></li>
          <li class="hideOnMobile"><a href="coach.php">Home</a></li>
          <li class="hideOnMobile"><a href="course-add.php">Course</a></li>
          <li class="hideOnMobile"><a href="Logout-coach.php">Logout</a></li>
          <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
        </ul>
      </nav>
    <!-- ends of the navbarrrrrrrrrrrrrrrrrr -->
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <h1>Exercise Info</h1>
        <label for="Exercise">Exercise name:</label><br>
        <input type="text" name="Exercise" placeholder="lat pull down/bench press...." required>
        <label for="muscle">Muscle:</label><br>
        <input type="text" name="muscle" placeholder="back/chest/legs...." required>
        <label for="instructions">Instructions:</label><br>
        <textarea name="instructions" rows="5" cols="80" required>Instructions for the exercise...</textarea><br>
        <label for="video">Video:</label><br>
        <input type="file" name="video" required>
    <input type="submit" id="submit-button">
    </form>
    <!-- ends of from -->
    <div class="tablecontainer">
        <h1>Schedule Your Fitness GYM</h1>
        <p>Who are in extremely love with eco friendly system. </p>
    <div>
        <table>
        <tr>
            <th>Exercise name</th>
            <th>Muscle</th>
            <th>Instructions</th>
            <th>Action</th>
        </tr>
       <?php 
        $sql4="SELECT * FROM courses WHERE coach_id = $coach_id";
        $result = $conn->query($sql4);
        if($result){
          while($row =mysqli_fetch_assoc($result)){
            $sql5="";
            echo '
              <tr>
              <td>'.$row['name'].'</td>
              <td>'.$row['muscle'].'</td>
              <td>'.$row['instructions'].'</td>
              <td><button id="update"><a href="update-course.php?updateid='.$row['courseId'].'" style="color: white; text-decoration:none;font-size:large;">Update</a></button>
              <button id="delete"><a href="delete-course.php?deleteid='.$row['courseId'].'" style="color: white; text-decoration:none;font-size:large;">Delete</a></button>
              </td>
              </tr>
            ';
          }
        }
       ?>
        </table>
    </div>
    </div>
</div>



<script>
    function showSidebar(){
      const sidebar = document.querySelector('.sidebar')
      sidebar.style.display = 'flex'
    }
    function hideSidebar(){
      const sidebar = document.querySelector('.sidebar')
      sidebar.style.display = 'none'
    }
  </script>
</body>
</html>