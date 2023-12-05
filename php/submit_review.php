<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../helper/function.php");
require("header.php");


// Fetch hotels for the dropdown
$hotelsQuery = "SELECT hotel_id, name FROM hotel";
$hotelsStmt = $db->prepare($hotelsQuery);
$hotelsStmt->execute();
$hotelsResult = $hotelsStmt->get_result();
$hotelsStmt->close();

// Handle the POST request from the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotel_id = $_POST['hotel_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Insert the review into the database
    $insertQuery = "INSERT INTO reviews (hotel_id, rating, comment) VALUES (?, ?, ?)";
    $insertStmt = $db->prepare($insertQuery);
    $insertStmt->bind_param("iis", $hotel_id, $rating, $comment);
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
$reviewsStmt->close();
?>

<div class="main-content">
<div class="review-form-container">
    <h2>Submit Your Review</h2>
    <form action="submit_review.php" method="post">
        <label for="hotel_id">Choose a hotel:</label>
        <select id="hotel_id" name="hotel_id" required>
            <?php while ($hotel = $hotelsResult->fetch_assoc()): ?>
                <option value="<?php echo $hotel['hotel_id']; ?>"><?php echo htmlspecialchars($hotel['name']); ?></option>
            <?php endwhile; ?>
        </select>
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" required min="1" max="5">
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" required></textarea>
        <input type="submit" value="Submit Review">
    </form>
</div>
</div>

<div class="reviews-container">
    <h2>Customer Reviews</h2>
    <?php while($review = $reviewsResult->fetch_assoc()): ?>
        <div class="review">
            <p>Hotel: <?php echo htmlspecialchars($review['name']); ?></p>
            <p>Rating: <?php echo str_repeat('★', $review['rating']); ?></p>
            <p>Comment: <?php echo htmlspecialchars($review['comment']); ?></p>
        </div>
    <?php endwhile; ?>
</div>

<?php
require("footer.php");
$db->close();
?>
