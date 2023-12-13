<?php
include_once("../helper/function.php");
// Receiving data
receiveData($db, $_SESSION["valid_user"], "favourite_list", "hotel_id");
// Function to receive data from the database
function receiveData($db, $user_id, $table, $hotelType){
    // Preparing the query
    $query = "SELECT * FROM " . $table . " WHERE member_id = ?";
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }
    // Binding parameters
    $stmt->bind_param('s', $user_id);
     // Checking for execution error
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }

     // Getting the result of the query
    $result = $stmt->get_result();

    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }
    // Fetching data from the result
    $Ids = [];
    while ($row = $result->fetch_assoc()){
        $Ids[] = $row[$hotelType];
    }
    // Closing the database connection
    $db->close();
    echo json_encode($Ids);
}


?>
