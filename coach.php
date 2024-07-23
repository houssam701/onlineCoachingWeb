<?php 
session_start();
require('db_connect.php');
if(!isset($_SESSION['coach_id'])){
  header("Location: login.php");
  }
$coach_id=$_SESSION['coach_id'];

$ssql="SELECT * FROM user WHERE userId=$coach_id";
$res=mysqli_query($conn,$ssql);
$row = mysqli_fetch_assoc($res);
$name=$row['name'];
$email=$row['email'];
$phone=$row['phone'];
$image=$row['image'];

 // Define the query
 $sql = "SELECT COUNT(*) as count FROM requests WHERE status_id=2 AND coach_id=$coach_id";

 // Execute the query
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
 // Fetch the result
 $row = $result->fetch_assoc();
  $count = $row['count'];
} else {
 $count = 0;
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/coach.css">
    <title>Coach</title>
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
    <div class="portfolio">
        <img src="<?php echo $image ?>" alt="photo of the coach">
        <p><span> Name: </span><?php echo  $name; ?></p>
        <p><span> Email: </span><?php echo  $email; ?></p>
        <p><span> Phone: </span><?php echo  $phone; ?></p>
        <p><span> Number of clients: </span><?php echo $count; ?></p>
    </div>
    <div class="tablecontainer">
      <h1>User Requests</h1>
  <div>
      <table>
      <tr>
          <th>Client Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Date of Request</th>
          <th>Status</th>
          <th>Action</th>
      </tr>
      <?php 
      $sql1="SELECT * FROM requests WHERE coach_id=$coach_id";
      $res1=mysqli_query($conn,$sql1);
      while ($row = mysqli_fetch_assoc($res1)) {
        $user_id =$row['user_id'];  
        $status_id =$row['status_id'];
        $date = $row['date'];
        if($status_id==1){
          $status="Pending";
        }else{
          $status="Accepted";
        }
        $sql = "SELECT * FROM user WHERE userId=$user_id";
        $result = mysqli_query($conn,$sql);
        while($row2 =mysqli_fetch_assoc($result)){
          echo '
            <tr>
              <td>'.$row2['name'].'</td>
              <td>'.$row2['email'].'</td>
              <td>'.$row2['phone'].'</td>
              <td>'.$date.'</td>
              <td>'.$status.'</td>
              <td>
              <button id="update"><a href="accept.php?updateid='.$row2['userId'].'" style="color: white; text-decoration:none;font-size:large;">Accept</a></button>
              <button id="delete"><a href="delete-request.php?deleteid='.$row2['userId'].'" style="color: white; text-decoration:none;font-size:large;">Delete</a></button>
              
              </td>
            </tr>
          ';

        }
      }
      ?>
      </table>
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