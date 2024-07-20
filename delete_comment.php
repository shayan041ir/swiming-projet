<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    
    $sql = "DELETE FROM comments WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        // بر اساس نوع کاربر به مسیر مناسب هدایت شوید
        if ($_SESSION['user_type'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
