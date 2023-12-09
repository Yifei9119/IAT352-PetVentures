<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../helper/function.php");
require("header.php");

  // Define a query string to select product codes and names from the products table
  $query_str = "SELECT hotel.hotel_id, hotel.name, hotel.image, hotel.province, MIN(room.price) as price FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id GROUP BY hotel_id";

  $res = $db->query($query_str);
 
if ($res === false) {
  
  echo "Error: " . htmlspecialchars($db->error);
  
  exit;
}

if ($res->num_rows == 0) {
  echo "No hotels found.";
  exit;
}
// Echo the HTML for the hero image right after your header include
// echo '<div class="hero-image">';
// echo '<img src="../images/hotels/dog.jpeg" alt="A backgroup of a dog" class="center">';
// echo '</div>';
echo "<section class='landing-image'>";
echo "<div class='absolute-pos'><h1 class='title'>Pet-Friendly Hotels in Canada</h1>";
echo "<p class='title-p'>Browse through pet-friendly hotels in Canada. PetVentures provides the best accommodations for your pets.</p></div>";
echo "</section>";
  echo "<section class='padding-top'>";
  // Iterate through each row in the query result
  echo "<div id=hotel-cards>";
  while ($row = $res->fetch_assoc()) {
    // Format each hotel model as a link
    format_hotel_name_as_link($row["hotel_id"], $row["name"], $row['price'], $row['province'], $row['image'], "hoteldetails.php");
  };
  echo "</div></section>";
  
  include('footer.php');
  $res->free_result();
  $db->close();
?>
