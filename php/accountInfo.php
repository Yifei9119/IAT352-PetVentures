<?php
require_once("header.php");

$userResult = userResult($db, $current_user);
while ($row = $userResult->fetch_assoc()) {
    echo '<form action="register.php" method="post">
    <div class="flex-inline"><div><label for="fname">First Name:</label>
    <input name="fname" type="text" value="' . $row['first_name'] . '" required>
</div><div>
    <label for="lname">Last Name:</label>
    <input type="text" name="lname" value="<?php echo htmlspecialchars($lname); ?>" required>
</div></div>

    <label for="email">Email Address:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

    <label for="username">Username:</label>
    <input name="username" type="text" value="<?php echo htmlspecialchars($username); ?>" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="password2">Confirm Password:</label>
    <input type="password" name="password2" required>

    <input type="submit" name="submit" value="Register">';
}

$userResult->free_result();
$db->close();

?>