<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../helper/function.php");
require("header.php");

  
  // Define a query string to select product codes and names from the products table
  $query_str = "SELECT * FROM hotel";
  $res = $db->query($query_str);
  
  // Function to create a clickable link for each product model
 
  
  echo "<h2>Pet-Friendly Hotels in Canada</h2>";
  
  echo "<ul>";
  // Iterate through each row in the query result
  while ($row = $res->fetch_assoc()) {
    echo "<li>";
    // Format each product model as a link
    format_hotel_name_as_link($row["hotel_id"], $row["name"],"hoteldetails.php");
    echo "</li>\n";
  };
  echo "</ul>";
  
  include('footer.php');
  $res->free_result();
  $db->close();
?>