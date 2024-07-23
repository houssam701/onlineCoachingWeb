<?php 
session_start();
require('db_connect.php');
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];
        $sql1 = "SELECT * FROM requests WHERE user_id = '$user_id'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        if($result1->num_rows>0){
        if ($row1['status_id'] != 2) {
            echo "<script>console.log('not done');</script>";
            header('Location: index.php');
        }
      }else{
        header('Location: index.php');
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/course-intro.css">
    <title>Course</title>
</head>
<body>
 <!-- begining of navbar -->
<nav>
    <ul class="sidebar">
      <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
      <li><a href="index.php">Home</a></li>
      <li><a href="course-intro.php">Course</a></li>
      <li><a href="Logout-coach.php">Logout</a></li>
    </ul>
    <ul>
      <li id="logo"><img src="./images/c4gym-high-resolution-logo-transparent.png" style=" width: 80px;height: 80px;"></li>
      <li class="hideOnMobile"><a href="index.php">Home</a></li>
      <li class="hideOnMobile"><a href="index.php#Schedule" class="scroll-link">Schedule</a></li>
      <li class="hideOnMobile"><a href="index.php#coaches" class="scroll-link">Coaches</a></li>
      <li class="hideOnMobile"><a href="course-intro.php">Course</a></li>
      <li class="hideOnMobile"><a href="Logout-coach.php">Logout</a></li>
      <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
    </ul>
  </nav>
<!-- ends of the navbarrrrrrrrrrrrrrrrrr -->
    <section class="intro">
        <h1>First rule Continuity</h1>
    </section>
    <section class="coach-name">
        <h1>Full Body Workout By Coach <span style="color: white;">
        <?php 
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM requests WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $coach_id = $row['coach_id'];
        $sql1 = "SELECT * FROM user WHERE userId = $coach_id";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        echo $row1['name'];
        ?>
    </span></h1>
    </section>
    <!-- ends of coach name -->
    <div class="content-container">
    <div class="class-container">
        <a id="class-3" href="legs.php">
            <p id="title-a">Legs Workout</p>
        </a>
        <a id="class-2" href="chest.php">
            <p id="title-a">Chest Workout</p>
        </a>
        <a id="class-4" href="pack.php">
            <p id="title-a">ABS  Workout</p>
        </a>
        <a id="class-5" href="arms.php">
            <p id="title-a">Arms Workout</p>
        </a>
        <a id="class-1" href="back.php">
            <p id="title-a">Back Workout</p>
        </a>
    </div>
    </div>
    <!-- ends of classes -->
    <section class="coach-name">
        <h1>Dont Forget The First Rool</h1>
    </section>
    <!-- ends of ends -->
    <section class="footer">
        <div class="contact-container">
            <h1>GET IN TOUCH</h1>
            <div id="line"></div>
            <p style="margin:5px 5px 5px 0;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi velit nostrum fugit laudantium aut consequatur dolorum nihil suscipit.</p>
            <div class="address"><img src="./images/location-mark.ico" alt="" style="width: 50px; height: 50px;">ADDRESS: 25, LOREM LIS STREET, ORANGE CALIFORNIA, US</div>
            <div class="phone"><img src="./images/icons8-phone-50.png" style="width: 50px; height: 50px; padding: 11px;" alt="">PHONE NUMBER: 800 123 3456 </div>
            <div class="email"><img src="./images/4202011_email_gmail_mail_logo_social_icon.png" style="width: 50px; height: 50px; padding: 10px;" alt="">EMAIL: INOF@HTMLSTREAM.COM</div>
            <h2>SOCIAL MEDIA</h2>
            <div id="line"></div>
      
            <div class="socialmedia">
                <a href=""><img src="./images/FACEBOOK.png" style="width: 50px; height: 48.5px; padding: 10px;" alt=""></a>
                <a href=""><img src="./images/INSTAGRAM.png" style="width: 55px; height: 55px; padding: 10px;" alt=""></a>
                <a href=""><img src="./images/twitter.png" alt="" style="width: 50px; height: 50px; padding: 10px;"></a>
                <a href=""><img src="./images/youtube.png"   alt="" style="width: 60px; height: 60px; padding: 10px;"></a>
            </div>
        </div>
            <iframe id="maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3312.2027359009444!2d35.49394381776492!3d33.88443215720115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f1721587e1d6d%3A0xaa7f5769dc576d98!2sLebanese%20International%20University!5e0!3m2!1sen!2slb!4v1715173212811!5m2!1sen!2slb"  height="500" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </section>
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
      <script src="./javaScript/smooth.js"></script>
</body>
</html>