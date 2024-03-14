<?php

session_start();
require_once "../login/connect.php";
$conn = connect();

if(isset($_POST['delete_id']))
{
    $id = $_POST['delete_id'];

    $query1 = "DELETE FROM users WHERE id = ?";
    $query2 = "DELETE FROM map_records WHERE user_id = ?";
    $query3 = "DELETE FROM calendar_events WHERE user_id = ?";

    $stmt1 = $conn->prepare($query1);
    $stmt2 = $conn->prepare($query2);
    $stmt3 = $conn->prepare($query3);

    if ($stmt1 && $stmt2 && $stmt3) {
        $stmt1->bind_param("i", $id);
        $stmt2->bind_param("i", $id);
        $stmt3->bind_param("i", $id);
    
        $stmt1->execute();
        $stmt2->execute();
        $stmt3->execute();
    
        $stmt1->close();
        $stmt2->close();
        $stmt3->close();

        session_unset(); 
        session_destroy(); 
        
        header('Location: deletedacc.php'); 
        exit(0);
    }
    else {
        header('Location: ../error.php');
        exit(0);
    }
}


?>