
<?php

// Defined as constants so that they can't be changed
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'Sunflower.13');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'mydb');

$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL: ' .
mysqli_connect_error());
?>
