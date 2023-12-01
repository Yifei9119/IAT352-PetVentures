<html>

<head>
	<title>Pet Ventures</title>

</head>

<body>
	<table>
		<tr>
			<td class="center" style="font-family: sans-serif; font-size:1.25rem">
            <a href="index.php"><img src="../images/logo.svg" alt="logo"></a>
					<?php
					if (isset($_SESSION['valid_user']))
						echo "<a class=\"nav\"  href=\"logout.php\">Logout</a>";
					else
						echo "<a class=\"nav\" href=\"login.php\">Login</a>";
					?>
                    |
                    <a class="nav" href="signup.php">Signup</a>
			</td>
		<tr style="background-color:FFFFFF;">
			<td>
