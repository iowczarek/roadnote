<?php
require '../login/connect.php';

$conn = connect();

$newTitle = $_POST['note_title'];
$editorContent = $_POST['editorContent'];
$userId = $_POST['user_id'];
$noteId = $_POST['note_id'];
$today = date("Y-m-d");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $query = "UPDATE user_notes SET note_title = ?, note_desc = ?, date_created = ? WHERE user_id = ? AND note_id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("sssii", $newTitle, $editorContent, $today, $userId, $noteId);
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
