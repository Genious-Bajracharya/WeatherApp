<?php
$mysqli = new mysqli("localhost:3307","root","","web");
if ($mysqli -> connect_errno) {
echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
exit();
}
include('import_2060357.php');

$sql = "SELECT *
FROM weather
ORDER BY weather_when DESC limit 1";
$result = $mysqli -> query($sql);

$row = $result -> fetch_assoc();
print json_encode($row);

$result -> free_result();
$mysqli ->close();
?>
