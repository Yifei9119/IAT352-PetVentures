<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// include_once("../helper/function.php");
require_once("header.php");

$booking_price = "";
$pet_info = "";
$options = "";
$room_id = "";
$member_id = "";

if (!empty($_REQUEST['bookid'])) { 
    $booking_id = $_REQUEST['bookid'];
     
    $query_str = "SELECT * FROM booking WHERE booking_id = ?";
    $stmt = $db->prepare($query_str);
    $stmt->bind_param('s', $booking_id);
    $stmt->execute();
    $res = mysqli_stmt_get_result($stmt);
    
    // if ($res === false) {
    //     echo "Error: " . htmlspecialchars($db->error);
    //     exit;
    // }
    // if ($res->num_rows == 0) {
    //     echo "No hotels found.";
    //     exit;
    // }

    while ($row = $res->fetch_assoc()) {
        $booking_price = $row['total_price'];
        $pet_info = $row['pet_info'];
        $options = $row['options'];
        $room_id = $row['room_id'];
        $member_id = $row['member_id'];
    }

    $res->free_result();
    $db->close();
}

?>

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