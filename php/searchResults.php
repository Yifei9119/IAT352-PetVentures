<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../helper/function.php");
require("header.php");
searchbar();  
// **IMPORTANT this whole page needs to be updated using js

//Getting value of "search" variable from "script.js".
if (isset($_POST['search']) && !empty($_POST['search'])) {

    //Search box value assigning to $Name variable.
    
       $Name = $_POST['search'];
    
    //Search query.
    
       $query_str = "SELECT hotel.hotel_id, hotel.name, hotel.image, hotel.province, MIN(room.price) as price FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id WHERE hotel.province LIKE '%$Name%' GROUP BY hotel_id";
       //** remember to edit to use prepare statements */
    
    //Query execution
       $res = $db->query($query_str);
    
        echo "<section>";
        echo "<h1>Pet-Friendly Hotels in $Name</h1>";
       //Fetching result from database.
       // Iterate through each row in the query result
       while ($row = $res->fetch_assoc()) {
        //  echo "<li onclick='fill'>";
        format_hotel_name_as_link($row["hotel_id"], $row["name"], $row['price'], $row['province'], $row['image'], "hoteldetails.php");
       };
       echo "</section>";

    //    while ($result = MySQLi_fetch_array($execQuery)) {
    
        
    
    //   //       Calling javascript function named as "fill" found in "script.js" file.
    
    //   //       By passing fetched result as parameter.
    
    //    echo'<li onclick="fill"' . $result['province'] .'">';
    
    //    echo "<a>";
    
    //   //  Assigning searched result in "Search box" in "index.php" file.
    //     echo $result['province'];
    //       //  echo hotelCards($result['province']);
    //       echo"</a>";
  
    // }}
}
else{
    
}
    include('footer.php');
?>