<?php

require_once("header.php");


//Search box value assigning to $Name variable.
$Name = trim($_GET['search']);

//Search query.
$query_str = "SELECT hotel.hotel_id, hotel.location, hotel.services, hotel.name, hotel.image, hotel.province, MIN(room.price) as price FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id WHERE hotel.province LIKE CONCAT('%',?,'%') OR hotel.name LIKE CONCAT('%',?,'%') OR hotel.services LIKE CONCAT('%',?,'%') OR hotel.location LIKE CONCAT('%',?,'%') GROUP BY hotel_id";

//prepare and bind
$stmt = $db->prepare($query_str);
$stmt->bind_param('ssss', $Name, $Name, $Name, $Name);
$stmt->execute();
$res = mysqli_stmt_get_result($stmt);

echo "<section class='section-padding'>";

//Fetching result from database.
// Iterate through each row in the query result
// if no data found display a link to return home
if ($res->num_rows == 0) {
    echo "<h1>No Results Found For '$Name'</h1>";
    echo "<p style='text-align:center;'>Please search for other keywords or return to home page</p><a class='no-results' href='index.php'>Return to Home</a>";
} else {
    echo "<h1>Search Results For '$Name'</h1><div id=hotel-cards>";
    while ($row = $res->fetch_assoc()) {
        format_hotel_name_as_link($row["hotel_id"], $row["name"], $row['price'], $row['province'], $row['image'], "hoteldetails.php");
    }
}
echo "</div></section>";

include('footer.php');
?>