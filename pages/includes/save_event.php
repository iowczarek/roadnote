<?php                
require '../login/connect.php'; 

$event_name = $_POST['eventTitleValue'];
$event_start_date = $_POST['event_start_date'];
$event_end_date = $_POST['event_end_date'];
$id = $_POST['user_id'];   	

$conn = connect();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($event_start_date > $event_end_date) {
    echo "select correct date";
}
else {

$event_name = $conn->real_escape_string($event_name);
$event_start_date = $conn->real_escape_string($event_start_date);
$event_end_date = $conn->real_escape_string($event_end_date);

$query = "INSERT INTO calendar_events VALUES (NULL,?,?, ?, ?, ?, 0)";
$stmt = $conn->prepare($query);

function getRandomColor() {
    $colors = ['#8DB383', '#D88864', '#F6CE74', '#EEC9CD', '#e91e63'];
    $randomIndex = rand(0, count($colors) - 1);
    return $colors[$randomIndex];
}
$randomColor = getRandomColor();

if ($stmt) {
$stmt->bind_param("issss", $id, $randomColor, $event_name, $event_start_date, $event_end_date );

if ($stmt->execute()) {
    $response['status'] = true;
} else {
    $response['status'] = false;
}
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
}
?>


