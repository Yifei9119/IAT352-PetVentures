<?php

require_once("header.php");
// Retrieve room info
$code = trim($_REQUEST['roomid']);
$selectedHotelQuery = "SELECT room_id, accommodation, room_details, amenities, bed, price, view, room_image FROM room WHERE room.room_id = ?";
$roomStmt = $db->prepare($selectedHotelQuery);
$roomStmt->bind_param('s', $code);
$roomStmt->execute();
$res = mysqli_stmt_get_result($roomStmt);

$room_id = "";
$room_image = "";
$accommodation = "";
$price = "";
while ($row = $res->fetch_assoc()) {
    $room_id = $row['room_id'];
    $room_image = $row['room_image'];
    $accommodation = $row['accommodation'];
    $price = $row['price'];
}

if (isset($_POST['submit'])) {
    // Not logged in
    if (empty($_SESSION['valid_user'])) {
        // Save guest details to create new registered_member
        $firstName = !empty($_POST["firstName"]) ? trim($_POST["firstName"]) : "";
        $lastName = !empty($_POST["lastName"]) ? trim($_POST["lastName"]) : "";
        $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
        $username = !empty($_POST["username"]) ? trim($_POST["username"]) : "";
        $contactNumber = !empty($_POST["contactNumber"]) ? trim($_POST["contactNumber"]) : "";

        // Confirm card details to purchase
        $ccNumber = !empty($_POST["ccNumber"]) ? trim($_POST["ccNumber"]) : "";
        $ccExpiry = !empty($_POST["ccExpiry"]) ? trim($_POST["ccExpiry"]) : "";
        $ccCVV = !empty($_POST["ccCVV"]) ? trim($_POST["ccCVV"]) : "";
        $ccName = !empty($_POST["ccName"]) ? trim($_POST["ccName"]) : "";

        if (!$firstName || !$lastName || !$contactNumber || !$username || !$email || !$ccExpiry || !$ccCVV || !$ccName) {
            //If not all details have been filled
            $message = "Please fill in all fields.";
            // echo 'FNAME: '.$firstName . ' LNAME: '.$lastName ." Cont: ".$contactNumber . ' Email: '.$email  .' ccName: '.$ccName  .' ccExp: '.$ccExpiry  .' ccCVV: '.$ccCVV  .' ccNum: '.$ccNumber;
            echo "<script>alert('$message');</script>";
        } else {
            // Add user to database with contact number as password
            $number_encrypted = password_hash($contactNumber, PASSWORD_DEFAULT);
            // Insert query to add to registered_member
            $query = "INSERT INTO registered_member (email, password, first_name,last_name, member_id) ";
            $query .= "VALUES (?,?,?,?,?)";

            $stmt = $db->prepare($query);
            $stmt->bind_param('sssss', $email, $number_encrypted, $firstName, $lastName, $username);
            $stmt->execute();
            // $member_id = mysqli_insert_id($db);
            $_SESSION['valid_user'] = $username;
            // Create booking with registered_member ID
            $query = "INSERT INTO booking (pet_info, options, total_price, room_id, member_id) ";
            $query .= "VALUES (?,?,?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('sssss', $pet_info, $options, $price, $room_id, $username);
            $stmt->execute();
            // echo $query;

            $bookid = mysqli_insert_id($db);
            redirect_to("confirm_booking.php?bookid=" . $bookid);
        }
    } else {
        // User is logged in
        $pet_info = "";
        $options = "";
        $total_price = $price;
        $member_id = $_SESSION['valid_user'];

        $query = "INSERT INTO booking (pet_info, options, total_price, room_id, member_id) ";
        $query .= "VALUES (?,?,?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('sssss', $pet_info, $options, $total_price, $room_id, $member_id);
        $stmt->execute();
        // echo $query;

        $bookid = mysqli_insert_id($db);
        redirect_to("confirm_booking.php?bookid=" . $bookid);
    }
}
?>

<div class="booking-wrapper">
    <div class="form-container">
        <h1>Book a Pet-Friendly Room</h1>
        <!-- Check if user is logged in, if not, display Guest Details form -->
        <!-- if not a user, insert information above to registered_member and create the account for the user -->
        <?php
        echo "<form action='booking.php?roomid=$room_id' method='POST'>";
        if (empty($_SESSION['valid_user'])) {
            echo '<label> Guest Details </label>
                <input id="firstName" name="firstName" type="text" placeholder="First Name" required>
                <input id="lastName" name="lastName" type="text" placeholder="Last Name" required>
                <input id="username" name="username" type="text" placeholder="Username" required>
                <label for="contactNumber">Phone Number</label>
                <input id="contactNumber" type="text" name="contactNumber" placeholder="Phone Number">
                <label for="email">Email Address:</label>
                <input type="email" name="email" value="" placeholder="Email Address" required>
                <hr>';
        }
        ?>
        <!-- Payment Details -->
        <label for="ccNumber">Card Number</label>
        <input id="ccNumber" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number"
            maxlength="19" placeholder="xxxx xxxx xxxx xxxx">

        <label for="ccExpiry">Expiry</label>
        <input name="ccExpiry" type="tel" placeholder="MMYY">

        <label for="ccCVV">CVV</label>
        <input name="ccCVV" type="tel">

        <label for="ccName">Name on card</label>
        <input name="ccName" type="text">

        <?php $_POST['roomid'] = $room_id; ?>
        <input id="submit" type="submit" name="submit" value="Confirm Booking">
        </form>
    </div>

    <?php
    //get the id number from the room reserved and display the room information
    echo '<div class="booking-room-wrapper">
    <h2>Room ' . $room_id . '</h2>
    <img src="../images/rooms/' . $room_image . '" alt="' . $accommodation . '">
    <h3>' . $accommodation . '</h3>
    <h3>$' . $price . '</h3>
    </div>
    </div>
    ';

    $res->free_result();
    $db->close();
    include('footer.php');
    ?>