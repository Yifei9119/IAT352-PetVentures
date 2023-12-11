<script src="../js/jquery-3.6.1.js"></script>
<script src="../js/add_favorite.js"></script>
<?php
include_once("../helper/function.php");

if (!empty(($_POST['Province']))) {
    $_SESSION['Province'] = $_POST['Province'];
}

if (!empty(($_POST['Availability']))) {
    $_SESSION['Availability'] = $_POST['Availability'];
}

$query_str = "SELECT hotel.hotel_id, hotel.name, hotel.image, hotel.province, MIN(room.price) as price FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id";
$conditions = array();
$params = array();
$types = '';

if (isset($_SESSION['Province']) && $_SESSION['Province'] != "All") {
    $conditions[] = "hotel.province = ?";
    $params[] = $_SESSION['Province'];
    $types .= 's';
}

if (isset($_SESSION['Availability']) && $_SESSION['Availability'] != "All") {
    $conditions[] = "room.availability = ?";
    $params[] = (int)$_SESSION['Availability'];
    $types .= 'i';
}

if (count($conditions) > 0) $query_str .= "  WHERE " . implode(" AND ", $conditions) . " GROUP BY hotel_id";
else $query_str .= " GROUP BY hotel_id";

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

    $res = $stmt->get_result();

if ($res === false) {

    echo "Error: " . htmlspecialchars($db->error);

    exit;
}

if ($res->num_rows == 0) {
    echo "No hotels found.";
    exit;
}

while ($row = $res->fetch_assoc()) {
    // Format each hotel model as a link
    format_hotel_name_as_link($row["hotel_id"], $row["name"], $row['price'], $row['province'], $row['image'], "hoteldetails.php");
}