
<?php 
session_start();
require('db_connect.php');


$id = $_GET['updateid'];
$ssql="SELECT * FROM user WHERE userId=$id";
$res=mysqli_query($conn,$ssql);
$row = mysqli_fetch_assoc($res);

$name=$row['name'];
$email=$row['email'];
$phone=$row['phone'];

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $name=$_POST['name'];  
    $phone=$_POST['phone']; 
    $email=$_POST['email']; 
    $file=$_FILES['image'];
    $file_name=$file['name'];   
    $tempname =$file['tmp_name'];
    $folder = 'coach-images/'.$file_name;
    $sql="UPDATE user 
    SET name='$name',phone='$phone',email='$email',image='$folder'
    WHERE userId=$id";
    $result=mysqli_query($conn,$sql);

    if($result){
      move_uploaded_file($tempname, $folder); 
    header('Location: admin-coach.php');
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
      <h1>Update Coach</h1>
      <label for="name">Name:</label><br>
      <input type="text"   name="name" required value="<?php echo $name; ?>"/>
      <label for="phone">phone:</label><br>
      <input type="text"   name="phone" required value="<?php echo $phone; ?>"/>
      <label for="email">Email:</label>
      <input type="text"  name="email"required value="<?php echo $email; ?>"/>
      <label for="image">image:</label>
      <input type="file"Iplaceholder="image" required  name="image"/><br>
      <button type="submit" id="submit-button">Submit</button>
    </form>
    <a href="admin-coach.php"> <button  id="submit-button" style="background-color: red;">Go Back</button></a>

  </div>
</body>
</html>