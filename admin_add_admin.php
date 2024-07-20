<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // دریافت اطلاعات از فرم
    $username = $_POST['username'];
    $password = $_POST['password'];

    // امن‌سازی داده‌های ورودی
    $username = mysqli_real_escape_string($conn, $username);
    $password = password_hash($password, PASSWORD_DEFAULT);

    // اجرای دستور SQL برای افزودن ادمین جدید
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
