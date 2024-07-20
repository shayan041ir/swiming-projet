<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت مقادیر از فرم و فرار از آنها
    $men_content = isset($_POST['men_content']) ? mysqli_real_escape_string($conn, $_POST['men_content']) : '';
    $men_timee = isset($_POST['men_timee']) ? mysqli_real_escape_string($conn, $_POST['men_timee']) : '';
    $women_content = isset($_POST['women_content']) ? mysqli_real_escape_string($conn, $_POST['women_content']) : '';
    $women_timee = isset($_POST['women_timee']) ? mysqli_real_escape_string($conn, $_POST['women_timee']) : '';

    // به‌روزرسانی رکورد آقایان
    $sql1 = "UPDATE timings SET content = '$men_content', timee = '$men_timee' WHERE id = 1";
    // به‌روزرسانی رکورد بانوان
    $sql2 = "UPDATE timings SET content = '$women_content', timee = '$women_timee' WHERE id = 2";

    // اجرای دستورات SQL و بررسی موفقیت آنها
    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        // در صورت موفقیت، کاربر به صفحه داشبورد ادمین هدایت می‌شود
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // در صورت خطا، پیغام خطا نمایش داده می‌شود
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
