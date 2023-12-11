<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// include_once("../helper/function.php");
require_once("header.php");

$hotelDisplayed = false;
$roomDisplayed = false;
// Retrieve and trim the hotel code from the GET request
$code = trim($_GET['hotelid']);
// Retrieve and trim any message passed in the GET request, using @ to suppress errors if 'message' is not set
@$msg = trim($_GET['message']);

$query_str = "SELECT * FROM hotel JOIN room ON hotel.hotel_id = room.hotel_id WHERE hotel.hotel_id=?";

$stmt = $db->prepare($query_str);
$stmt->bind_param('s', $code);
$stmt->execute();
$res = mysqli_stmt_get_result($stmt);

// Retrieve and display reviews for the hotel
$reviewsQuery = "SELECT rating, first_name, last_name, comment, created_at FROM reviews JOIN registered_member ON reviews.member_id = registered_member.member_id WHERE hotel_id = ? ORDER BY created_at DESC";
$reviewsStmt = $db->prepare($reviewsQuery);
$reviewsStmt->bind_param('i', $code); // $code is the hotel ID obtained from $_GET['hotelid']
$reviewsStmt->execute();
$reviewsResult = $reviewsStmt->get_result();

//retrieve the avg rating for the hotel
$avgRatingQuery = "SELECT AVG(rating) as rating FROM reviews WHERE hotel_id = ?";
$avgRatingStmt = $db->prepare($avgRatingQuery);
$avgRatingStmt->bind_param('i', $code); // $code is the hotel ID obtained from $_GET['hotelid']
$avgRatingStmt->execute();
$avgRatingResult = $avgRatingStmt->get_result();

// Fetch the result and display product details
echo "<div class='hotel-details-wrapper'>"; // Wrapper for hotel details and availability
echo "<div class='hotel-details-container'>"; // Container for all content
while ($row = $res->fetch_assoc()) {
    if ($hotelDisplayed == false) {
        echo "<div class='hotel-image-container'>";
        echo '<img class="hotel-img-detail" src="../images/hotels/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
        echo "</div>";
        echo "<div class='hotel-info'>";
        echo "<h1>" . htmlspecialchars($row['name']) . "</h1>";

        $avgRating = $avgRatingResult->fetch_assoc();
        if (!empty($avgRating['rating'])) {
            echo "<p>Rating: " . str_repeat('★', $avgRating['rating']) . "</p>";
        } else {
            echo "<p>Rating: No Ratings Yet</p>";
        }


        $services = explode(",", $row['services']);

        echo "<p>" . nl2br(htmlspecialchars($row['details'])) . "</p>";

        echo "<div><h2>Services</h2><div class='service-info'>";
        foreach ($services as $service) {
            echo "<p>" . nl2br(htmlspecialchars($service)) . "</p>";
        }
        echo "</div></div>";
        echo "<h2>Policies</h2><p>" . nl2br(htmlspecialchars(isset($row['policies']) ? $row['policies'] : '')) . "</p>";

        echo "</div>"; // Close hotel-info
        //echo "</div>"; // Close hotel-content

    }
    $hotelDisplayed = true;
  echo "<section>";
  if ($roomDisplayed == false) {
    echo "<h2>Rooms</h2>";}
    $roomDisplayed = true;
    echo "<div class='room-cards'><div class='room-container'>";
    echo '<img src="../images/rooms/' . htmlspecialchars($row['room_image']) . '" alt="' . htmlspecialchars($row['accommodation']) . '">';
    echo "<div class='room-details'>";
    echo "<h3>" . htmlspecialchars($row['accommodation']) . "</h3>";
    echo "<p> " . htmlspecialchars($row['bed']) . " $" . htmlspecialchars($row['price']) . "</p>";
    $roomDetails = explode("++", $row['room_details']);

    foreach ($roomDetails as $detail) {
        echo "<p>" . nl2br(htmlspecialchars($detail)) . "</p>";
    }
    echo"</div>";
    echo "<a href='booking.php?roomid=" . urlencode($row['room_id']) . "'>Reserve</a>";
    echo "</div></div></section>"; // Close room-details
}

// Now display the reviews
echo "<div class='hotel-reviews'>";
echo "<h2>User Reviews</h2>";


if ($reviewsResult->num_rows>0) {
    while ($review = $reviewsResult->fetch_assoc()) {
        if (!empty($review['rating']) && !empty($review['comment'] && !empty($review['created_at']))) {
            $userInitials = $review['first_name'] ." ". $review['last_name'][0].".";
            echo "<div class='review'>";
            echo "<p>Rating: " . str_repeat('★', $review['rating']) . "</p>";
            echo "<p> By: $userInitials</p>";
            echo "<p>Comment: " . htmlspecialchars($review['comment']) . "</p>";
            echo "<p>Date: " . htmlspecialchars($review['created_at']) . "</p>"; // Format date as needed
            echo "</div>";
        }

    }
} else {
    echo "<p>No reviews yet. Be the first to write a review!</p>";
}

if (loggedIn()) {
    // Display a button that links to the review submission page
    echo "<a href='submit_review.php?hotelid=" . urlencode($code) . "' class='write-review-button'>Write Review</a>";
}
else{
     // Display a button that links to the login page
     echo "<a href='login.php' class='write-review-button'>Write Review</a>";
}


echo "</div>"; // Close the hotel-reviews div
$reviewsResult->free_result();
$avgRatingResult->free_result();

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

// Check if the user is logged in before showing the review button
// if (isset($_SESSION['user_id'])) {
//     $hotel_id = $_GET['hotelid']; // Ensure you have the hotel's ID available
//     echo "<a href='submit_review.php?hotelid=" . $hotel_id . "' class='review-button'>Write Review</a>";
// } else {
//     echo "<p>You must be <a href='login.php'>logged in</a> to write a review.</p>";
// }

// $hotel_id = $_GET['hotelid'];
// $query = "SELECT * FROM reviews WHERE hotel_id = ?";
// $stmt = $db->prepare($query);
// $stmt->bind_param("i", $hotel_id);
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result->num_rows > 0) {
//     echo "<h2>User Reviews</h2>";
//     while ($review = $result->fetch_assoc()) {
//         echo "<div class='review'>";
//         echo "<p>Rating: " . htmlspecialchars($review['rating']) . "</p>";
//         echo "<p>Comment: " . htmlspecialchars($review['comment']) . "</p>";
//         echo "</div>";
//     }
// } else {
//     echo "<p>No reviews yet.</p>";
// }

// $stmt->close();
echo "</div>"; // Close .hotel-details

echo "<div class='availability-check'>";
// Form for checking availability
echo "<h2>Check Availability</h2>";
echo "<form action='check_availability.php' method='post'>";
echo "<label for='check-in'>Check-in</label>";
echo "<input type='date' id='check-in' name='check-in'>";
echo "<label for='check-out'>Check-out</label>";
echo "<input type='date' id='check-out' name='check-out'>";

echo "<div class='flex-inline'><div><label for='rooms'>Rooms</label>";
echo "<select id='rooms' name='rooms'>";
echo "<option value='1'>1 Room</option>";
// ... More options ...
echo "</select></div>";
echo "<div><label for='guests'>Guests</label>";
echo "<select id='guests' name='guests'>";
echo "<option value='3'>3 Adults</option>";
// ... More options ...
echo "</select></div></div>";
echo "<input type='submit' value='Check Availability'>";
echo "</form>";
echo "</div>"; // Close availability-check

echo "</div>"; // Close hotel-detail-container

$res->free_result();
include('footer.php');
$db->close();
?>