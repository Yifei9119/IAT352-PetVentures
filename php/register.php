<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('header.php');
require_SSL();

if (isset($_POST['submit'])) { // detect form submission

    // detect if each variable is set (fname, lname, email, password, sid, faculty)
    $fname = !empty($_POST["fname"]) ? trim($_POST["fname"]) : "";
    $lname = !empty($_POST["lname"]) ? trim($_POST["lname"]) : "";
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
    $username = !empty($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = !empty($_POST["password"]) ? $_POST["password"] : "";
    $password2 = !empty($_POST["password2"]) ? $_POST["password2"] : "";
    // Check if passwords match
    if ($password != $password2) {
        $message = "Passwords do not match.";
    }
    // Check if all fields are filled
    else if (!$fname || !$lname || !$email || !$password) {
        $message = "All fields mandatory.";
    } else {
        $pw_encrypted = password_hash($password, PASSWORD_DEFAULT);
        // Prepare an INSERT query to add the new user to the database
        $query = "INSERT INTO registered_member (email, password, first_name,last_name, member_id) ";
        $query .= "VALUES (?,?,?,?,?)";

        $stmt = $db->prepare($query);
        $stmt->bind_param('sssss', $email, $pw_encrypted, $fname, $lname, $username);
        $stmt->execute();

        // Redirect to the login page after successful registration
        redirect_to('login.php');
    }
} else {
    $fname = "";
    $lname = "";
    $username = "";
    $email = "";
}
?>
<!-- display registration form -->
<div class="flex">
    <div class="form-container">
        <h2>Register for an account</h2>
        <form action="register.php" method="post">
            <div class='flex-inline'>
                <div><label for="fname">First Name:</label>
                    <input name="fname" type="text" value="<?php echo htmlspecialchars($fname); ?>" required>
                </div>
                <div>
                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" value="<?php echo htmlspecialchars($lname); ?>" required>
                </div>
            </div>

            <label for="email">Email Address:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label for="username">Username:</label>
            <input name="username" type="text" value="<?php echo htmlspecialchars($username); ?>" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="password2">Confirm Password:</label>
            <input type="password" name="password2" required>

            <input type="submit" name="submit" value="Register">

            <?php if (!empty($message))
                echo '<p class="message">' . $message . '</p>' ?>
            </form>
        </div>
    </div>

    <?php
            require('footer.php');
            $db->close();
            ?>