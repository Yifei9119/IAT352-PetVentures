<?php
// Function to redirect to HTTP if currently on HTTPS
function no_SSL()
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
        header("Location: http://" . $_SERVER['HTTP_HOST'] .
            $_SERVER['REQUEST_URI']);
        exit();
    }
}

// Function to enforce SSL, redirecting to HTTPS if not already on it
function require_SSL()
{
    if ($_SERVER['HTTPS'] != "on") {
        header("Location: https://" . $_SERVER['HTTP_HOST'] .
            $_SERVER['REQUEST_URI']);
        exit();
    }
}

// Start the session
session_start();
// Establish database connection
$db = connection('localhost', 'root', '', 'hotel_models');

// Function to create a database connection and handle connection errors
function connection($dbhost, $dbuser, $dbpass, $dbname)
{
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

// function searchbar()
// {
//     echo '<form action="searchResults.php" method="POST" style="display:flex; justify-content: center;">
//     <div>
//     <label> Place </label>
//     <input id="search" name="search" type="text" placeholder="Country">
//     </div>
//     <div>
//     <label>Check in</label>
//     <input id="date" name="startdate" type="date">
//     </div>
//     <div>
//     <label>Check out</label>
//     <input id="date" name="enddate" type="date">
//     <input id="submit" type="submit" value="Search">
//     </div>
//     </form></div>';
// }
function format_hotel_name_as_link($id, $name, $price, $province, $image, $page)
{
    echo "<a href=\"$page?hotelid=$id\">";
    echo $name;
    echo "<div>";
    echo "$" . $price;
    echo $province . "<br>";
    echo '<img class="hotel-img" width="200" src="../images/hotels/' . $image . '">';
    echo "</div></a>";
}


// Check if a user is logged in and set current user
if (!empty($_SESSION['valid_user'])) {
    $current_user = $_SESSION['valid_user'];
}

// Function to redirect user to a specified URL
function redirect_to($url)
{
    header('Location: ' . $url);
    exit;
}

// Function to check if a user is logged in
function loggedIn()
{
    return isset($_SESSION['valid_user']);
}

// Function to sanitize user input for security
function sanitizeInput($var)
{
    $var = mysqli_real_escape_string($_SESSION['connection'], $var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}
?>