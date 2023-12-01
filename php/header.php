<html>

<head>
    <title>Pet Ventures</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <a href="index.php"><img src="../images/logo.svg" alt="logo"></a>
        <div>
        <?php
        if (isset($_SESSION['valid_user']))
            echo "<a class=\"nav\"  href=\"logout.php\">Logout</a>";
        else
            echo "<a class=\"nav\" href=\"login.php\">Login</a>";
        ?>
        |
        <a class="nav" href="signup.php">Signup</a>
</div>

    </header>