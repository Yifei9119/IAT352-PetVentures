<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../helper/function.php');
require_SSL();

// Check if the form is not submitted
if (!isset($_POST['submit'])) { // detect form submission

    $email = $pass = "";

} else {
    // Retrieve and trim email and password from the POST data if they exist
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = !empty($_POST["password"]) ? trim($_POST["password"]) : "";
    // Prepare a query to fetch the user's email and hashed password from the database
    $query = "SELECT email, password FROM registered_member ";
    $query .= "WHERE email = ?";

	$stmt = $db->prepare($query);
	$stmt->bind_param('s',$email);
	$stmt->execute();
	$stmt->bind_result($email2,$pass2_hash);
	
// Check if user exists and password is correct
    if($stmt->fetch() && password_verify($password,$pass2_hash)) {
        $_SESSION['valid_user'] = $email;
        // // Set default callback URL and update it if it exists in the session
        // $callback_url = "showwatchlist.php";
        // if (isset($_SESSION['callback_url']))
        // 	$callback_url = $_SESSION['callback_url'];
        // //switch back to non-secure http
        // redirect_to($callback_url);
    }
    else $message = "Sorry, email and password combination not registered. <a href=\"\">Forgot?</a>";
}

require('header.php');

?>

<style>
    /* Style for the overall layout */
    html, body {
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center; /* This will vertically center the form-container */
        background: #f7f7f7; /* Just an example background color */
    }

    /* Container for the form to align it to the center */
    .form-container {
        width: 350px; /* Adjust the width as needed */
        padding: 20px;
        background-color: #fff; /* Background color for the form */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Simple shadow for depth */
        border-radius: 5px; /* Rounded corners */
    }

    /* Style for the form inputs */
    input[type=email], input[type=password], input[type=submit] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        display: block;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Style for the submit button */
    input[type=submit] {
        background-color: #4CAF50; /* Adjust the color as needed */
        color: white;
        cursor: pointer;
    }

    /* Hover effect for the submit button */
    input[type=submit]:hover {
        opacity: 0.8;
    }
</style>

<div class="form-container">
    <h2>Sign in</h2>
    <?php if(!empty($message)) echo '<p>' . $message . '</p>' ?>
    <form action="login.php" method="post">
        <label for="email">Email Address:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <input type="submit" name="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register here.</a></p>
</div>

	<!-- <h2>Sign in</h2>
    

    <form action="login.php" method="post">
    <label for="email">Email Address: <input type="email" name="email" value="<?php $email ?>"></label>
    <br/>
    <label for="password">Password: <input type="password" name="password" value=""></label>
    <br/>
    <input type="submit" name="submit" value="Submit">
            </form>
	<p><a href="register.php">Not registered yet? Register here.</a></p> -->


<?php 
	require('footer.php');
?>