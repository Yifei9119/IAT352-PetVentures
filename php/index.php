
<?php
// session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// include_once("../helper/function.php");
require_once("header.php");

  // Define a query string to select product codes and names from the products table

// Echo the HTML for the landing image right after your header include

echo "<section class='landing-image'>";
echo "<div class='absolute-pos'><h1 class='title'>Pet-Friendly Hotels in Canada</h1>";
echo "<p class='title-p'>Browse through pet-friendly hotels in Canada. PetVentures provides the best accommodations for your pets.</p></div>";
echo "</section>";
  echo "<section class='section-padding'>";
  // Iterate through each row in the query result
  echo "<div id=hotel-cards>";
  require ("hotelCards.php");
  echo "</div></section>";

  if(loggedIn()){
  //  "uid" . $_SESSION['valid_user'];
  }
  
  include('footer.php');
//  $res->free_result();
//  $db->close();
?>
