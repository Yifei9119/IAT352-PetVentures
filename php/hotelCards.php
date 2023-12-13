<script src="../js/jquery-3.6.1.js"></script>
<script src="../js/add_favorite.js"></script>

<?php
include_once("../helper/function.php");

// Checking and setting the 'Province' session variable from POST data
if (!empty(($_POST['Province']))) {
    $_SESSION['Province'] = $_POST['Province'];
}
// Checking and setting the 'Availability' session variable from POST data
if (!empty(($_POST['Availability']))) {
    $_SESSION['Availability'] = $_POST['Availability'];
}
// Starting the query string for selecting hotels
$query_str = "SELECT hotel.hotel_id, hotel.name, hotel.image, hotel.province, MIN(room.price) as price FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id";
$conditions = array();
$params = array();
$types = '';
// Adding condition for 'Province' if set and not 'All'
if (isset($_SESSION['Province']) && $_SESSION['Province'] != "All") {
    $conditions[] = "hotel.province = ?";
    $params[] = $_SESSION['Province'];
    $types .= 's';
}
// Adding condition for 'Availability' if set and not 'All'
if (isset($_SESSION['Availability']) && $_SESSION['Availability'] != "All") {
    $conditions[] = "room.availability = ?";
    $params[] = (int) $_SESSION['Availability'];
    $types .= 'i';
}
// Appending conditions to the query string
if (count($conditions) > 0)
    $query_str .= "  WHERE " . implode(" AND ", $conditions) . " GROUP BY hotel_id";
else
    $query_str .= " GROUP BY hotel_id";
// Preparing the query
$stmt = $db->prepare($query_str);
if ($stmt === false) {
    echo "Prepare error: " . $db->error;
    exit();
}

if ($types != '') {
    $stmt->bind_param($types, ...$params);
}

if (!$stmt->execute()) {
    echo "Execute error: " . $stmt->error;
    exit();
}
// Getting the result of the query
$res = $stmt->get_result();

if ($res === false) {

    echo "Error: " . htmlspecialchars($db->error);

    exit;
}

if ($res->num_rows == 0) {
    echo "No hotels found.";
    exit;
}
// Iterating over the result set and formatting each hotel as a link
while ($row = $res->fetch_assoc()) {
    // Format each hotel model as a link
    format_hotel_name_as_link($row["hotel_id"], $row["name"], $row['price'], $row['province'], $row['image'], "hoteldetails.php");
}

$res->free_result();
$db->close();
?>