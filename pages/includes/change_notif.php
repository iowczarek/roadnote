<?php                
require '../login/connect.php'; 

    $eventId = $_POST['eventId'];
    $conn = connect();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query ="UPDATE calendar_events SET seen='1' WHERE event_id='$eventId' ";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
    $response['status'] = true;

} else {
    $response['status'] = false;

}
header('Content-Type: application/json');
echo json_encode($response);
$conn->close();

?>