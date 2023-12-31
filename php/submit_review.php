<?php

require_once("header.php");

// Fetch hotels for the dropdown
$hotelsQuery = "SELECT hotel_id, name FROM hotel";
$hotelsStmt = $db->prepare($hotelsQuery);
$hotelsStmt->execute();
$hotelsResult = $hotelsStmt->get_result();

// Handle the POST request from the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotel_id = $_POST['hotel_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Insert the review into the database
    $insertQuery = "INSERT INTO reviews (hotel_id, member_id, rating, comment) VALUES (?, ?, ?, ?)";
    $insertStmt = $db->prepare($insertQuery);

    $insertStmt->bind_param("isis", $hotel_id, $current_user, $rating, $comment);
    $insertStmt->execute();

    if ($insertStmt->affected_rows > 0) {
        echo "<p>Thank you for your review!</p>";
    } else {
        echo "<p>Error: " . $insertStmt->error . "</p>";
    }


    $insertStmt->close();
}



// Retrieve all reviews
$reviewsQuery = "SELECT hotel.name, reviews.rating, reviews.comment FROM reviews JOIN hotel ON reviews.hotel_id = hotel.hotel_id ORDER BY reviews.created_at DESC";
$reviewsStmt = $db->prepare($reviewsQuery);
$reviewsStmt->execute();
$reviewsResult = $reviewsStmt->get_result();

echo '

<div class="main-content">
<div class="review-form-container">
    <h2>Submit Your Review</h2>
    <form action="submit_review.php" method="post">
        <label for="hotel_id">Choose a hotel:</label>
        <select id="hotel_id" name="hotel_id" required>';
while ($hotel = $hotelsResult->fetch_assoc()) {
    echo '<option value="' . $hotel['hotel_id'] . '">' . htmlspecialchars($hotel['name']) . '</option>';
}
echo '</select>
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" required min="1" max="5" placeholder="1">
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" rows="4" required></textarea>
        <input type="submit" value="Submit Review">
    </form>
</div>
</div>

<div class="reviews-container">
    <h2>Customer Reviews</h2>';
while ($review = $reviewsResult->fetch_assoc()) {
    echo '<div class="review">
            <p>Hotel: ' . htmlspecialchars($review['name']) . '</p>
            <p>Rating: ' . str_repeat('★', $review['rating']) . '</p>
            <p>Comment: ' . htmlspecialchars($review["comment"]) . '</p>
        </div>';
}
echo '</div>';
require("footer.php");
$hotelsResult->free_result();
$reviewsResult->free_result();
$db->close();
?>