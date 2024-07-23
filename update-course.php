
<?php 
session_start();
require('db_connect.php');
if(!isset($_SESSION['coach_id'])){
    header("Location: login.php");
    }

$course_id = $_GET['updateid'];
$ssql="SELECT * FROM courses WHERE courseId=$course_id";
$res=mysqli_query($conn,$ssql);
$row = mysqli_fetch_assoc($res);
$video_id1 =$row['video_id'];
$coach_id=$_SESSION['coach_id'];
$muscle=$row['muscle'];
$exercise=$row['name'];
$instructions=$row['instructions'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $muscle = $_POST["muscle"];
    $exercise =  $_POST["Exercise"];
    $instructions =  $_POST["instructions"];
    
    $file=$_FILES['video'];
    $file_name=$file['name'];   
    $tempname =$file['tmp_name'];
    $folder = 'coach-videos/'.$file_name;
    
    $sql = "UPDATE video SET content ='$folder' WHERE videoId=$video_id1";
    $result=mysqli_query($conn,$sql);

    
    if($result){
      $sql2 = "UPDATE courses SET name='$exercise',instructions='$instructions',muscle='$muscle' WHERE courseId=$course_id";
      $result2=mysqli_query($conn,$sql2);
      if($result2){
        move_uploaded_file($tempname,$folder);
        header("Location: course-add.php");
      }else{
        die(mysqli_error($conn));
        echo '<script>alert('.$stmt->error.');</script>';

      }
      }else{
        echo '<script>alert('.$stmt->error.');</script>';
      }
      
    
    }



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Coach</title>
    <style> 
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body{
  height: 100vh;
  display: flex;
  flex-direction:column;
  justify-content: center;
  align-items: center;
}
form{
    width: 40%;
    margin: 1%;
    padding: 1%;
    background-color: #ccc;
    border-radius: 10px;
    height: auto;
  
  }
  form input{
    width: 95%;
    height: 40px;
    margin: 10px;
    border: none;
    border-radius: 5px;
    background-color: rgb(228, 228, 228);
    padding: 10px;
    font-size:medium;
  }
  form select{
    width: 40%;
    text-align: center;
    font-size: large;
  }
  form label{
    font-size: large;
    margin-left: 10px;
  }
  form textarea{
    margin: 10px;
    width: 95%;
    padding: 10px;
    background-color: rgb(228, 228, 228);
    border: 0.1px solid rgb(146, 146, 146);
  }
  #submit-button{
    width: 95%;
    height: 40px;
    margin: 10px;
    border: none;
    border-radius: 4px;
    font-size: large;
    font-weight: bold;
  }
  #submit-button:hover{
    cursor: pointer;
    background-color: red;
    border: none;
    color: white;
  }
  @media screen and (orientation:portrait){
    form{
      width: 90%;
    }
  }
    </style>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
        <h1>Exercise Info</h1>
        <label for="Exercise">Exercise name:</label><br>
        <input type="text" name="Exercise" placeholder="lat pull down/bench press...." required value="<?php echo $exercise; ?>">
        <label for="muscle">Muscle:</label><br>
        <input type="text" name="muscle" placeholder="back/chest/legs...." required value="<?php echo $muscle; ?>">
        <label for="instructions">Instructions:</label><br>
        <textarea name="instructions" rows="5" cols="80" required><?php echo $instructions; ?></textarea><br>
        <label for="video">Video:</label><br>
        <input type="file" name="video" required>
    <input type="submit" id="submit-button">
    </form>
    <a href="course-add.php"> <button  id="submit-button" style="background-color: red;">Go Back</button></a>

  </div>
</body>
</html>