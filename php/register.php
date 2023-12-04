<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../helper/function.php');
require_SSL();

if (isset($_POST['submit'])) { // detect form submission

    // detect if each variable is set (fname, lname, email, password, sid, faculty)
    $fname = !empty($_POST["fname"]) ? trim($_POST["fname"]) : "";
    $lname = !empty($_POST["lname"]) ? trim($_POST["lname"]) : "";
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = !empty($_POST["password"]) ? $_POST["password"] : "";
    $password2 = !empty($_POST["password2"]) ? $_POST["password2"] : "";
       // Check if passwords match
    if($password != $password2) {
        $message = "Passwords do not match.";
    }
    // Check if all fields are filled
    else if (!$fname || !$lname || !$email || !$password) {
    	$message = "All fields manadatory.";
    }
    else {
        $pw_encrypted = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an INSERT query to add the new user to the database
        $query = "INSERT INTO users (email, password, firstName,lastName) ";
        $query .= "VALUES (?,?,?,?)";
      
      	$stmt = $db->prepare($query);
		$stmt->bind_param('ssss',$email,$pw_encrypted,$fname,$lname);
		$stmt->execute();
        echo $query;

        // Redirect to the login page after successful registration
        redirect_to('login.php');
    }
}
else {
    $fname = "";
    $lname = "";
    $email = "";
    $s_id = "";
    $faculty = "";
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
        align-items: center;
        background: #f7f7f7;
    }

    /* Container for the form to align it to the center */
    .form-container {
        width: 350px;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    /* Style for the form inputs */
    input[type=text], input[type=email], input[type=password], input[type=submit] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        display: block;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Style for the submit button */
    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    /* Hover effect for the submit button */
    input[type=submit]:hover {
        opacity: 0.8;
    }
    
    .message {
        color: red; /* Or any color you wish for error messages */
    }
</style>

<div class="form-container">
    <h2>Register for an account</h2>
    <form action="register.php" method="post">
        <label for="fname">First Name:</label>
        <input name="fname" type="text" value="<?php echo htmlspecialchars($fname); ?>" required>

        <label for="lname">Last Name:</label>
        <input type="text" name="lname" value="<?php echo htmlspecialchars($lname); ?>" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="password2">Confirm Password:</label>
        <input type="password" name="password2" required>

        <input type="submit" name="submit" value="Register">
        
        <?php if(!empty($message)) echo '<p class="message">' . $message . '</p>' ?>
    </form>
</div>

<!-- 
            <h2>Register for a Classic Models account</h2>
            <form action="register.php" method="post">
                <label for="fname">First Name: <input name="fname" type="text" value="<?php $fname ?>"></label>
				<br/>
                <label for="lname">Last Name: <input type="text" name="lname" value="<?php $lname ?>"></label>
				<br/>
                <label for="email">Email Address: <input type="email" name="email" value="<?php $email ?>"></label>
				<br/>

                <label for="password">Password: <input type="password" name="password" value=""></label>
				<br/>
                <label for="password2">Password: <input type="password" name="password2" value=""></label>
				<br/>


                <input type="submit" name="submit" value="Register">
                <?php if(!empty($message)) echo '<p class="message">' . $message . '</p>' ?>
            </form> -->


<?php
	require('footer.php');
    $db->close();
?>