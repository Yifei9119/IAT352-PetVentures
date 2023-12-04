<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../helper/function.php");
require("header.php");

$hotelDisplayed = false;
// Retrieve and trim the hotel code from the GET request
$code = trim($_GET['hotelid']);
// Retrieve and trim any message passed in the GET request, using @ to suppress errors if 'message' is not set
@$msg = trim($_GET['message']);

$query_str = "SELECT * FROM hotel JOIN room ON hotel.hotel_id = room.hotel_id WHERE hotel.hotel_id=?"; 
			  
$stmt = $db->prepare($query_str);
$stmt->bind_param('s',$code);
$stmt->execute();
$res = mysqli_stmt_get_result($stmt);
// $stmt->bind_result($hotel_id,$name,$details,$services,$location,$policies,$contact,$avg_rating,$province, $image);
// Fetch the result and display product details
while ($row = $res->fetch_assoc()) {
    if($hotelDisplayed==false){
    echo "<section class='padding-top'>";
    echo '<img class="hotel-img" width="200" src="../images/hotels/' . $row['image'] . '">';
	echo "<h1>" .$row['name']."</h1>\n<p>".$row['location']."</p></section>";
	echo "<section><h2>Description</h2><p>". $row['details'],"</p></section>
        <section><h2>Services</h2><p>". $row['services']."</p></section>
        <section><h2>Policies</h2><p>". $row['policies']."</p></section>
        ";
    }
    $hotelDisplayed=true;
    echo"<section><h2>Rooms</h2><h3>". $row['accommodation']."</h3><p> ".$row['bed'] ." $".$row['price'].$row['room_details']."</p></section>";
	}

$stmt->free_result();

// Display add to favourite form if the user is logged in and the product is not already in the watchlist
// if(loggedIn() && !inWatchlist($code) ) {
// 	echo "<form action=\"addtowatchlist.php\" method=\"post\">\n";
// 	echo "<input type=\"hidden\" name=\"productCode\" value=$code>\n";
// 	echo "<input type=\"submit\" value=\"Add To Watchlist\">\n";
// 	echo "</form>\n";
// } else if (!empty($msg) ) {
// 	echo $msg;
// } else if (loggedIn()) {
// 	echo "This model is already in your <a href=\"showwatchlist.php\">watchlist</a>.";
// }

include('footer.php');
$db->close();

?>