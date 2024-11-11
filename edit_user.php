<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        $id = $_POST["id"];
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $sql = "UPDATE users SET username='$username', password='$password' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            header('Location: admin_dashboard.php');
        } else {
            echo "Error updating user: " . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
}
$conn->close();
?>

