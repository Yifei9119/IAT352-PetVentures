<?php
// Function to redirect to HTTP if currently on HTTPS
function no_SSL() {
	if(isset($_SERVER['HTTPS']) &&  $_SERVER['HTTPS']== "on") {
		header("Location: http://" . $_SERVER['HTTP_HOST'] .
			$_SERVER['REQUEST_URI']);
		exit();
	}
}

// Function to enforce SSL, redirecting to HTTPS if not already on it
function require_SSL() {
	if($_SERVER['HTTPS'] != "on") {
		header("Location: https://" . $_SERVER['HTTP_HOST'] .
			$_SERVER['REQUEST_URI']);
		exit();
	}
}

// Start the session
session_start();
// Establish database connection
$db =  connection('localhost', 'root', '', 'hotel_models');

// Function to create a database connection and handle connection errors
function connection($dbhost, $dbuser, $dbpass, $dbname) {
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (mysqli_connect_errno()) {
        //quit and display error and error number
        die("Database connection failed:" .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
        );
    }
    return $conn;
}

//create a function for hotel cards
function hotelCards(){

}

function format_hotel_name_as_link($id,$name,$page) {
    echo "<a href=\"$page?hotelid=$id\">$name</a>";
    }


// Check if a user is logged in and set current user
if(!empty($_SESSION['valid_user']))  {
    $current_user = $_SESSION['valid_user'];
}

// Function to redirect user to a specified URL
function redirect_to($url) {
    header('Location: ' . $url);
    exit;
}

// Function to check if a user is logged in
function loggedIn() {
	return isset($_SESSION['valid_user']);
}

// Function to sanitize user input for security
function sanitizeInput($var) {
    $var = mysqli_real_escape_string($_SESSION['connection'], $var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}
?>