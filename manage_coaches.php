<?php
session_start();
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coach_id = $_POST['id'];
    $coach_name = $_POST['coach_name'];

    $sql = "DELETE FROM coaches WHERE id='$coach_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
    
    $conn->close();
}
?>
