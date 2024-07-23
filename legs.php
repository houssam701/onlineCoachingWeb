<?php 
session_start();
require('db_connect.php');
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit;
}
$sql="SELECT * FROM courses WHERE muscle LIKE '%leg%'";
$result=mysqli_query($conn,$sql);
if($result){
if ($result->num_rows > 0) {
$row1 = mysqli_fetch_assoc($result);
$muscle = $row1['muscle'];
}else{
    $muscle="Not set yet!";
}
}else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/course.css">
    <title>Course</title>
</head>
<body>
  <!-- begining of navbar -->
<!-- ends of the navbarrrrrrrrrrrrrrrrrr -->
    <section class="intro">
        <h1>Second rule Determination</h1>
    </section>
    <section class="coach-name">
        <h1>Target Part <span style="color: white;"><?php echo $muscle; ?></span></h1>


    </section>
    <!-- ends of coach name -->
    <section class="course-container">
            <?php 
            $sql="SELECT * FROM courses WHERE muscle LIKE '%leg%'";
            $result=mysqli_query($conn,$sql);
            if($result){
            if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $video_id = $row['video_id'];
                $sql2 = "SELECT * From video WHERE videoId=$video_id";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2) {
                    if ($result2->num_rows > 0) {
                        $row2 = mysqli_fetch_assoc($result2);
                    }
                }
                else{
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            echo '
            <div class="content-container">
            <h1>Exercise Name: <span>'.$row['name'].'</span></h1>
            <video src="'.$row2['content'].'" controls  type="video/mp4"></video>
            <h3>Instruction:</h3>
            <p>'.$row['instructions'].'</p>
        </div>';
            }

            }else{
                echo " Exercises Not Set yet!";
            }
        }
            
            ?>


    </section>
      
</body>
</html>