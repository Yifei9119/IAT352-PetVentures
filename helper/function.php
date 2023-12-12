<?php
// Function to redirect to HTTP if currently on HTTPS
function no_SSL()
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
        header("Location: http://" . $_SERVER['HTTP_HOST'] .
            $_SERVER['REQUEST_URI']);
        exit();
    }
}

// Function to enforce SSL, redirecting to HTTPS if not already on it
function require_SSL()
{
    if ($_SERVER['HTTPS'] != "on") {
        header("Location: https://" . $_SERVER['HTTP_HOST'] .
            $_SERVER['REQUEST_URI']);
        exit();
    }
}

// Start the session
session_start();
// Establish database connection
$db = connection('localhost', 'root', '', 'hotel_models');

// Function to create a database connection and handle connection errors
function connection($dbhost, $dbuser, $dbpass, $dbname)
{
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (mysqli_connect_errno()) {
        //quit and display error and error number
        die("Database connection failed:" .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
        );
    }
    return $conn;
}

function format_hotel_name_as_link($id, $name, $price, $province, $image, $page)
{
    echo "<div class='hotel-card'>"; // Add this line to wrap each hotel in a card
    echo "<a href=\"$page?hotelid=$id\">";
    echo "<img class=\"hotel-img\" src=\"../images/hotels/$image\">"; // Make sure the image path is correct
    echo "<div class='hotel-favourite-grid'><div class='hotel-info card'>"; // Wrap the text in a div with class for styling
    echo "<h2 class='hotel-name'>$name</h2>"; // Add class for hotel name
    echo "<p class='hotel-price'>Starting at \$$price</p>"; // Add class for price
    echo "<p class='hotel-location'>$province</p>"; // Add class for location
    echo "</div></div>";
    echo "</a>";
    echo "<button class='svg-button addFavorite' data-guide-id='" . $id . "'>";
    echo "<p class='count' data-addFavorite-guide-id='" . $id . "'>";
    showStar();
    echo "</button>";
    echo "</div>";
}
function format_booking_action_link($id,$name,$page) {
	
	}
function format_booking_details($booking_id, $room_id, $price, $image, $accommodation)
{
    echo "<div class='booking-card'>";
    echo '<h2>Room ' . $room_id . '</h2>
        <img src="../images/rooms/' . $image . '" alt="' . $accommodation . '">
        <h3>' . $accommodation . '</h3>
        <h3>$' . $price . '</h3>';
        echo "<a class=\"booking-btn\" href=\"delete_member_booking.php?bookingid=$booking_id\">Cancel Booking</a>";
    echo "</div>";

}

function showStar()
{
    echo '<svg class="svg-star" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.12 9.88005C21.0781 9.74719 20.9996 9.62884 20.8935 9.53862C20.7873 9.4484 20.6579 9.38997 20.52 9.37005L15.1 8.58005L12.67 3.67005C12.6008 3.55403 12.5027 3.45795 12.3853 3.39123C12.2678 3.32451 12.1351 3.28943 12 3.28943C11.8649 3.28943 11.7322 3.32451 11.6147 3.39123C11.4973 3.45795 11.3991 3.55403 11.33 3.67005L8.89999 8.58005L3.47999 9.37005C3.34211 9.38997 3.21266 9.4484 3.10652 9.53862C3.00038 9.62884 2.92186 9.74719 2.87999 9.88005C2.83529 10.0124 2.82846 10.1547 2.86027 10.2907C2.89207 10.4268 2.96124 10.5512 3.05999 10.6501L6.99999 14.4701L6.06999 19.8701C6.04642 20.0091 6.06199 20.1519 6.11497 20.2826C6.16796 20.4133 6.25625 20.5267 6.36999 20.6101C6.48391 20.6912 6.61825 20.7389 6.75785 20.7478C6.89746 20.7566 7.03675 20.7262 7.15999 20.6601L12 18.1101L16.85 20.6601C16.9573 20.7189 17.0776 20.7499 17.2 20.7501C17.3573 20.7482 17.5105 20.6995 17.64 20.6101C17.7537 20.5267 17.842 20.4133 17.895 20.2826C17.948 20.1519 17.9636 20.0091 17.94 19.8701L17 14.4701L20.93 10.6501C21.0305 10.5523 21.1015 10.4283 21.1351 10.2922C21.1687 10.1561 21.1634 10.0133 21.12 9.88005Z" fill="#919191" class="svg-star-color"></path> </g></svg>';
}


// Check if a user is logged in and set current user
if (!empty($_SESSION['valid_user'])) {
    $current_user = $_SESSION['valid_user'];
}

// Select current user's query
function userResult($db, $current_user){
    $userQuery = "SELECT * FROM registered_member WHERE member_id=?";
    $userStmt = $db->prepare($userQuery);
    $userStmt->bind_param('s', $current_user);
    $userStmt->execute();
    $userResult = mysqli_stmt_get_result($userStmt);
    return $userResult;
    }

// Function to redirect user to a specified URL
function redirect_to($url)
{
    header('Location: ' . $url);
    exit;
}

// Function to check if a user is logged in
function loggedIn()
{
    return isset($_SESSION['valid_user']);
}

// Function to sanitize user input for security
function sanitizeInput($var)
{
    $var = mysqli_real_escape_string($_SESSION['connection'], $var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}


function handleData($db, $uid, $table, $id, $condition)
{
    $query = "SELECT * FROM " . $table . " WHERE " . "hotel_id" . " = ? AND member_id = ?";
//    echo $query;
//    return;
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }
//    echo $query;
//return;
    $stmt->bind_param('ss', $id, $uid);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }

    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }
//echo "???";
//return;
    if (mysqli_num_rows($result) > 0) {
        $deleteQuery = "DELETE FROM " . $table . " WHERE " . "hotel_id" . " = ? AND member_id = ?";
//    echo $deleteQuery;
//    return;
        $deleteStmt = $db->prepare($deleteQuery);
        if (!$deleteStmt) {
            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
            return;
        }
        $deleteStmt->bind_param('ss', $id, $uid);
        if (!$deleteStmt->execute()) {
            echo "Execute failed: (" . $deleteStmt->errno . ") " . $deleteStmt->error;
            return;
        }
        $deleteStmt->close();
    } else {
        $insert = "INSERT INTO " . $table . " (member_id, $condition) VALUES ('" . $uid . "', " . $id . ")";
//        echo $insert;
//        return;
        $db->query($insert);
    }
}

function dropdownButton($label, $options){
    echo "<label>" . ucwords($label);
    echo "<select name='" . $label . "' id='" . $label . "'>";
    foreach ($options as $opt){
        echo "<option value='" . $opt . "'>" . $opt . "</option>";
    }
    echo "</select>";
    echo "</label>";
}
