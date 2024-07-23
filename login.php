<?php 
session_start();
require_once('db_connect.php');
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Prevent SQL injection by escaping user inputs (use prepared statements for production)
    $email = $conn->real_escape_string($email);
    

    // Query the user table for the provided username
    $query = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($query);
    

    if ($result->num_rows > 0) {
        // If a user with the provided username is found in the database, We then use the fetch_assoc() method to fetch the data from the first row of the result set as an associative array. This means that we can access the column values by their names. In this case, we retrieve the hashed password value and store it in the variable $hashedPassword.
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        

        // Use password_verify to check if the input password matches the hashed password
        if (password_verify($password, $hashedPassword)) {
            if($row['role_id']==3){
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $row['userId'];
                $_SESSION['user_role'] = $row['role_id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_phone'] =$row['phone'];
                header("Location: index.php"); // Redirect to the main page after successful login
            }else if($row['role_id']==1){
                $_SESSION['admin_id'] = $row['userId'];
                header("Location: admin-user.php"); // Redirect to the admin page after successful login
            }else if($row['role_id']==2){
                $_SESSION['email'] = $email;
                $_SESSION['coach_id'] = $row['userId'];
                $_SESSION['user_role'] = $row['role_id'];
                $_SESSION['coach_name'] = $row['name'];
                $_SESSION['coach_phone'] =$row['phone'];
                header("Location: coach.php"); // Redirect to the main page after successful login
            }
        } else {
            // If passwords do not match, display an error message
            
        echo "<script>alert('Incorrect Password !');</script>";
        }
    }else {
        // If the provided username does not exist, display an error message
        echo   "<script>alert('Invalid email !');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="left"></div>            
    <div class="right">
        <img src="images/c4gym-high-resolution-logo-transparent.png" id="logo" alt="">
        <p>Feeling sluggish? Hit the gym and turn that frown upside down. Exercise is a natural mood booster! Every workout is a step towards a stronger, healthier you.</p><br>
        <form action="" method="post">
            <label for="Email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email..." required>
            <label for="Password">Password</label>
            <input type="password" id="password" name="password" placeholder="Your password..." required>
            <button onclick="">Log in</button>
        </form>
            <p>If you dont have an account please click on <a href="./signup.php">sign up</a>.</p> 
    </div>
   
</body>
</html>