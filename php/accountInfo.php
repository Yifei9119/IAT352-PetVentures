<?php
require_once("header.php");

$userResult = userResult($db, $current_user);
while ($row = $userResult->fetch_assoc()) {
    echo"hiiiii";
}

$userResult->free_result();
$db->close();

?>