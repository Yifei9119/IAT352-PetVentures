<?php
include_once("../helper/function.php");
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Pet Ventures</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/registerLogin.css">
    <link rel="stylesheet" href="../css/hotel.css">
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/script.js"></script>
</head>

<body>
<<<<<<< Updated upstream
=======
    <?php
//session_start();
echo "<script>let isLogin = " . (isset($_SESSION['valid_user']) ? 'true' : 'false') . ";</script>";
$userQuery = "SELECT first_name, last_name, member_id FROM registered_member WHERE member_id=?";
global $db;
$userStmt = $db->prepare($userQuery);
$userStmt->bind_param('s', $current_user);
$userStmt->execute();
$userResult = mysqli_stmt_get_result($userStmt);

?>
>>>>>>> Stashed changes
    <div class="nav">
        <header>
            <a href="index.php"><img src="../images/logo/logo.svg" alt="logo"></a>
            <form action="searchResults.php" method="POST" style="display:flex; justify-content: center;">
                <div class="search">
<!--                    <label> Place </label>-->
<!--                    <input id="search" name="search" type="text" placeholder="Country">-->
                    <?php
                    dropdownButton("Province", ["All", "Alberta", "Ontario", "British Colombia", "Quebec"]);
                    ?>
                </div>
                <div class="search">
                    <!--                    <label> Place </label>-->
                    <!--                    <input id="search" name="search" type="text" placeholder="Country">-->
                    <?php
                    dropdownButton("Availability", ["All", "1", "2", "3", "4", "5"]);
                    ?>
                </div>
                <div class="search">
                    <label>Check in</label>
                    <input id="startdate" name="startdate" type="date">
                </div>
                <div class="search">
                    <label>Check out</label>
                    <input id="enddate" name="enddate" type="date">
                </div>
                <div class="search">
                    <input id="submit" type="submit" value="Search">
                </div>
            </form>
            <?php
if (isset($_SESSION['valid_user'])){
  $userResult = userResult($db, $current_user);
echo '<div class="dropdown">
  <button id="accountInfo" class="dropbtn">';
  while($user = $userResult->fetch_assoc()){
    if(!empty($user['first_name']) && !empty($user['last_name'])){
    echo   '<img src="../images/other/avatar.svg"><p>'.
    $user['first_name'] . " ". $user['last_name'][0] .'</p>';
    }
  } 
  $userResult->free_result();
  echo'</button>
  <div class="dropdown-content">
    <a href="member_bookings.php">Bookings</a>
    <a href="favoriteList.php">Favourite List</a>
    <a href="logout.php">Logout</a>
  </div>
</div>';
}
else{
    echo "<div class='loginRegister'><a href=\"login.php\">Login</a>";
echo '
            
            <a class="register" href="register.php">Register</a></div>';
}
       echo' </div></header></div>

    ';

?>