<?php

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
echo "<div class='hotel-details-container'>"; // Container for all hotel content
while ($row = $res->fetch_assoc()) {

    // display the hotel information once
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

    }
    $hotelDisplayed = true;

    // display room title once
    if ($roomDisplayed == false) {
        echo "<section>";
        echo "<h2>Rooms</h2>";
        echo "<div class='room-cards'>";
    }
    $roomDisplayed = true;

    // display room information card
    echo "<div class='room-container'>";
    echo '<div><img src="../images/rooms/' . htmlspecialchars($row['room_image']) . '" alt="' . htmlspecialchars($row['accommodation']) . '">';
    echo "<div class='room-details'>";
    echo "<h3>" . htmlspecialchars($row['accommodation']) . "</h3>";
    echo "<p> " . htmlspecialchars($row['bed']) . " $" . htmlspecialchars($row['price']) . "</p>";
    $roomDetails = explode("++", $row['room_details']);

    foreach ($roomDetails as $detail) {
        echo "<p>" . nl2br(htmlspecialchars($detail)) . "</p>";
    }
    echo "</div></div>";
    echo "<a href='booking.php?roomid=" . urlencode($row['room_id']) . "'>Reserve</a>";
    echo "</div>";

    // Close room-details
}
echo "</div></section>";

// Now display the reviews
echo "<div class='hotel-reviews'>";
echo "<h2>User Reviews</h2>";

if (loggedIn()) {
    // Display a button that links to the review submission page
    echo "<a href='submit_review.php?hotelid=" . urlencode($code) . "' class='write-review-button'>Write Review</a>";
} else {
    // user not logged in
    // Display a button that links to the login page
    echo "<a href='login.php' class='write-review-button'>Write Review</a>";
}
if ($reviewsResult->num_rows > 0) {
    while ($review = $reviewsResult->fetch_assoc()) {
        // display the reviews
        if (!empty($review['rating']) && !empty($review['comment'] && !empty($review['created_at']))) {
            $userInitials = $review['first_name'] . " " . $review['last_name'][0] . ".";
            echo "<div class='review'>";
            echo "<p>Rating: " . str_repeat('★', $review['rating']) . "</p>";
            echo "<p> By: $userInitials</p>";
            echo "<p>Comment: " . htmlspecialchars($review['comment']) . "</p>";
            echo "<p>Date: " . htmlspecialchars($review['created_at']) . "</p>"; // 
            echo "</div>";
        }

    }
} else {
    echo "<p>No reviews yet. Be the first to write a review!</p>";
}


echo "</div>"; // Close the hotel-reviews div
$reviewsResult->free_result();
$avgRatingResult->free_result();


$res->free_result();
include('footer.php');
$db->close();
?>