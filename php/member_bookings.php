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

<div class="booking-history">
    <h1>Booked Rooms</h1>
    <?php
    while ($row = $res->fetch_assoc()) {
        format_booking_details($row['booking_id'], $row['room_id'], $row['total_price'], $row['room_image'], $row['accommodation']);
        // To-do: add in booking times?
    }
?>
</div>

<?php
$res->free_result();
$db->close();
include('footer.php');
?>