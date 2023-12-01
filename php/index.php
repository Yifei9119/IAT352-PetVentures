<?php
include_once("../helper/function.php");
require("header.php");

echo'<form action="users.php" method="GET" style="text-align:center;">
<input id="search" name="search" type="text" placeholder="Country">
<input id="date" name="date" type="date">
<input id="submit" type="submit" value="Search">
</form>';

require("footer.php");
?>