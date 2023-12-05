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
echo "<div class='hotel-details-wrapper'>"; // Wrapper for hotel details and availability
echo "<div class='hotel-details-container'>"; // Container for all content
while ($row = $res->fetch_assoc()) {
    if($hotelDisplayed==false){
    // echo "<section class='padding-top'>";
    // echo '<img class="hotel-img" width="200" src="../images/hotels/' . $row['image'] . '">';
	// echo "<h1>" .$row['name']."</h1>\n<p>".$row['location']."</p></section>";
	// echo "<section><h2>Description</h2><p>". $row['details'],"</p></section>
    //     <section><h2>Services</h2><p>". $row['services']."</p></section>
    //     <section><h2>Policies</h2><p>". $row['policies']."</p></section>
    //     ";
    //echo "<div class='hotel-content'>"; // Left side content
    //echo "<div class='hotel-image'>";
    echo "<div class='hotel-image-container'>"; 
    echo '<img class="hotel-img-detail" src="../images/hotels/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
    echo "</div>";
    echo "<div class='hotel-info'>";
    echo "<h1>" . htmlspecialchars($row['name']) . "</h1>";
    echo "<p>" . nl2br(htmlspecialchars($row['details'])) . "</p>";
    echo "<h2>Services</h2><p>" . nl2br(htmlspecialchars($row['services'])) . "</p>";
    echo "<h2>Policies</h2><p>" . nl2br(htmlspecialchars(isset($row['policies']) ? $row['policies'] : '')) . "</p>";

    echo "</div>"; // Close hotel-info
    //echo "</div>"; // Close hotel-content
    
    }
    $hotelDisplayed=true;
    echo "<div class='room-details'>";
    echo "<h2>Rooms</h2>";
    echo "<h3>" . htmlspecialchars($row['accommodation']) . "</h3>";
    echo "<p> " . htmlspecialchars($row['bed']) . " $" . htmlspecialchars($row['price']) . htmlspecialchars($row['room_details']) . "</p>";
    echo "</div>"; // Close room-details
    //echo"<section><h2>Rooms</h2><h3>". $row['accommodation']."</h3><p> ".$row['bed'] ." $".$row['price'].$row['room_details']."</p></section>";
	}

    echo "</div>"; // Close .hotel-details
    
echo "<div class='availability-check'>";
// Form for checking availability
echo "<h2>Check Availability</h2>";
echo "<form action='check_availability.php' method='post'>";
echo "<label for='check-in'>Check-in</label>";
echo "<input type='date' id='check-in' name='check-in'>";
echo "<label for='check-out'>Check-out</label>";
echo "<input type='date' id='check-out' name='check-out'>";
echo "<label for='rooms'>Rooms</label>";
echo "<select id='rooms' name='rooms'>";
echo "<option value='1'>1 Room</option>";
// ... More options ...
echo "</select>";
echo "<label for='guests'>Guests</label>";
echo "<select id='guests' name='guests'>";
echo "<option value='3'>3 Adults</option>";
// ... More options ...
echo "</select>";
echo "<button type='submit'>Check Availability</button>";
echo "</form>";
echo "</div>"; // Close availability-check

echo "</div>"; // Close hotel-detail-container

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