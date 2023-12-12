<?php

include_once('../helper/function.php');

$message = "";
// Check if productCode is set in GET request and if the user is logged in
if (!empty($_GET['bookingid']) && loggedIn()) {
	// Prepare a query to delete the specified booking from the user's booking list
	$query = "DELETE FROM booking WHERE member_id=? AND booking_id =?";
	$stmt = $db->prepare($query);
	$stmt->bind_param('si',$_SESSION['valid_user'],$_GET['bookingid']);
	$stmt->execute();

	$message = urlencode("The hotel booking has been removed from your booking list.");
  

mysqli_close($db);
  
}
//fetch the booking list for the user
redirect_to("member_bookings.php");

?>