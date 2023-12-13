<?php
include_once('../helper/function.php');
session_start();
session_destroy();
$message = "logged out";
redirect_to('index.php');
?>