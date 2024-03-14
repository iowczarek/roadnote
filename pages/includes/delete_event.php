<?php                
require '../login/connect.php'; 
$event_id = $_POST['event_id'];   	
$conn = connect();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {

    $query = "DELETE FROM calendar_events WHERE event_id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $event_id);

if ($stmt->execute()) {
    $response['status'] = true;

} else {
    $response['status'] = false;

}
    $stmt->close();
}
    header('Content-Type: application/json');
    echo json_encode($response);
    $conn->close();
}
?>
