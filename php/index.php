<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../helper/function.php");
require("header.php");

searchbar();  
  // Define a query string to select product codes and names from the products table
  $query_str = "SELECT hotel.hotel_id, hotel.name, hotel.image, hotel.province, MIN(room.price) as price FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id GROUP BY hotel_id";

  $res = $db->query($query_str);
 
  echo "<section>";
  echo "<h2>Pet-Friendly Hotels in Canada</h2><div id=hotel-cards>";
  // Iterate through each row in the query result

  while ($row = $res->fetch_assoc()) {
    // Format each hotel model as a link
    format_hotel_name_as_link($row["hotel_id"], $row["name"], $row['price'], $row['province'], $row['image'], "hoteldetails.php");
   
  };
  echo "</div></section>";
  
  include('footer.php');
  $res->free_result();
  $db->close();
?>