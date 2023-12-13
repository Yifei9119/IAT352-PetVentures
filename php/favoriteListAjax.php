<?php
include_once("../helper/function.php");
// Setting the table name for database operations
$table = "favourite_list";
// Defining the key used in the POST request to identify the guide ID
$postKey = "addFavorite_guideId";

// Checking if the user is logged in and the POST request contains the guide ID
if (!empty($_SESSION['valid_user']) && !empty($_POST[$postKey])) {
    // Retrieving the user ID from the session and the hotel ID from the POST request
    $user_id = $_SESSION['valid_user'];
    $hotelId = $_POST[$postKey];

    // Calling the handleData function to process the data
    handleData($db, $user_id, $table, $hotelId, "hotel_id");
}
// Closing the database connection
$db->close();
?>