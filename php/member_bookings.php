<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// include_once("../helper/function.php");
require_once("header.php");

// Search for bookings with member id
$member_id = $_SESSION['valid_user'];

$query_str = "SELECT booking.booking_id, booking.room_id, booking.total_price, room.room_image, room.accommodation FROM booking JOIN room on booking.room_id = room.room_id WHERE member_id = ?";
$stmt = $db->prepare($query_str);
$stmt->bind_param('s', $member_id);
$stmt->execute();
$res = mysqli_stmt_get_result($stmt);
?>

<!-- display booking details -->
<div class="booking-history">
    <h1>Booked Rooms</h1>
    
    <?php
    if($res->num_rows == 0){
        echo "<p style='text-align:center;'>Nothing Added to Booking List. Browse our home page and add your first booking</p><a class='no-results' href='index.php'>Browse Hotels</a>";
        }
    while ($row = $res->fetch_assoc()) {
        format_booking_details($row['booking_id'], $row['room_id'], $row['total_price'], $row['room_image'], $row['accommodation']);
    }
?>
</div>

<?php
$res->free_result();
$db->close();
include('footer.php');
?>