<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../helper/function.php");
require("header.php");

// Assuming you have a session started and a user logged in
session_start();
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && $userId) {
    $hotel_id = $_POST['hotel_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Insert the review into the database
    $query = "INSERT INTO reviews (hotel_id, user_id, rating, comment) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("iiis", $hotel_id, $userId, $rating, $comment);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Thank you for your review!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$hotel_id = isset($_GET['hotelid']) ? $_GET['hotelid'] : null;
?>

<h2>Write a Review</h2>
<form action="submit_review.php" method="post">
    <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
    <label for="rating">Rating:</label>
    <input type="number" id="rating" name="rating" required min="1" max="5">
    <label for="comment">Comment:</label>
    <textarea id="comment" name="comment" required></textarea>
    <input type="submit" value="Submit Review">
</form>

<?php
require("footer.php");
?>
