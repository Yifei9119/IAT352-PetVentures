<script src="../js/add_favorite.js"></script>
<?php
require_once("header.php");
include_once("../helper/function.php");
// Querying favorite hotel IDs from the database
$favoriteHotelIds = queryFavoriteHotels($db);

// Starting the section for displaying favorite hotels
echo "<section class='section-padding'>";
echo "<h1>My Favourite List</h1>";
// Checking if the favorite list is empty and displaying a message if it is
if (count($favoriteHotelIds) == 0) {
    echo "<p style='text-align:center;'>Nothing Added to Favourite List. Browse our home page and add hotels to the list</p><a class='no-results' href='index.php'>Go to Home</a>";
}
echo "<div id='hotel-cards'>";

// iterate and show the hotels stored in favourites
foreach ($favoriteHotelIds as $hotelId) {
    $hotel = queryHotelById($db, $hotelId);

    format_hotel_name_as_link($hotel["hotel_id"], $hotel["name"], $hotel['price'], $hotel['province'], $hotel['image'], "hoteldetails.php");
}
echo "</div>";

// Function to query favorite hotels from the database
function queryFavoriteHotels($db)
{

    $query = "SELECT hotel_id FROM favourite_list WHERE member_id = ?";
    $stmt = $db->prepare($query);

    // Handling prepare statement error
    if ($stmt === false) {
        die("Prepare error: " . $db->error);
    }

    // Binding session user ID to the prepared statement
    $stmt->bind_param('s', $_SESSION["valid_user"]);

    // Executing the statement and handling execution error
    if (!$stmt->execute()) {
        die("Execute error: " . $stmt->error);
    }

    // Fetching the result of the query
    $result = $stmt->get_result();

    // Collecting all hotel IDs
    $allRows = [];
    while ($row = $result->fetch_assoc()) {
        $allRows[] = $row['hotel_id'];
    }

    $result->free_result();

    return $allRows;
}

// Function to query detailed information of a hotel by its ID
function queryHotelById($db, $id)
{
    
    $query = "SELECT hotel.hotel_id, hotel.name, hotel.image, hotel.province, MIN(room.price) as price FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id WHERE hotel.hotel_id = ? GROUP BY hotel.hotel_id";
    $stmt = $db->prepare($query);

    // Handling prepare statement error
    if ($stmt === false) {
        die("Prepare error: " . $db->error);
    }

    // Binding the hotel ID to the prepared statement
    $stmt->bind_param('s', $id); 

    // Executing the statement and handling execution error
    if (!$stmt->execute()) {
        die("Execute error: " . $stmt->error);
    }

    $result = $stmt->get_result();
    // Closing the statement
    $stmt->close();

    return $result->fetch_assoc();
}
$db->close();
require_once("footer.php");
?>