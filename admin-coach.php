<?php 
session_start();
require('db_connect.php');
if (!isset ($_SESSION['admin_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file_type = mime_content_type($_FILES['image']['tmp_name']);
    if ($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/gif") {
        $role_id=2;
        $file=$_FILES['image'];//secure
        $file_name=$file['name'];   
        $tempname =$file['tmp_name'];
        $folder = 'coach-images/'.$file_name;
    

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Securely hash the password
        $sql2 = "INSERT INTO user (role_id, name, email,phone,password,image) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt1 = $conn->prepare($sql2)) {
        $stmt1->bind_param("isssss", $role_id, $name, $email,$phone,$password,$folder);
        if ($stmt1->execute()) {
            move_uploaded_file($tempname, $folder);
            
            // header("Location: admin-coach.php");
        } else {
        echo "Error executing statement: " . $stmt->error;
        }
} else {
    echo "Error preparing3 statement: " . $conn->error;
}
    } else {
        echo "<script>alert('Please enter an Image!')</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin-coach.css">
    <title>Coach List</title>
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
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Coach sign Up</h1>
            <label for="name">Coach Name:</label><br>
            <input type="text" name="name" placeholder="Coach name..." required><br>
            <label for="phone">Phone Number:</label><br>
            <input type="tel" name="phone" required placeholder="phone number ..."><br>
            <label for="email">Email:</label><br>
            <input type="text" name="email" required placeholder="email123@example.com"><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" required placeholder="password..."><br>
            <input type="file" placeholder="image" required name="image" required/><br>
            <input type="submit" id="submit-button">
        </form>
        <!-- ends form -->
                <div class="table-container">
                    <h1>Coach information</h1>   
                    <table>
                        <tr>
                            <th>user ID</th>
                            <th>Name</th>
                            <th>Phone Nb</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        <?php 
                        $role_id = 2;
                        $sql = "SELECT * FROM user WHERE role_id='$role_id'";
                        $result1 = mysqli_query($conn, $sql);
                        if($result1){
                        while($row =mysqli_fetch_assoc($result1)){
                        $id = $row['userId'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        echo '
                        <tr>
                        <td>'.$id.'</td>
                        <td>'.$name.'</td>
                        <td>'.$phone.'</td>
                        <td>'.$email.'</td>
                        <td>
                        <button id="update"><a href="update-coach.php?updateid='.$id.'" style="color: white; text-decoration:none;font-size:large;">Update</a></button>
                        <button id="delete"><a href="delete-coach.php?deleteid='.$id.'" style="color: white; text-decoration:none;font-size:large;">Delete</a></button>
                        </td>
                        </tr>
                        ';
                    }
                }
                mysqli_query($conn, $sql);
                ?>
                    </table>
<!-- ends table -->
        </div>
    </div>
    <!-- ends all -->
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
</body>
</html>