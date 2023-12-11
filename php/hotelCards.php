<?php
include_once("../helper/function.php");
$db = connection('localhost', 'root', '', 'hotel_models');


if (empty($_POST['Province'])){
    $query_str = "SELECT hotel.hotel_id, hotel.name, hotel.image, hotel.province, MIN(room.price) as price FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id GROUP BY hotel_id";
    $res = $db->query($query_str);
}
else{
    $province = $_POST['Province'];
    $query_str = "SELECT hotel.hotel_id, hotel.name, hotel.image, hotel.province, MIN(room.price) as price FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id WHERE hotel.province = ? GROUP BY hotel_id";
    $stmt = $db->prepare($query_str);

    if ($stmt === false) {
        die("Prepare error: " . $db->error);
    }

    $stmt->bind_param('s', $province); // 'i' 表示参数是一个整数

    if (!$stmt->execute()) {
        die("Execute error: " . $stmt->error);
    }

    $res = $stmt->get_result();

    $stmt->close();
}

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
};
