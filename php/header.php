<?php
echo '
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
echo '
            |
            <a class="nav" href="register.php">Register</a>
        </div>

    </header>';

?>