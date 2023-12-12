<?php
require_once("header.php");



////ini_set('display_errors', 1);
////ini_set('display_startup_errors', 1);
////error_reporting(E_ALL);
$favoriteHotelIds = queryFavoriteHotels($db);
//echo "???";
foreach ($favoriteHotelIds as $hotelId){
    $hotel = queryHotelById($db, $hotelId);
//    echo $hotel['name'];
    format_hotel_name_as_link($hotel["hotel_id"], $hotel["name"], $hotel['price'], $hotel['province'], $hotel['image'], "hoteldetails.php");
}
//echo $favoriteHotelIds[5];

function queryFavoriteHotels($db)
{
    // 准备一个带有参数占位符的SQL查询
    $query = "SELECT hotel_id FROM favourite_list WHERE member_id = ?";

// 创建预处理语句
    $stmt = $db->prepare($query);

// 检查是否成功创建预处理语句
    if ($stmt === false) {
        die("Prepare error: " . $db->error);
    }

// 将变量绑定到预处理语句的参数
    $stmt->bind_param('s', $_SESSION["valid_user"]); // 'i' 表示参数是一个整数

// 执行查询
    if (!$stmt->execute()) {
        die("Execute error: " . $stmt->error);
    }

// 获取结果
    $result = $stmt->get_result();

// 接下来，你可以处理查询结果
// 例如，遍历结果集
    $allRows = [];
    while ($row = $result->fetch_assoc()) {
        // 处理每一行
        $allRows[] = $row['hotel_id'];
    }

    $result->free_result();

    return $allRows;
}

function queryHotelById($db, $id)
{
    // 准备SQL语句
    $query = "SELECT hotel.hotel_id, hotel.name, hotel.image, hotel.province, MIN(room.price) as price FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id WHERE hotel.hotel_id = ? GROUP BY hotel.hotel_id";

//    echo $query;
//    return;
// 创建预处理语句
    $stmt = $db->prepare($query);

// 检查预处理语句是否成功创建
    if ($stmt === false) {
        die("Prepare error: " . $db->error);
    }

// 将变量绑定到预处理语句的参数
    $stmt->bind_param('s', $id); // 'i' 表示参数是一个整数

// 执行查询
    if (!$stmt->execute()) {
        die("Execute error: " . $stmt->error);
    }

// 获取结果
    $result = $stmt->get_result();

// 处理结果
//    while ($row = $result->fetch_assoc()) {
//        // 使用 $row 数组中的数据
//        // 例如: echo $row["column_name"];
//    }

// 关闭语句
    $stmt->close();

    return $result->fetch_assoc();
}
