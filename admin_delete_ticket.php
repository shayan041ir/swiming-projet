<?php
// وارد کردن فایل اتصال به پایگاه داده
include 'db.php';
// شروع جلسه (Session)
session_start();

// بررسی اینکه آیا درخواست از نوع POST است
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // دریافت شناسه (ID) از داده‌های POST
    $id = $_POST['id'];
    
    // ایجاد دستور SQL برای حذف بلیط با شناسه مشخص شده
    $sql = "DELETE FROM tickets WHERE id='$id'";
    
    // اجرای دستور SQL و بررسی نتیجه
    if ($conn->query($sql) === TRUE) {
        // در صورت موفقیت، کاربر به صفحه داشبورد ادمین هدایت می‌شود
        header("Location: admin_dashboard.php");
    } else {
        // در صورت خطا، پیغام خطا نمایش داده می‌شود
        echo "Error: " . $conn->error; 
    }
}
?>
