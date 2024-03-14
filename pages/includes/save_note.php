<?php
require '../login/connect.php';

$conn = connect();

$editorContent = $_POST['editorContent'];
$noteTitle = $_POST['titleValue'];
$userId = $_POST['user_id'];
$today = date("Y-m-d");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $query = "INSERT INTO user_notes (user_id, note_title, note_desc, date_created) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("isss", $userId, $noteTitle, $editorContent, $today);

        if ($stmt->execute()) {
            $response['status'] = true;
        
        } else {
            $response['status'] = false;
        
        }
        }

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();

?>
