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
  <script src="../js/add_favorite.js"></script>

</head>

<body>

  <?php
  echo "<script>let isLogin = " . (isset($_SESSION['valid_user']) ? 'true' : 'false') . ";</script>";
  ?>
  <!-- navbar for search field -->
  <div class="nav">
    <header>
      <a href="index.php"><img src="../images/logo/logo.svg" alt="logo"></a>
      <form action="searchResults.php" id="searchResults" method="POST" style="display:flex; justify-content: center;">
        <div class="search">
          <input id="search" name="search" type="text" placeholder="Enter keyword, place, or title" required>
        </div>

        <div class="search">
          <input id="submit" type="submit" value="Search">
        </div>
      </form>
      <?php
      // check if user has logged_in and display the user's first and last name and the dropdown list
      // otherwise show the login and register buttons
      if (loggedIn()) {
        $userResult = userResult($db, $current_user);
        echo '<div class="dropdown"><button id="accountInfo" class="dropbtn">';
        while ($user = $userResult->fetch_assoc()) {
          if (!empty($user['first_name']) && !empty($user['last_name'])) {
            echo '<img src="../images/other/avatar.svg"><p>' .
              $user['first_name'] . " " . $user['last_name'][0] . '</p>';
          }
        }
        $userResult->free_result();
        echo '</button>
  <div class="dropdown-content">
    <a href="member_bookings.php">Bookings</a>
    <a href="favoriteList.php">Favourite List</a>
    <a href="logout.php">Logout</a>
  </div>
</div>';
      } else {
        echo "<div class='loginRegister'><a href=\"login.php\">Login</a>";
        echo '
            
            <a class="register" href="register.php">Register</a></div>';
      }
      echo ' </div></header></div>

    ';

      ?>