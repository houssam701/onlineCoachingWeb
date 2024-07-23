<?php 
session_start();
require('db_connect.php');
if (!isset ($_SESSION['admin_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit;
}
$admin_id = $_SESSION['admin_id'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $start_time = $_POST["Start-time"];
    $end_time = $_POST["End-time"];
    $day = $_POST["day"];
    $class = $_POST["Class"];
    
    $sql = "INSERT INTO schedule (admin_id,start_time, end_time, day,class) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issss",$admin_id, $start_time, $end_time, $day, $class);


    if (mysqli_stmt_execute($stmt)) {
        header('Location: admin-schedule.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin-schedule.css">
    <title>Schedule</title>
</head>
<body>
<!-- begining of navbar -->
<nav>
    <ul class="sidebar">
      <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
      <li class="hideOnMobile"><a href="" style="font-family:Brush Script MT, Brush Script Std, cursive ;color:red" >Welcome Admin</a></li>
      <li><a href="admin-user.php">Users</a></li>
      <li><a href="admin-user.php#clients">Clients</a></li>
      <li><a href="admin-coach.php">Coaches</a></li>
      <li><a href="admin-schedule.php">Schedule</a></li>
      <li><a href="Logout-coach.php">LogOut</a></li>
    </ul>
    <ul>
      <li id="logo"><img src="./images/c4gym-high-resolution-logo-transparent.png" style=" width: 80px;height: 80px;"></li>
      <li class="hideOnMobile"><a href="" style="font-family:Brush Script MT, Brush Script Std, cursive ;color:red" >Welcome Admin</a></li>
      <li class="hideOnMobile"><a href="admin-user.php">Users</a></li>
      <li class="hideOnMobile"><a href="admin-user.php#clients">Clients</a></li>
      <li class="hideOnMobile"><a href="admin-coach.php">Coaches</a></li>
      <li class="hideOnMobile"><a href="admin-schedule.php">Schedule</a></li>
      <li class="hideOnMobile"><a href="Logout-coach.php">LogOut</a></li>
      <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
    </ul>
  </nav>
<!-- ends of the navbarrrrrrrrrrrrrrrrrr -->
    <div class="container">
        <form action="" method="post">
            <h1>Schedule Info</h1>
            <label for="Start-time">Start-time:</label><br>
            <input type="time" name="Start-time"required><br>
            <label for="End-time">End-time:</label><br>
            <input type="time" name="End-time" required><br>
            <label for="Class">Class Name:</label><br>
            <input type="text" name="Class" required ><br>
            <label for="day">Day:</label>
            <!-- <input type="text" name="day" required><br>
            <input type="submit" id="submit-button"> -->
            <select id="day" name="day">
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Saturday">Sunday</option>
        </select><br><br>
        <input type="submit" id="submit-button">
        </form>
        <div class="tablecontainer">
            <h1>Schedule Your Fitness GYM</h1>
            <p>Who are in extremely love with eco friendly system. </p>
        <div>
            <table>
            <tr>
                <th>Day</th>
                <th>Start-time</th>
                <th>End-time</th>
                <th>Class</th>
                <th>Action</th>
            </tr>
            <?php 
            $sql = "SELECT * FROM schedule ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'), start_time";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["day"] . "</td>";
            echo "<td>" . $row["start_time"] . "</td>";
            echo "<td>" . $row["end_time"] . "</td>";
            echo "<td>" . $row["class"] . "</td>";
            echo '<td> 
                        <button id="update"><a href="update-schedule.php?updateid='.$row["class_id"].'" style="color: white; text-decoration:none;font-size:large;">Update</a></button>
                        <button id="delete"><a href="delete-schedule.php?deleteid='.$row["class_id"].'" style="color: white; text-decoration:none;font-size:large;">Delete</a></button>
                </td>';
            echo "</tr>";
            }
            ?>
    
            </table>
        </div>
        </div>
        <!-- ends form -->
        <script>
  function showSidebar(){
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.display = 'flex';
  }
  function hideSidebar(){
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.display = 'none';
  }
 
</script>
    </div>
</body>
</html>