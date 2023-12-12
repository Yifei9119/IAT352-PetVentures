<?php
include_once("../helper/function.php");
// Establish database connection
$db = connection('localhost', 'root', '', 'hotel_models');
receiveData($db, $_SESSION["valid_user"], "favourite_list", "hotel_id");
function receiveData($db, $user_id, $table, $hotelType){
    $query = "SELECT * FROM " . $table . " WHERE member_id = ?";
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }
    $stmt->bind_param('s', $user_id);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }

    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    $Ids = [];
    while ($row = $result->fetch_assoc()){
        $Ids[] = $row[$hotelType];
    }
    $db->close();
    echo json_encode($Ids);
}


?>
