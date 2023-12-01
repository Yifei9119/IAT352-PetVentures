<?php
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
?>