<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];


    $username = mysqli_real_escape_string($conn, $username);
    $password = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Admin added successfully.";
    } else {
        $_SESSION['message'] = "Error adding admin: " . mysqli_error($conn);
    }
    // بازگشت به صفحه داشبورد ادمین
    header("Location: admin_dashboard.php");
    exit();
}
?>
