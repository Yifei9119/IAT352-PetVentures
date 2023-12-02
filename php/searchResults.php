<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../helper/function.php");
require("header.php");


//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {

    //Search box value assigning to $Name variable.
    
       $Name = $_POST['search'];
    
    //Search query.
    
       $query_str = "SELECT hotel_id, name, province FROM hotel WHERE province LIKE '%$Name%'";
       //** remember to edit to use prepare statements */
    
    //Query execution
       $res = $db->query($query_str);
    
    
       //Fetching result from database.
       echo "<ul>";
       // Iterate through each row in the query result
       while ($row = $res->fetch_assoc()) {
         echo "<li onclick='fill'>";
         // Format each product model as a link
         format_hotel_name_as_link($row["hotel_id"], $row["name"],"hoteldetails.php");
         echo "</li>\n";
       };
       echo "</ul>";

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
    include('footer.php');
?>