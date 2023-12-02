<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../helper/function.php");
require("header.php");

//move this to a function later
echo'<form action="index.php" method="POST" style="display:flex; justify-content: center;">
<div>
<label> Place </label>
<input id="search" name="search" type="text" placeholder="Country">
</div>
<div>
<label>Check in</label>
<input id="date" name="startdate" type="date">
</div>
<div>
<label>Check out</label>
<input id="date" name="enddate" type="date">
<input id="submit" type="submit" value="Search">
</div>
</form>';

//Getting value of "search" variable from "script.js".

if (isset($_POST['search'])) {

  //Search box value assigning to $Name variable.
  
     $Name = $_POST['search'];
  
  //Search query.
  
     $Query = "SELECT province FROM hotel WHERE province LIKE '%$Name%'";
     //** remember to edit to use prepare statements */
  
  //Query execution
  
     $execQuery = MySQLi_query($db, $Query);
  
  
  
     //Fetching result from database.
  
     while ($result = MySQLi_fetch_array($execQuery)) {
  
      
  
    //       Calling javascript function named as "fill" found in "script.js" file.
  
    //       By passing fetched result as parameter.
  
     echo'<li onclick="fill"' . $result['province'] .'">';
  
     echo "<a>";
  
    //  Assigning searched result in "Search box" in "index.php" file.
      echo $result['province'];
        //  echo hotelCards($result['province']);
        echo"</a>";

  }}
  

require("footer.php");
?>