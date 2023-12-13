<?php

require_once("header.php");
$userResult = userResult($db, $current_user);

// display editing personal information form
while ($row = $userResult->fetch_assoc()) {
    $email = $row['email'];

    echo '<div class="flex">
    <div class="form-container">
        <h2>Edit Your Personal Information</h2>
        <form action="accountInfo.php" method="post">
    <div class="flex-inline"><div><label for="fname">First Name:</label>
    <input name="fname" type="text" value="' . $row['first_name'] . '" required>
</div><div>
    <label for="lname">Last Name:</label>
    <input type="text" name="lname" value="' . $row['last_name'] . '" required>
</div></div>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="password2">Confirm Password:</label>
    <input type="password" name="password2" required>

    <input type="submit" name="submit" value="Submit">
    </form>
    </div</div>
    ';

    if (!empty($_SESSION['message'])) {
        echo "<p class='success-message'>" . $_SESSION['message'] . "</p>";
        $_SESSION['message'] = '';
    } 
}

if (isset($_POST['submit'])) { // detect form submission

    // detect if each variable is set (fname, lname, password,)
    $fname = !empty($_POST["fname"]) ? trim($_POST["fname"]) : "";
    $lname = !empty($_POST["lname"]) ? trim($_POST["lname"]) : "";
    $password = !empty($_POST["password"]) ? $_POST["password"] : "";
    $password2 = !empty($_POST["password2"]) ? $_POST["password2"] : "";
    // Check if passwords match
    if ($password != $password2) {
        $message = "Passwords do not match.";
        echo "<script>alert('$message');</script>";
    }
    // Check if all fields are filled
    else if (!$fname || !$lname || !$password) {
        $message = "All fields mandatory.";
        echo "<script>alert('$message');</script>";
    } else {
        $pw_encrypted = password_hash($password, PASSWORD_DEFAULT);
        // Prepare an UPDATE query to update user info to the database
        $query = "UPDATE registered_member SET password=?, first_name = ?, last_name=? WHERE email=?";

        $stmt = $db->prepare($query);
        $stmt->bind_param('ssss', $pw_encrypted, $fname, $lname, $email);
        $stmt->execute();

        if ($stmt->error) {
            echo $stmt->error;
            exit();
        }
        // Reload page after successful registration and display success message
        $_SESSION['message'] = 'Personal information has been changed successfully';
        redirect_to('accountInfo.php');

    }
} else {
    $fname = "";
    $lname = "";
    $username = "";
    $email = "";
}

$userResult->free_result();
$db->close();

?>