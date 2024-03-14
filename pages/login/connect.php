<?php 
function connect() {
$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "roadnote";
$conn = mysqli_connect($host, $db_user, $db_password, $db_name);

if (!$conn) {
    die("No connection to server!");
} else {
    return $conn;
}
}
?>

