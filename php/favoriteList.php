<?php
include_once("../helper/function.php");
// Start the session
session_start();

$table = "favourite_list";
$postKey = "addFavorite_guideId";

if (empty($_SESSION['valid_user']) || empty($_POST[$postKey])) return;
$user_id = $_SESSION['valid_user'];
$hotelId = $_POST[$postKey];
//echo $hotelId . " ";

//handleData($db, $user_id, $table, $hotelId, "hotel_id");