<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posttext SET title = '$title', content = '$content' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "محتوا با موفقیت بروزرسانی شد.";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
    header("Location: admin_dashboard.php");
}
?>
