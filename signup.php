<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the database connection
require_once('db_connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Securely hash the password
    $role_id=3;
    $sql4="SELECT * from user where email=?";
    $stmt4 = $conn->prepare($sql4);
    $stmt4->bind_param("s",$email);
    $stmt4->execute();
    $res=$stmt4->get_result();
    if($res->num_rows==0){
    $sql = "SELECT roleId FROM user_role WHERE roleId = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $role_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 0) {
            die("Error: The role_id does not exist in the roles table.");
        }
        $stmt->close();
        $sql2 = "INSERT INTO user (role_id, name, email,phone,password) VALUES (?, ?, ?, ?,?)";
        if ($stmt1 = $conn->prepare($sql2)) {
        $stmt1->bind_param("issss", $role_id, $name, $email,$phone,$password);
        if ($stmt1->execute()) {
            header("Location: login.php");
        } else {
        echo "Error executing statement: " . $stmt->error;
        }
} else {
    echo "Error preparing3 statement: " . $conn->error;
}
    } else {
        die("Error preparing statement: " . $conn->error);
    }
}else{
    echo   "<script>alert('Used email !');</script>";
}

}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <title>SignUp</title>
</head>
<body>
    <div class="left"></div>
    <div class="right">
        <img src="images/c4gym-high-resolution-logo-transparent.png" id="logo" alt="">
        <form action="" method="POST">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" placeholder="Enter your full name..." required>
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your number..." required>
            <label for="Email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email..." required>
            <label for="Password">Password</label>
            <input type="text" id="password" name="password" placeholder="Your password..." required>
            <button onclick="">SignUp</button>
        </form>
            <p>Challenge yourself. The gym is your place to prove what you're capable of achieving.</p>
            
    </div>
</body>
</html>