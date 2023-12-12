<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('header.php');
require_SSL();

// Check if the form is not submitted
if (!isset($_POST['submit'])) { // detect form submission

    $email = $pass = "";

} else {
    // Retrieve and trim email and password from the POST data if they exist
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = !empty($_POST["password"]) ? trim($_POST["password"]) : "";
    $user_id= !empty($_POST["member_id"]) ? trim($_POST["member_id"]) : "";
    // Prepare a query to fetch the user's email and hashed password from the database
    $query = "SELECT member_id, password FROM registered_member";
    $query .= " WHERE email = ?";

	$stmt = $db->prepare($query);
	$stmt->bind_param('s',$email);
	$stmt->execute();
	$stmt->bind_result($user_id,$pass2_hash);
	
// Check if user exists and password is correct
    if($stmt->fetch() && password_verify($password,$pass2_hash)) {
        $_SESSION['valid_user'] = $user_id;
        // // Set default callback URL and update it if it exists in the session
        $callback_url = "index.php";
        redirect_to($callback_url);
        // if (isset($_SESSION['callback_url']))
        // 	$callback_url = $_SESSION['callback_url'];
        // //switch back to non-secure http
        // redirect_to($callback_url);
    }
    else $message = "Sorry, email and password combination not registered. <a href=\"\">Forgot?</a>";
}

?>
<div class="flex">
<div class="form-container">
    <h2>Login</h2>
    <?php if(!empty($message)) echo '<p>' . $message . '</p>' ?>
    <form action="login.php" method="post">
        <label for="email">Email Address:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <input type="submit" name="submit" value="Login">
    </form>
    <p>Don't have an account? <a class="underline" href="register.php">Register here.</a></p>
</div>
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
	require_once('footer.php');
?>