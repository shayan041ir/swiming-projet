<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_id = $_POST['old_id'];
    $new_name = $_POST['new_name'];

    $sql = "UPDATE coaches SET name = '$new_name' WHERE id = $old_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
