<?php
echo'
<html>
<head>
    <meta charset="utf-8" />
    <title>Pet Ventures</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <a href="index.php"><img src="../images/logo/logo.svg" alt="logo"></a>
        <div>
          ';
            if (isset($_SESSION['valid_user']))
                echo "<a class=\"nav\"  href=\"logout.php\">Logout</a>";
            else
                echo "<a class=\"nav\" href=\"login.php\">Login</a>";
echo'
            |
            <a class="nav" href="signup.php">Signup</a>
        </div>

    </header>';
    echo'<form action="searchResults.php" method="POST" style="display:flex; justify-content: center;">
<div>
<label> Place </label>
<input id="search" name="search" type="text" placeholder="Country">
</div>
<div>
<label>Check in</label>
<input id="date" name="startdate" type="date">
</div>
<div>
<label>Check out</label>
<input id="date" name="enddate" type="date">
<input id="submit" type="submit" value="Search">
</div>
</form>';
    ?>