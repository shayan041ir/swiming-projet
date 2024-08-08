<?php
include 'db.php';
session_start();

// بررسی اینکه آیا درخواست به صورت POST ارسال شده است یا خیر
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // درج اطلاعات کاربر جدید در جدول users
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "کاربر با موفقیت اضافه شد.";
    } else {
        $_SESSION['message'] = "خطا در اضافه کردن کاربر: " . $conn->error;
    }
    header("Location: admin_dashboard.php");
    exit();
}
?>