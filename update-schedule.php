
<?php 
session_start();
require('db_connect.php');


$id = $_GET['updateid'];
$ssql="SELECT * FROM schedule WHERE class_id=$id";
$res=mysqli_query($conn,$ssql);
$row = mysqli_fetch_assoc($res);

$start1=$row['start_time'];
$end1=$row['end_time'];
$day=$row['day']; 
$class = $row['class'];

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $start=$_POST['Start_time'];  
    $end=$_POST['End_time']; 
    $day=$_POST['day']; 
    $class = $_POST['Class'];

    $sql="UPDATE schedule 
    SET start_time='$start',end_time='$end',day='$day',class='$class'
    WHERE class_id=$id";

    $result=mysqli_query($conn,$sql);

    if($result){
    header('Location: admin-schedule.php');
    }else
    {
        die(mysqli_error($conn));
    }
}




?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Schedule</title>
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
<form action="" method="post">
            <h1>Schedule Update</h1>
            <label for="Start_time">Start-time:</label><br>
            <input type="time" name="Start_time"required value="<?php echo $start1; ?>"><br>
            <label for="End_time">End-time:</label><br>
            <input type="time" name="End_time" required value="<?php echo $end1; ?>"><br>
            <label for="Class">Class Name:</label><br>
            <input type="text" name="Class" required value="<?php echo $class; ?>"><br>
            <label for="day">Day:</label>
            <!-- <input type="text" name="day" required><br>
            <input type="submit" id="submit-button"> -->
            <select id="day" name="day" value="<?php echo $day; ?>">
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
        </select><br><br>
        <input type="submit" id="submit-button">
        </form>
        <a href="admin-schedule.php"> <button  id="submit-button" style="background-color: red;">Go Back</button></a>

</body>
</html>