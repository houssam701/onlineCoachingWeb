<?php
session_start();
require('db_connect.php');
if (!isset ($_SESSION['admin_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin-user.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Admin Home page</title>
</head>
<body>
<!-- begining of navbar -->
<nav>
    <ul class="sidebar">
      <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
      <li><a style="color:red" >Welcome Admin</a></li>
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
    <section class="tbl-container">

        <div class="counter-container">
                <h1>Statistics</h1>
                <?php 
                // Define the query
                $sql = "SELECT COUNT(*) as count FROM user WHERE role_id=3";

                // Execute the query
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // Fetch the result
                $row = $result->fetch_assoc();
                echo "<p> Number of users: " . $row['count']."</p>";
                } else {
                echo "0 results";
                }
                ?>
                <?php 
                // Define the query
                $sql = "SELECT COUNT(*) as count FROM requests WHERE status_id=2";

                // Execute the query
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // Fetch the result
                $row = $result->fetch_assoc();
                echo "<p> Number of clients: " . $row['count']."</p>";
                } else {
                echo "0 results";
                }
                ?>
            </div>

        <div class="tablecontainer">
            <div class="search">
                <h1>USERS information</h1>   
                <form id="searchForm">
                    <input type="text" class="search-input" id="searchInput" name="search" placeholder="Search by name">
                    <button type="button" class="submit-button" id="searchButton">Search</button>
                    <button type="button" class="submit-button" id="displayAllButton">Display All</button>
                </form>

            </div>
            <table id="dataTable">
                <thead>
                <th>user ID</th>
                    <th>Name</th>
                    <th>Phone Nb</th>
                    <th>Email</th>
                    <th>Actions</th>
                </thead>
                <tbody>

                </tbody>
            </table>
            </div>
            <!-- ends table of users -->
            <div class="tablecontainer" id="clients">
            <div class="search">
                <h1>CLIENTS information</h1>   
                <form id="searchForm">
                    <input type="text" class="search-input" id="searchTerm" name="search" placeholder="Search by name">
                    <button type="button" class="submit-button" id="searchButton2">Search</button>
                    <button type="button" class="submit-button" id="displayAllButton2">Display All</button>
                </form>

            </div>
            <table >
                <thead>
    

                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Coach Name</th>
                    <th>Registration Date</th>
                </thead>
                <tbody  id="resultsTable">

                </tbody>
            </table>
            </div>
        
    </section>
    <!-- ends table of clients -->
    <script src="./javaScript/admin-user.js"></script>
    <script src="./javaScript/getting-clients.js"></script>
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
<?php  
mysqli_close($conn);
?>