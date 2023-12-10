<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../helper/function.php");
require("header.php");
echo "<h1>Book a Pet-Friendly Room<h1>"; 
if(isset($_POST['submit'])){
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
}
?>
<form action="searchResults.php" method="POST" style="display:flex; justify-content: center;">

        <label> Guest Details </label>
        <input id="firstName" name="firstName" type="text" placeholder="First Name">
        <input id="lastName" name="lastName" type="text" placeholder="Last Name">
        <label for="contactNumber">Phone Number:</label>
        <input id="contactNumber" type="text" name="contactNumber" placeholder="Phone Number">
        <label for="email">Email Address:</label>
        <input type="email" name="email" value="<?php if(!empty($email)) echo htmlspecialchars($email); ?>" placeholder="Email Address" required>
  
        <input id="submit" type="submit" value="Next">
</form>
<!-- if not a user, insert information above to registered_member and create the account for the user -->

<?php
//get the id number from the room reserved and display the room information



include('footer.php');
?>