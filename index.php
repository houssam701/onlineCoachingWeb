<?php 
session_start();
require('db_connect.php');
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISD</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<!-- begining of navbar -->
<nav>
    <ul class="sidebar">
      <li onclick=hideSidebar()><a style="color: white;"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
      <li><a href="index.php">Home</a></li>
      <?php 
        $user_id = $_SESSION['user_id'];
        $sql2 = "SELECT * FROM requests WHERE user_id = '$user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        if($result2->num_rows>0){
        if ($row2['status_id'] == 2) {
          echo '<li><a href="course-intro.php">Course</a></li>';
        }
      }
        ?>
      <li><a href="Logout-coach.php">Logout</a></li>
    </ul>
    <ul>
      <li id="logo"><img src="./images/c4gym-high-resolution-logo-transparent.png" style=" width: 80px;height: 80px;"></li>
      <li class="hideOnMobile"><a href="index.php">Home</a></li>
      <li class="hideOnMobile"><a href="#Schedule" class="scroll-link">Schedule</a></li>
      <li class="hideOnMobile"><a href="#coaches" class="scroll-link">Coaches</a></li>
      
        <?php 
        $user_id = $_SESSION['user_id'];
        $sql1 = "SELECT * FROM requests WHERE user_id = '$user_id'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        if($result1->num_rows>0){
        if ($row1['status_id'] == 2) {
          echo '<li class="hideOnMobile"><a href="course-intro.php">Course</a></li>';
        }
      }
        ?>
      <li class="hideOnMobile"><a href="Logout-coach.php">Logout</a></li>
      <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
    </ul>
  </nav>
<!-- ends of the navbarrrrrrrrrrrrrrrrrr -->



    <section class="head">
        <h1>REAL FITNESS</h1>
        <h1>DEPENDS ON EXERCISE</h1>
        <h2>SHAPE YOUR BODY WELL</h2>
    </section>
    <!-- ends of introoooooooooooooooooooooo -->
     <!-- Container 1 -->
  <section id="container1">
    <h1>We care about what we offer</h1>
    <h4>Who are in extremely love with eco friendly system.</h4>

    <!-- Container 2 -->
    <section id="container2">
      <!-- Card 1 -->
      <div class="card">
        <img src="./images/o1.png" alt="Logo 1">
        <h2>Time</h2>
        <p>The amount of time spent working out is less important than the quality and consistency of the exercise routine.</p>
      </div>

      <!-- Card 2 -->
      <div class="card">
        <img src="./images/o2.png" alt="Logo 1">
        <h2>Regular Exercise</h2>
        <p>Regular sports activities improve cardiovascular health, increase muscle strength, enhance mental health, and reduce the risk of chronic diseases.</p>
      </div>
      <!-- Card 3 -->
      <div class="card">
        <img src="./images/o3.png" alt="Logo 1">
        <h2>Gym Workout</h2>
        <p>Gym workouts, including weightlifting, cardio, and flexibility exercises, help achieve fitness goals, build muscle, and improve overall well-being.</p>
      </div>

    </section>
  </section>
    <div class="nav-bg"></div>
    <script src="javaScript/script.js"></script>

    <!-- ends cardssss -->
    <section class="container3">
      <h1>Calculate Your Body Mass Index</h1>
      <p>Who are in extremely love with eco friendly system.</p>
      <div id="bmi"> 
        <input type="text" id="height" placeholder="Your Height(cm)">
        <input type="text" id="weight" placeholder="Your Weight(kilo)">   
        <button id="calbmi" onclick="calculateBMI()">CALCULATE YOUR BMI</button>   
      </div>
    </section>
    <!-- ends bmi -->
    <section class="tablecontainer" id="Schedule">
      <h1>Schedule Your Fitness Process</h1>
      <p>The schedule is not stable, we could add or remove classes. </p>
      <div>
      <table>
            <tr>
                <th>Day</th>
                <th>Start-time</th>
                <th>End-time</th>
                <th>Class</th>
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
  
            echo "</tr>";
        }
           ?>
    
        </table>
      </div>
  </section>
<!-- ends tableeeeeee -->
<section class="textContainer">
  <div class="photo1"></div>
  <div class="txt">  <h1>Schedule your Fitness Process</h1>
    <p>The content of time spent working out is not as important as the quality, consistency, and scheduling of your exercise routine, meaning that even shorter, focused workouts can yield significant health benefits if done regularly and with proper intensity. </div>
  <div class="photo2"></div>
  <div class="txt">  <h1>GYM Workout Benefits</h1>
    <p>Gym workouts, encompassing a variety of exercises like weightlifting, cardio, and flexibility training, provide a comprehensive approach to fitness that can help individuals achieve their personal health goals, build muscle, increase endurance, and improve overall well-being. </div>
</section>
<!-- ends of info -->
<section class="coach-section" id="coaches">
  <h1>Our Team</h1>
  <p>
Our team, comprising some of the best-trained athletes and coaches, excels in both skill and dedication.</p>
  <div class="coach-container">   
    <?php 
     $sql2 = "SELECT * FROM user where role_id=2";
    $result2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_assoc($result2)) {
   
    echo "<div class='coach'>";
    echo "<img src='{$row2['image']}' alt='coach photo'> ";
    echo "<h3>{$row2['name']}</h3>";
    echo "<button  id='coach-button' class='save-btn' onclick='saveData({$row2['userId']})'>Send Request</button>";
    echo "</div>";
    echo "<script>console.log('{$row2['userId']}');</script>";
  }
    ?>

  </div>
  <!-- ends of coach carts -->
</section>
<section class="slogan">
  <div class="slogan-container">
  <img src="./images/l1.png" style="width: 159px; height: 110px;" alt="">
  <img src="./images/l2.png" style="width: 159px; height: 110px;" alt="">
  <img src="./images/l3.png" style="width: 159px; height: 110px;" alt="">
  <img src="./images/l4.png" style="width: 159px; height: 110px;" alt="">
  <img src="./images/l5.png" style="width: 159px; height: 110px;" alt="">
  </div>
</section>
<!-- ends of logos -->
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
<!-- ends of footer -->
<div class="popup" id="popup">
  <img src="./images/yes.png" alt="">
  <p id="content25"></p>
  <button type="button" onclick="closePopup()">Ok</button>
</div>
<!-- ends of popup -->
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
<script src="./javaScript/smooth-index.js"></script>  
<script src="./javaScript/ajax.js"></script>
<script src="./javaScript/bmi.js"></script>
</body>
</html>