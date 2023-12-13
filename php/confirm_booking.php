<?php

require_once("header.php");

// select the booking information according to booking id and store in the variables
$booking_price = "";
$room_id = "";
$member_id = "";

if (!empty($_REQUEST['bookid'])) { 
    $booking_id = $_REQUEST['bookid'];
     
    $query_str = "SELECT * FROM booking WHERE booking_id = ?";
    $stmt = $db->prepare($query_str);
    $stmt->bind_param('s', $booking_id);
    $stmt->execute();
    $res = mysqli_stmt_get_result($stmt);

    while ($row = $res->fetch_assoc()) {
        $booking_price = $row['total_price'];
        $room_id = $row['room_id'];
        $member_id = $row['member_id'];
    }

    $res->free_result();
    $db->close();
}

?>

<!-- display booking information -->
<div class="booking-confirmation-wrapper">
    <h1>Booking Successful!</h1>
    <h2>Details</h2>
    <table class="booking-table">
        <tr>
            <th>Price: </th>
            <th><?php echo $booking_price; ?></th>
        </tr>
        <tr>
            <th>Room ID: </th>
            <th><?php echo $room_id; ?></th>
        </tr>

        <tr>
            <th>Member ID: </th>
            <th><?php echo $member_id; ?></th>
        </tr>
    </table>

    <form action="index.php">
        <input type="submit" name="submit" value="Return to hotels list">
    </form>
</div>

<?php
include('footer.php');
?>