<script src="../js/script.js"></script>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("header.php");

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
// Echo the HTML for the landing image
echo "<section class='landing-image'>";
echo "<div class='absolute-pos'><h1 class='title'>Pet-Friendly Hotels in Canada</h1>";
echo "<p class='title-p'>Browse through pet-friendly hotels in Canada. PetVentures provides the best accommodations for your pets.</p></div>";
echo "</section>";
echo "<section class='section-title'>";
echo "<h1>Explore Our Hotels</h1>";

// show filering dropdown options
echo "<div class='flex-inline filter'>";
echo "<label class='filter'>Filter by: </label>";
dropdownButton("Province", ["All", "Alberta", "Ontario", "British Columbia", "Quebec"]);
dropdownButton("Availability", ["All", "1", "2", "3", "4", "5"]);
echo "</div>";

// Iterate through each row in the query result
echo "<div id=hotel-cards>";
while ($row = $res->fetch_assoc()) {
  // Format each hotel as a link
  format_hotel_name_as_link($row["hotel_id"], $row["name"], $row['price'], $row['province'], $row['image'], "hoteldetails.php");
}
;
echo "</div></section>";

include('footer.php');
$res->free_result();
$db->close();
?>