<?php
include_once("../helper/function.php");
//require_once("header.php");
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$table = "favourite_list";
$postKey = "addFavorite_guideId";
//echo "???";
if (empty($_SESSION['valid_user']) || empty($_POST[$postKey])) return;
$user_id = $_SESSION['valid_user'];
$hotelId = $_POST[$postKey];
// echo $hotelId . " ";

handleData($db, $user_id, $table, $hotelId, "hotel_id");
